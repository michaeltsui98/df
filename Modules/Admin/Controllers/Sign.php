<?php


class Modules_Admin_Controllers_Sign extends  Cola_Controller {
	
	public  function indexAction(){
		
	    var_dump($_SESSION);
	    $this->tpl();
	}
	
	public function loginAction(){
		$user_name = $this->post('user_name');
		$password = $this->post('password');
		if($user_name){
			$_SESSION['user']['admin'] = $user_name;
			
			$this->redirect(BASE_PATH.'/index.php/Admin/Index');
		}{
			echo '登录失败';
		}
		
		//var_dump($user_name,$password);
	}
	
}