<?php


class Controllers_Admin_Base extends Cola_Controller
{
    
    static $cond_arr = array('=','>','<','like');
    function __construct(){
       
       isset($_SESSION) OR session_start();
       $data['roleid']  = 1;
       $data['uid'] = '123';
       $data['real_name'] = '张老师';
       $_SESSION['user'] = $data;
       
       $this->checkLogin();
    }
    
    /**
     * 用户登录验证
     * @return boolean
     */
    private function checkLogin()
    {
        if (!isset($_SESSION['user'])) {
            $this->response->alert('您还没有登录或登录有效时间已经过期，请重新登录系统！', BASE_PATH.'/index.php/Admin_Login/index');
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
    
        //$fundoc = trim(substr($fundoc, 11,-2));
        preg_match('/\*[\s]+?([^ ]+)\n/i', $fundoc,$fat);
        preg_match('/@var[\s]*([^ ]+)\n/i', $clsdoc,$mat);
        $data['controller'] = $cola['controller'];
        $data['c']  = substr($cola['controller'], 12);
        $data['action']  = $cola['action'];
        $data['a'] = substr($cola['action'], 0,-6);
        $data['clsdoc'] = trim($mat[1]);
        $data['fundoc'] = trim($fat[1]);
        return $data;
    }
    /**
     * 生成系统操作日志
     * @param string $msg
     */
    function sysLog($msg=NULL){
        $info = $this->getComment();
        $prefix = $info['clsdoc'].'/'.$info['fundoc'].'/';
        $data['log_msg'] = $prefix .$msg;
        $data['module_controller']  = $info['c'];
        $data['module_action']  = $info['a'];
        $data['uid'] = $_SESSION['user']['uid'];
        $data['user_name']  =  $_SESSION['user']['real_name'];
        $data['log_time'] = $_SERVER['REQUEST_TIME'];
        $model = new Models_Admin_Log;
        $model->insert($data);
    }
}

?>