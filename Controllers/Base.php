<?php

/**
 * @var  控制器基类
 * @author michael
 *
 */

include S_ROOT.'Models/AdminFunc.php';

class Controllers_Base extends Cola_Controller
{
    public $c;
    
    public $a;
    
    public $xk;
    
    public function before(){
        $this->xk  = $this->getVar('xk');
        $this->c = Cola::getInstance()->dispatchInfo['controller'];
        $this->a = Cola::getInstance()->dispatchInfo['action'];
        define('XK', $this->xk);
    }
    
    public function __construct(){
    	$this->before();
    }
    
    
}
