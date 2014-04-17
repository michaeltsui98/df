<?php

/**
 * 后台框架首页
 * 
 * @author michaeltsui98@qq.com 2014-04-17
 *
 */
class Modules_Admin_Controllers_Index extends  Modules_Admin_Controllers_Base {
	
	public  function indexAction(){
		
	    $this->view->title = '生命安全后台管理系统';
	    
	    $this->setLayout($this->getCurrentLayout('common.htm'));
	    $this->tpl();
	}
	
}