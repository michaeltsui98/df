<?php


class Controllers_Admin_Base extends Cola_Controller
{
    function __construct(){
       // $this->checkLogin();
    }
    
    /**
     * 用户登录验证
     * @return boolean
     */
    private function checkLogin()
    {
        if (!isset($_SESSION['user'])) {
            $this->response->alert('您还没有登录或登录有效时间已经过期，请重新登录系统！', '/index.php/Admin_Login/index');
            exit;
        }
        return true;
    }
    
    /**
     * 获取当前请求的Action的信息
     * @return array
     */
    function getComment(){
        $cola = Cola::getInstance()->getDispatchInfo();
        $rc = new ReflectionClass($cola['controller']);
         
        $fundoc = $rc->getMethod($cola['action'])->getDocComment();
        $clsdoc = $rc->getDocComment();
    
        $fundoc = trim(substr($fundoc, 11,-2));
        preg_match('/@var[\s]*([^ ]+)\n/i', $clsdoc,$mat);
        $data['controller'] = $cola['controller'];
        $data['action']  = $cola['action'];
        $data['clsdoc'] = $mat[1];
        $data['fundoc'] = $fundoc;
    
        return $data;
    }
    /**
     * 生成系统操作日志
     * @param string $msg
     */
    function sysLog($msg){
        
    }
}

?>