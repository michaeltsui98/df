<?php
class Controllers_Admin_Login extends Controllers_Admin_Base 
{
    function indexAction(){
        
        //echo '用户登录页面';
        $this->display('admin/login');
    }
    
    /**
     * 登录验证码
     */
    public function captchaAction()
    {
        
        $this->com->captcha->display();
    }
}

?>