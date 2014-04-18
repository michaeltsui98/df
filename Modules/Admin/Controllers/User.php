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
	    	$this->setLayout('common.htm');
	    }
	    
	    //var_dump($this->c);die;
	    
	    $this->tpl();
	}
	
	public function jsonAction() {
	    $group_id = intval($this->getVar('group_id'));
	    $where = "";
	    if ( $group_id>0 ) {
	        $where = " and u.user_group_id = '{$group_id}'";
	    }
	    $page = intval($this->getVar('page'));
	    $rows = intval($this->getVar('rows'));
	    //$user = $this->_getUserService()->getListBySql($page, $rows, "select u.*,g.group_title from sys_user u left join sys_group g on u.user_group_id=g.group_id where u.user_gd=0 {$where} order by u.user_order asc");
	    $userModel =Modules_Admin_Models_SysUser::init();
	    $sql = "select u.*,g.group_title from sys_user u left join sys_group g on u.user_group_id=g.group_id where u.user_gd=0 {$where} order by u.user_order asc";
	    
	    $userModel->getListBySql($sql, $page, $limit);
	    //$user = Modules_Admin_Models_SysUser::init()->sql($sql);
	    $this->view->user = $user;
	    if ($this->controller->is_ajax()){
	        $this->tpl();
	    }
	}
 
	
}