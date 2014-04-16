<?php

class Modules_Admin_Controllers_Demo extends  Cola_Controller {
	
	public  function indexAction(){
		echo 'test:'.__CLASS__;
	}

	public  function testAction(){
		var_dump($this->getVar('3'));
		
		$res = Modules_Admin_Models_Test::init()->getData();
		//var_dump($res);
		
		$v =  'test:'.__FUNCTION__;
		$this->view->v = $v;
		$this->tpl();
	}
	
	
}

?>