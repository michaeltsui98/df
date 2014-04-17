<?php

/**
 * 后台的基础控制器，其它控制器必须继承
 * 
 * @author michaeltsui98@qq.com  2014-04-17
 *
 */

class Modules_Admin_Controllers_Base extends  Cola_Controller {
	
	public function __construct(){
		//登录判断
		$this->checkAdminLogin();
	}
	
	/**
	 * 判断用户是不是登录
	 */
	public function checkAdminLogin(){
		if(!isset($_SESSION['user']['admin'])){
			$this->redirect(BASE_PATH.'/index.php/Admin/Sign');
		}	    
	}
		
} 