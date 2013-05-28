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

    function dataList ($page = 1, $pageSize = 20, $fid,$cond,$val,$url)
    {
        $wh = '1';
        
        if ($val and $cond == 'like') {
            $wh .= " AND $fid   $cond '%$val%'";
        } elseif ($val) {
            $wh .= " AND $fid   $cond '$val'";
        }
         
        $where = $wh;
        
        $page = intval($page);
        
        $pageSize = intval($pageSize);
        
        $count = $this->count($where);
        
        $limit = $this->getLimit($count, $pageSize, $page);
        
        $paper = new Cola_Com_Pager($page, $pageSize, $count, $url);
        
        $pageHtml = $paper->html();
        
        $sql = "SELECT * FROM $this->_table WHERE {$where}  {$limit}";
        
        $data = (array) $this->sql($sql);
        
        $result = array(
                'data' => $data,
                'page' => $pageHtml
        );
        return $result;
    }

    /**
     * 清空日志
     */
    function clear ()
    {
        $sql = "delete from $this->_table";
        return $this->sql($sql);
    }
}
