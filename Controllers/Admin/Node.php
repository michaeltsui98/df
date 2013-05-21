<?php
/**
 * @var 教程管理
 * @author michael
 *
 */
class Controllers_Admin_Node extends Controllers_Admin_Base
{

    function __construct ()
    {
        parent::__construct();
        $this->tree = new Cola_Com_Tree();
        $this->tree->icon = array(
                '&nbsp;&nbsp;&nbsp;│ ',
                '&nbsp;&nbsp;&nbsp;├─ ',
                '&nbsp;&nbsp;&nbsp;└─ '
        );
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $this->model = Models_Node::init();
        // 数据验证规则
        $this->model->_validate = array(
                'base_fid' => array(
                        'required' => true,
                        'type' => 'number',
                        'msg' => '非法无效数据'
                ),
                'base_title' => array(
                        'required' => true,
                        'type' => 'string',
                        'msg' => '名称不能为空'
                ),
                'base_order' => array(
                        'required' => true,
                        'type' => 'number',
                        'msg' => '非法无效数据'
                )
        );
    }

    /**
     * 教程节点列表
     */
    function indexAction ()
    {
        $data = $this->model->getAllNode();
        $array = array();
        foreach ($data as $r) {
            $r['str_manage'] = '<a href="' . BASE_PATH .
                     '/index.php/Admin_Node/add/parentid/' . $r['id'] . '/id/' .
                     $this->request->get('menuid') . '">添加子节点</a> | <a href="' .
                     BASE_PATH . '/index.php/Admin_Node/edit/id/' . $r['id'] .
                     '">编辑</a> | <a href="javascript:confirmurl(\'' . BASE_PATH .
                     '/index.php/Admin_Node/del/id/' . $r['id'] . '\',\'确定删除' .
                     $r['name'] . '\')">删除</a> ';
            $array[] = $r;
        }
        
        $str = "<tr>
                        <td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$base_order' class='input-text-c'></td>
                        <td align='center'>\$id</td>
                        <td >\$spacer\$base_title</td>
                        <td align='center'>\$str_manage</td>
                </tr>";
        $this->tree->arr = $array;
        $this->view->selectCategorys = $this->tree->getTree(0, $str);
        
        $this->display('admin/Node/index');
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
                $this->messagePage(BASE_PATH . '/index.php/Admin_Node/index', 
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
            
            $data = $this->model->getAllNode();
            
            $array = array();
            foreach ($data as $r) {
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$base_title</option>";
            $this->tree->arr = $array;
            $this->view->selectCategorys = $this->tree->getTree(0, $str);
            $this->display('admin/Node/add');
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
                $this->messagePage(BASE_PATH . '/index.php/Admin_Node/index', 
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
            $result = $this->model->getAllNode();
            foreach ($result as $r) {
                $r['selected'] = $r['id'] == $info['base_fid'] ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$base_title</option>";
            $this->tree->arr = $array;
            $this->view->selectCategorys = $this->tree->getTree(0, $str);
            $this->view->info = $info;
            $this->display('admin/Node/edit');
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
            $this->messagePage(BASE_PATH . '/index.php/Admin_Node/index', 
                    '提交成功,正在返回!');
        } else {
            $this->messagePage('goback', '删除失败！');
        }
    }
    /**
     * 课程节点排序
     */
    function listOrderAction ()
    {
        if ($this->request->isPost()) {
            foreach ($_POST['listorders'] as $id => $listorder) {
                $id = intval($id);
                $listorder = (int)$listorder;
                $this->model->update($id, array(
                        'base_order' => $listorder
                ));
            }
            $this->sysLog();
            $this->messagePage(BASE_PATH . '/index.php/Admin_Node/index', 
                    '提交成功,正在返回!');
        } else {
            $this->messagePage('goback', '操作失败！');
        }
    }
}

