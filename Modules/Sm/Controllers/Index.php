<?php

class Modules_Sm_Controllers_Index extends  Cola_Controller {
	
	public $layout = '';
	
	public function __construct(){
		$this->layout = $this->getCurrentLayout(__CLASS__).'index.htm';
	}
	
	public function indexAction(){
		$v = __CLASS__;
		$this->view->v = $v;
		$this->view->title = '这是一个测试';
		$this->view->arr = array(1,2);
		
		$this->tpl();
	}
	
	/**
	 * 不带参数
	 */
	public function widget1Action(){
		$this->view->v = __FUNCTION__.'挂件1的变量';
		echo __FUNCTION__;
		$this->tpl('Modules/Sm/Views/Index/widget1.htm');
	}
	/**
	 * 带参数的
	 */
	public function widget2Action(){
		$this->view->arg = func_get_args();
		$this->view->v = __FUNCTION__.'挂件2的变量';
		$this->tpl('Modules/Sm/Views/Index/widget2.htm');
		
	}
	
}

?>