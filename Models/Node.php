<?php
/**
 * 基本节点管理 
 * @author michael
 *
 */
class Models_Node extends Cola_Model
{
    
    protected $_table = 'node_base';
    /**
     * 按父ID查找模型子节点
     * @param int $parentid
     * @param int $with_self
     * @return Ambigous <multitype:, multitype:unknown , boolean, mixed, resource>
     */
    function getNode($parentid=0, $with_self = 0){
            $parentid = intval($parentid);
            $result = $this->sql(
                    "SELECT * FROM $this->_table WHERE base_fid={$parentid} ORDER BY base_order ASC;");
            if ($with_self) {
                $result2[] = $this->db->row(
                        "SELECT * FROM $this->_table WHERE id={$parentid}");
                $result = array_merge($result2, $result);
            }
            return (array)$result;
            
    }
    /**
     * 获取所有的节点
     * @param string $fds
     * @return Ambigous <multitype:, boolean, mixed, resource>
     */
    function getAllNode($fields='*'){
         return (array)$this->sql("SELECT {$fields},base_fid as parentid FROM $this->_table ORDER BY base_order ASC,id DESC");
        
    }
    
    function getInfo($id){
        return $this->db()->row("select * from $this->_table where id = $id");
    }
    
    
    
    
}
