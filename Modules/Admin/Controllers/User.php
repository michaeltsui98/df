<?php

/**
 * 后台用户管理
 * 
 * @author michaeltsui98@qq.com 2014-04-17
 *
 */
class Modules_Admin_Controllers_User extends  Modules_Admin_Controllers_Base {
	
	public  function runAction(){
		
	    $this->view->title = '用户管理-列表';
	    $group_id = intval($this->getVar('group_id'));
	    $this->view->group_id = $group_id ;
 	    if(!$this->request()->isAjax()){
	        $layout = $this->getCurrentLayout('common.htm');
	        $this->setLayout($layout);
	    }

	    $grouplist = Modules_Admin_Models_SysGroup::init()->getUserGroupList();
	    $this->view->grouplist = $grouplist;
	    
	    $this->tpl();
	}
	/**
	 * 添加用户
	 */
	public  function addAction(){
		
		$grouplist = Modules_Admin_Models_SysGroup::init()->getUserGroupList();
		$this->view->grouplist = $grouplist;
		$this->tpl();
	}
	
	public function isOkAction(){
		$user_id = $this->get('user_id');
		$ok = $this->get('ok');
		$res  =  Modules_Admin_Models_SysUser::init()->update($user_id, array('user_isok'=>$ok));
		$arr = array('status'=>$res,'message'=>'操作成功','success_callback'=>"ajax_flash('user');");
		$this->abort($arr);
	}
	
	public function jsonAction() {
	    $group_id = intval($this->getVar('group_id'));
	    $page =  $this->getVar('page',1);
	    $rows =  $this->getVar('rows',20);
	    $user =  Modules_Admin_Models_SysUser::init()->getUserList($page, $rows, $group_id, XK);
	    $this->view->user = $user;
	    $this->view->isOkUrl = url($this->c,'isOkAction');
	    $this->view->orderUrl = url($this->c,'orderAction');
	    $this->tpl();
	    
	}
 
	
}