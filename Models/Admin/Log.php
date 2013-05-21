<?php

class Models_Admin_Log extends Cola_Model
{
    protected  $_table = 'sys_log';
    
    function add($data){
        return $this->insert($data);
    }
    
    function getList($where  = "", $page = 1, $pageSize = 20){
        
//         var_dump(func_get_args());
        $wh = '1';
        if($where){
            $wh .= ' and '.$where;
        }
        $where = $wh;
        
        $page = intval($page);
        
        $pageSize = intval($pageSize);
       
        $count = $this->count($where);
        
         $limit = $this->getLimit($count, $pageSize, $page);
        
        //die;
        $data =(array) $this->sql("SELECT * FROM $this->_table WHERE {$where}  {$limit}");
        
        $result = array(
                 
                'totalItems' => $count,
                'data' => $data
        );
        return $result;
    }
    
    function getLimit($count, $limit, $page){
        $count = intval($count);
        $limit = intval($limit);
         
        if ($count > 0 && $limit > 0) {
            $total_pages = ceil ( $count / $limit );
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        
        $start = $limit * $page - $limit;
        if ($start < 0){
            $start = 0;
        }
        return " LIMIT " . $start . " ," . $limit;
        
    }
    /**
     * 清空日志
     */
    function clear(){
        $sql = "delete from $this->_table";
        return $this->sql($sql);
    }
}
