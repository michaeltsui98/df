<?php


class Modules_Admin_Models_SysUser extends Cola_Model {
    
	protected $_table = 'sys_user';
	
	protected $_pk = 'user_id';
	
	public function getData(){
		return $this->find();
	}
	
	/**
	 * 检查用户登录
	 * @param string $user_name
	 * @param string $password
	 * @param string $xk
	 * @return boolean|Ambigous <multitype:, boolean>
	 */
	public  function checkLogin($user_name,$password,$xk){
	    $arr = array('fileds' => 'user_name,user_realname,user_group_id,user_uid',
	             'where' => "user_name = '$user_name' and user_pass = '$password' and xk = '$xk'"
	         , 'order' => null, 'start' => -1, 'limit' => 1);
		$info = $this->find($arr);
		//如果没用则登录失败
		if(empty($info)){
			return false;
		}
		return $info;
	}
	
	public  function getUserList($page,$rows,$group_id,$xk){
	    if ( $group_id>0 ) {
	        $where = " and u.user_group_id = '{$group_id}'";
	    }
	    $sql = "select u.*,g.group_title 
	           from sys_user u left join sys_group g 
	           on u.user_group_id=g.group_id 
	           where u.user_gd=0 and u.xk= '$xk'
	           {$where} 
	           order by u.user_order asc";
	    return $this->getListBySql($sql, $page, $rows);
	     
	}
	
	
	
}

?>