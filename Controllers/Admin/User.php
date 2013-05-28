<?php
/**
 * @var 用户管理
 * @author michael
 *
 */
class Controllers_Admin_User extends Controllers_Admin_Base
{

    function __construct ()
    {
        parent::__construct();
         
    }

    /**
     * 教程节点列表
     */
    function indexAction ()
    {
        $this->display('admin/User/index');
    }
    /**
     * 添加课程节点
     */
    function addAction ()
    {
        if ($this->request->isPost()) {
            
            if ($this->model->validate($_POST['info'], true)) {
                // 插入数据
                $this->model->insert($this->post('info'));
                //生成系统日志
                $this->sysLog($_POST['info']['base_title']);
                // 成功消息与跳转
                $this->messagePage(BASE_PATH . '/index.php/Admin_User/index', 
                        '提交成功,正在返回!');
            } else {
                $error = $this->model->error();
                $msg = '';
                foreach ($error['msg'] as $key => $value) {
                    $msg .= '参数：' . $key . '，' . $value . "<br />\n";
                }
                $this->messagePage('goback', $msg);
            }
        } else {
            
            $parentid = (int) $this->request->param('parentid');
            
            $data = $this->model->getAllUser();
            
            $array = array();
            foreach ($data as $r) {
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$base_title</option>";
            $this->tree->arr = $array;
            $this->view->selectCategorys = $this->tree->getTree(0, $str);
            $this->display('admin/User/add');
        }
    }
    /**
     * 编辑课程节点
     */
    function editAction ()
    {
        if ($this->request->isPost()) {
            $id = intval($this->request->post('id'));
            if ($this->model->validate($_POST['info'], true)) {
                // 插入数据
                $this->model->update($id, $_POST['info']);
                $this->sysLog($_POST['info']['base_title']);
                // 成功消息与跳转
                $this->messagePage(BASE_PATH . '/index.php/Admin_User/index', 
                        '提交成功,正在返回!');
            } else {
                $error = $this->model->error();
                $msg = '';
                foreach ($error['msg'] as $key => $value) {
                    $msg .= '参数：' . $key . '，' . $value . "<br />\n";
                }
                $this->messagePage('goback', $msg);
            }
        } else {
            $id = intval($this->request->param('id'));
            $info = $this->model->getInfo($id);
            $result = $this->model->getAllUser();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $info['base_fid'] ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$base_title</option>";
            $this->tree->arr = $array;
            $this->view->selectCategorys = $this->tree->getTree(0, $str);
            $this->view->info = $info;
            $this->display('admin/User/edit');
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
            $this->messagePage(BASE_PATH . '/index.php/Admin_User/index', 
                    '提交成功,正在返回!');
        } else {
            $this->messagePage('goback', '删除失败！');
        }
    }
}

