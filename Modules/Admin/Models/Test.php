<?php


class Modules_Admin_Models_Test extends Cola_Model {
    
	protected $_table = 'sys_module';
	
	protected $_pk = 'id';
	
	public function getData(){
		return $this->find();
	}
	
}

?>