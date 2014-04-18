<?php


class Modules_Admin_Models_SysModule extends Cola_Model {
    
	protected $_table = 'sys_module';
	
	protected $_pk = 'module_id';
	
	
	/**
	 * 取后用户的菜单
	 * @param int $group_id
	 * @param string $xk
	 * @return Ambigous <multitype:, boolean>
	 */
	public function getMenu($group_id,$xk){
	    if(!$xk){
	    	return false;
	    }
	    if($group_id==0){
	        $sql = "SELECT * FROM sys_module where module_isok=1 and xk='{$xk}' ORDER BY module_order asc";
	    }else{
	        $sql = "SELECT * FROM sys_module m 
	        LEFT JOIN sys_purview p on m.module_id = p.purview_module_id 
	        where m.module_isok=1 and p.purview_group_id={$group_id} 
	        and m.xk = '{$xk}'
	        ORDER BY m.module_order asc";
	    }
	    return $this->sql($sql);
	}
	
}

?>