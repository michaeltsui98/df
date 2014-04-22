<?php


class Modules_Admin_Controllers_Sign extends  Cola_Controller {
	
	public  function indexAction(){
		//var_dump($_SESSION);
	    $this->tpl();
	}
	
	public function loginAction(){
		$user_name = $this->post('user_name');
		$password = $this->post('password');
		$xk = $this->post('xk');
		$res = Modules_Admin_Models_SysUser::init()->checkLogin($user_name, $password, $xk);
		if($res){
		    $_SESSION['admin_user'] = $res[0];
		    $this->redirect(BASE_PATH.'/index.php/Admin/Index/index/xk/'.$xk);
			
		} 
			echo '登录失败';
		 
		
		//var_dump($user_name,$password);
	}
	/**
	 * 退出后台
	 */
	public function exitAction(){
		unset($_SESSION['admin_user']);
		$this->redirect(BASE_PATH.'/index.php/Admin/Sign/index');
	}
	
}