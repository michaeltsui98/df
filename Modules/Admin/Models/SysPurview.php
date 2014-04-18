<?php


class Modules_Admin_Models_SysPurview extends Cola_Model {
    
	protected $_table = 'sys_purview';
	
	protected $_pk = 'purview_id';
	
	public function getData(){
		return $this->find();
	}
	
}

?>