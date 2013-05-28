<?php

class Models_Admin_Log extends Cola_Model
{

    protected $_table = 'sys_log';

    public $find_arr = array(
            'id' => '编号',
            'log_msg' => '记录',
            'user_name' => '用户名',
            'module_controller' => '控制器'
    );


    /**
     * 清空日志
     */
    function clear ()
    {
        $sql = "delete from $this->_table";
        return $this->sql($sql);
    }
}
