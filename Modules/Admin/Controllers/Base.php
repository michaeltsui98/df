<?php

/**
 * 后台的基础控制器，其它控制器必须继承
 * 
 * @author michaeltsui98@qq.com  2014-04-17
 *
 */
include S_ROOT.'Models/AdminFunc.php';

class Modules_Admin_Controllers_Base extends  Cola_Controller {
	
    public $c;
    
    public $a;
    
    public $xk;
    
    public $html;
    
    /**
     * 前置执行Action
     */
    public function before()
    {
        $xk  = $this->getVar('xk');
        $this->c = Cola::getInstance()->dispatchInfo['controller'];
        $this->a = Cola::getInstance()->dispatchInfo['action'];
        
        $user = $_SESSION['admin_user'];
        
        // 如果用户没有登录，或者没有选择学科，退出到登录界面
        if(!isset($user['user_uid']) or !$xk){
            $this->redirect(BASE_PATH.'/index.php/Admin/Sign');
            die;
        }
        
        /* 后台菜单列表 */
        $menu = Modules_Admin_Models_SysModule::init()->getMenu($user['user_group_id'], $xk);
        
        define('XK', $xk);
        $this->view->c = $this->c;
        $this->view->a = $this->a;
        $this->view->menu = $menu;
        $this->view->user = $user;
        //后台数据生成请求地址
        $this->view->getJsonDataUrl  = url($this->c, 'jsonAction');
        //后台添加数据的url
        $this->view->addUrl  = url($this->c, 'addAction');
        $this->view->addDoUrl  = url($this->c, 'addDoAction');
        //后台修改数据的url
        $this->view->editUrl  = url($this->c, 'editAction');
        $this->view->editDoUrl  = url($this->c, 'editDoAction');
        //后台删除数据的url
        $this->view->delUrl  = url($this->c, 'delAction');
    }
    
 
    
	public function __construct(){
		//登录判断
		$this->before();
	}
	
	public function page($page,$limit,$count,$ajax){
	    $url = Cola_Model::init()->getPageUrl();
	    $pager = new Cola_Com_Pager($page, $limit, $count, $url, $ajax);
	    return $html = $pager->html();
	}
		
} 