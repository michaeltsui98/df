<?php

/**
 * @var 平台登录
 * @author michael
 *
 */
class Controllers_Sign extends Controllers_Base
{
    
    /**
     * 查看网盘
     */
    public  function indexAction ()
    {
        $dd = new Models_DDClient();
        //var_dump($this->getVar());
        if(!$this->xk){
             echo '学科参数错误';	
        }
        
        $requestUrl = '';
        $dd->getAuthorizeURL(DD_CALLBACK_URL);
        
        $this->view->appKey = DD_AKEY;
        $this->view->callBackUrl = DD_CALLBACK_URL;
        $this->view->state = DD_AKEY;
        
        $this->tpl();
 
    }
    
    public function callBackACtion(){
    	
    } 
 
    
    
}
