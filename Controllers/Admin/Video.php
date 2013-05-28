<?php

/**
 * @var 视频管理
 * @author michael
 *
 */
class Controllers_Admin_Video extends Controllers_Admin_Base
{

    function __construct ()
    {
        parent::__construct();
        $this->model = Models_Admin_Video::init();
    }

    /**
     * 教程节点列表
     */
    function indexAction ()
    {
        $page = $this->getVar('page', 1);
        $limit = 10;
        
        $this->view->fid = $fid = $this->getVar('fid');
        $this->view->cond = $cond = $this->getVar('cond');
        $this->view->val = $val = $this->getVar('val');
        
        $this->view->fid_arr = $this->model->find_arr;
        
        $this->view->cond_arr = self::$cond_arr;
        
        $url = BASE_PATH .
                 "/index.php/Admin_Video/index/page/%page%/fid/$fid/cond/$cond/val/$val";
        
        $data = Models_Admin_Video::init()->dataList($page, $limit, $fid, $cond, 
                $val, $url,' order by video_order asc ');
        
        $this->view->page = $data['page'];
        
        $this->view->data = $data['data'];
        
        $this->display('admin/Video/index');
    }

    /**
     * 添加课程节点
     */
    function addAction ()
    {
        
        $upload['sid'] = session_id();
        $upload['timestamp'] = time();
        $upload['token'] =  md5('unique_salt' . $upload['timestamp']);
         
        $this->display('admin/Video/add');
    }
    
    function fileUploadDoneAction(){
        $verifyToken = md5('unique_salt' . $this->post('timestamp'));
        if (! empty($_FILES) && $_POST['token'] == $verifyToken) {
            $data = array();
            $data['tempFile'] = $_FILES['Filedata']['tmp_name'];
            
            $data['fileKey'] = $this->model->getFsKey($_FILES['Filedata']['name']);
        
            $data['fileOriSize'] = $_FILES['Filedata']['size'];
            $data['fileName'] = $_FILES['Filedata']['name'];
            $isUpload = $this->model->fileUpload($data['fileKey'], $data['tempFile']);
            if ($isUpload === TRUE) {
                echo (int)  $data['fileKey'];
            } else {
                echo 'upload file fail';
            }
        }
    }

    function addDoneAction ()
    {
        if ($this->model->validate($_POST['info'], true)) {
            
            $this->model->insert($this->post('info'));
            
            $this->sysLog($_POST['info']['vido_title']);
            
            $this->messagePage(BASE_PATH . '/index.php/Admin_Video/index', 
                    '提交成功,正在返回!');
            
        } else {
            $error = $this->model->error();
            $msg = '';
            foreach ($error['msg'] as $key => $value) {
                $msg .= '参数：' . $key . '，' . $value . "<br />\n";
            }
            $this->messagePage('goback', $msg);
        }
    }

    /**
     * 编辑课程节点
     */
    function editAction ()
    {
        $id = intval($this->request->param('id'));
        $info = $this->model->load($id);
        
        $this->view->info = $info;
        $this->display('admin/Video/edit');
    }

    function editDoneAction ()
    {
        $id = intval($this->request->post('id'));
        if ($this->model->validate($_POST['info'], true)) {
            // 插入数据
            $this->model->update($id, $_POST['info']);
            $this->sysLog($_POST['info']['base_title']);
            // 成功消息与跳转
            $this->messagePage(BASE_PATH . '/index.php/Admin_Video/index', 
                    '提交成功,正在返回!');
        } else {
            $error = $this->model->error();
            $msg = '';
            foreach ($error['msg'] as $key => $value) {
                $msg .= '参数：' . $key . '，' . $value . "<br />\n";
            }
            $this->messagePage('goback', $msg);
        }
    }

    /**
     * 删除课程节点
     */
    function delAction ()
    {
        $id = intval($this->request->param('id'));
        $info = $this->model->getInfo($id);
        if ($this->model->delete($id)) {
            $this->sysLog($info['base_title']);
            $this->messagePage(BASE_PATH . '/index.php/Admin_Video/index', 
                    '提交成功,正在返回!');
        } else {
            $this->messagePage('goback', '删除失败！');
        }
    }
}

