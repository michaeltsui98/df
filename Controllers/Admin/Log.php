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
       
        $page = $this->getVar('page',1);
        $limit = 2;
        $this->view->fid =  $fid = $this->getVar('fid');
        $this->view->cond = $cond = $this->getVar('cond');
        $this->view->val= $val = $this->getVar('val');
        
        $this->view->fid_arr = $this->model->find_arr;
        
        $this->view->cond_arr = self::$cond_arr;
        
        $url = BASE_PATH."/index.php/Admin_Log/index/page/%page%/fid/$fid/cond/$cond/val/$val";
        
        $data = Models_Admin_Log::init()->dataList($page,$limit,$fid,$cond,$val,$url);
        
        $this->view->page = $data['page'];
        
        $this->view->data = $data['data'];
        
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

