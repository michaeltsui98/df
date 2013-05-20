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
        $menuOrder = Models_Admin_Menu::init();
        
       // var_dump($this->view->menu);
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
        
        $model = Models_Admin_Menu::init();
        $data = $model->getMenu(0);
        return is_array($data) ? $data : array();
    }
    
    /**
     * 左菜单
     */
    public function leftMenuAction()
    {
        $menuid = intval($this->request->param('menuid'));
        $model = Models_Admin_Menu::init();
        $data = $model->getMenu($menuid);
        foreach ($data as $_value) {
            echo '<h3 class="f14"><span class="switchs cu on" title="' . $_value['module_title'] . '"></span>' . $_value['module_title'] . '</h3>';
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
                echo '<li id="_MP' . $_m['id'] . '" ' . $classname . '><a href="javascript:_MP(' . $_m['id'] . ',\''.BASE_PATH.'/index.php/' . $_m['module_controller'] . '/' . $_m['module_action'] . $data . '\');" hidefocus="true" style="outline:none;">' . $_m['module_title'] . '</a></li>';
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
         
        echo Models_Admin_Menu::init()->getCurrentPos($menuid);
    }
    
    /**
     * 小秘书
     */
    public function secretaryAction()
    {
    
        $this->view->info = '平台管理首页';
        $this->display("admin/secretary");
    }
    
    /**
     * 锁屏
     */
    public function LockScreenAction()
    {
        $_SESSION['lockScreen'] = 1;
    }
    
    
    
}

