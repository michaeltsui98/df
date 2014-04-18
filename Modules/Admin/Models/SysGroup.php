<?php


class Modules_Admin_Models_SysGroup extends Cola_Model {
    
	protected $_table = 'sys_group';
	
	protected $_pk = 'group_id';
	
	public function getData(){
		return $this->find();
	}
	/**
	 * 获取用户组表列
	 * @return Ambigous <multitype:, boolean>
	 */
	public function getUserGroupList(){
		$xk = XK;
		return $this->find(array('fileds' => 'group_id,group_title', 
				'where' => "xk='{$xk}' and group_isok=1", 'order' => 'group_order asc'));
	}
	
}

?>