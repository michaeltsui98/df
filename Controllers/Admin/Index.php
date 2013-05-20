<?php
class Controllers_Admin_Index extends Controllers_Admin_Base 
{
    
    protected $displayInfor = array();
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function indexAction()
    {
        
       /*  if (isset($_SESSION['user'])) {
            $this->redirect('index.php/Admin_Index/main');
        } else {
            $this->redirect('index.php/Admin_Login');
        } */
        $this->mainAction();
    }
    
    public function mainAction()
    {
         
        $this->view->menu = $this->menuAction();
        $menuOrder = $this->model('Menu');
        
    
        $latestMenuId = $this->request->param('latestMenuId','');
       
        if($latestMenuId =='')//这个就是首次进入的
        {
            //如果没有，那么最新的一个会被传入SESSION
            $singleTopMenu = $menuOrder->getLatestMenuInfo();
            //var_dump($singleTopMenu);
            //如果没有有效的，就是0
    
            $_SESSION['user']['latestMenuId'] = isset($singleTopMenu[0]['menu_id']) ? $singleTopMenu[0]['menu_id'] : 0 ;
            $_SESSION['user']['latestMenuTitle'] = isset($singleTopMenu[0]['menu_name']) ? $singleTopMenu[0]['menu_name'] : "没有有效的征订期号";
            $_SESSION['user']['latestMenuStartTime'] = isset($singleTopMenu[0]['menu_name']) ? $singleTopMenu[0]['menu_name'] : "没有有效的征订期号";
    
        }
        else
        {
    
            $latestMenu = $menuOrder->getSingleMenu($latestMenuId);
            $_SESSION['user']['latestMenuId'] = isset($latestMenu[0]['menu_id']) ? $latestMenu[0]['menu_id'] : 0 ;
            $_SESSION['user']['latestMenuTitle'] = isset($latestMenu[0]['menu_name']) ? $latestMenu[0]['menu_name'] : "没有有效的征订期号";
    
        }
        $this->view->latestMenuTitle = $_SESSION['user']['latestMenuTitle'];
        //获得最新的5个期号和名称
        $fiveMenus = $menuOrder->getTop5MenuInfo();
        // var_dump($fiveMenus);
        $this->view->fiveMenus = $fiveMenus;
    
    
        $this->display('admin/main');
    }
    
    /**
     * 按父ID查找菜单子项
     * @param integer $parentid   父菜单ID
     * @param integer $with_self  是否包括他自己
     * @return array 返回子菜单数组
     */
    private function menuAction()
    {
        
        $model = $this->model('Menu');
        $data = $model->getMenu(0);
        return is_array($data) ? $data : array();
    }
    
    /**
     * 左菜单
     */
    public function leftMenuAction()
    {
        $menuid = intval($this->request->param('menuid'));
        $model = $this->model('Menu');
        $data = $model->getMenu($menuid);
        $this->response->charset();
        foreach ($data as $_value) {
            echo '<h3 class="f14"><span class="switchs cu on" title="' . $_value['name'] . '"></span>' . $_value['name'] . '</h3>';
            echo '<ul>';
            $sub_array = $model->getMenu($_value['id']);
            foreach ($sub_array as $_key => $_m) {
                //附加参数
                $data = $_m['data'] ? $_m['data'] : '';
                //左侧菜单不显示选中状态
                if ($menuid == 5) {
                    $classname = 'class="sub_menu"';
                } else {
                    $classname = 'class="sub_menu"';
                }
                echo '<li id="_MP' . $_m['id'] . '" ' . $classname . '><a href="javascript:_MP(' . $_m['id'] . ',\'/index.php/' . $_m['c'] . '/' . $_m['a'] . $data . '\');" hidefocus="true" style="outline:none;">' . $_m['name'] . '</a></li>';
            }
            echo '</ul>';
        }
    }
    
    /**
     * 当前位置
     */
    public function currentPosAction()
    {
        $menuid = intval($this->request->param('menuid'));
    
        $model = $this->model('Menu');
        echo $model->getCurrentPos($menuid);
    }
    
    /**
     * 小秘书
     */
    public function secretaryAction()
    {
    
        $usertype = $_SESSION['user']['type'];
    
        //1，2，3是学校用户
        //4是校长，没有小秘书
        //5是区县用户 有区县小秘书
        //6是市州用户，有市州小秘书
        //7是省级用户，有省级小秘书，
        //12，13分别是区县纠风和市州纠风，他们公用省级的小秘书
        if ($usertype == '1' || $usertype == '2' || $usertype == '3') {
            //高中小学的小秘书
            $this->secretaryXxAction();
        } else if ($usertype == '5') {
            $this->secretaryQxAction();
        } else if ($usertype == '6') {
            $this->secretaryShiAction();
        } else if ($usertype == '7' OR $usertype == '12' OR $usertype == '13') {
            $this->secretaryshengAction();
        }
        $this->view->displayInfor = $this->displayInfor;
        $this->display("secretary.php", "views/Index");
    }
    
   
    
   
    
     
     
    
    /**
     * 小秘书信息数组数据处理
     */
    function setShowArray($_content, $_mainUrl)
    {
        $displayInfor = $this->displayInfor;
        $ll = count($displayInfor);
        $this->displayInfor[$ll]["content"] = $_content;
        $this->displayInfor[$ll]["mainUrl"] = $_mainUrl;
        return $this->displayInfor;
    }
    
   
    
    /**
     * 锁屏
     */
    public function LockScreenAction()
    {
        $_SESSION['lockScreen'] = 1;
    }
    
    
    
}

?>