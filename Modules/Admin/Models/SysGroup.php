<?php


class Modules_Admin_Models_SysGroup extends Cola_Model {
    
	protected $_table = 'sys_group';
	
	protected $_pk = 'group_id';
	
	public function getData(){
		return $this->find();
	}
	
}

?>