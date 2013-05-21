<?php
/**
 * @var 系统日志管理
 * @author michael
 *
 */
class Controllers_Admin_Log extends Controllers_Admin_Base
{

    function __construct ()
    {
        parent::__construct();
        $this->model = Models_Admin_Log::init();
        
    }

    /**
     * 日志列表
     */
    function indexAction ()
    {
       
        $p = $this->getVar('p',1);
        $limit = 2;
        $this->view->fid =  $fid = $this->getVar('fid');
        $this->view->cond = $cond = $this->getVar('cond');
        $val = $this->getVar('val');
        if($val AND $cond =='like'){
             $where =  "$fid   $cond '%$val%'";
        }elseif($val){
             $where =  "$fid   $cond '$val'";
        }
        
        $data = Models_Admin_Log::init()->getList($where,$p,$limit);
       
        $nav = BASE_PATH."/index.php/Admin_Log/index/p/%page%/fid/$fid/cond/$cond/val/$val";
        $pager = new Cola_Com_Pager($p, $limit, $data['totalItems'], $nav);
        $this->view->page = $pager->html();
        
        $this->view->data = $data['data'];
        
        $this->view->fid_arr = array('id'=>'编号','log_msg'=>'记录','user_name'=>'用户名','module_controller'=>'控制器');
        $this->view->cond_arr = array('=','>','<','like');
        
        $this->view->val = $val;
        //var_dump($data);
        $this->display('admin/Log/index');
    }
    function showInfoAction(){
        $id = (int)$this->getVar('id');
        $data = $this->model->load($id);
        $this->view->info = $data;
        $this->display('admin/Log/info');
    } 
    /**
     * 删除日志
     */
    function delAction ()
    {
        $id = intval($this->param('id'));
        //$info = $this->model->load($id);
        if ($this->model->delete($id)) {
            $this->sysLog();
            $this->messagePage(BASE_PATH . '/index.php/Admin_Log/index', 
                    '提交成功,正在返回!');
        } else {
            $this->messagePage('goback', '删除失败！');
        }
    }
    /**
     * 清空日志
     */
    function batDelAction(){
        $this->model->clear();
        $this->sysLog();
        $this->messagePage(BASE_PATH . '/index.php/Admin_Log/index',
                '提交成功,正在返回!');
    }
     
}

