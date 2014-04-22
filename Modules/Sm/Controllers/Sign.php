<?php

class Modules_Sm_Controllers_Sign extends  Modules_Sm_Controllers_Base {
	
	public $layout = '';
	
	public function __construct(){
		$this->layout = $this->getCurrentLayout(__CLASS__).'index.htm';
	}
	
	public function indexAction(){
		$this->tpl();
	}
	
	public function loginAction(){
		 
	}
	
	 
}

?>