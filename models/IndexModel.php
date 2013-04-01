<?php
class IndexModel extends Cola_Model
{
    protected $_pk = 'ad_id';
    protected $_table = 'keke_witkey_ad';

    public function test()
    {
       // $res = $this->find(array('where'=>'ad_id=sa'));
        
        //var_dump($res);die;
        $sql = "select ad_id from keke_witkey_ad where ad_id = 292";
        //throw new Cola_Exception($sql);die;
        return $this->db()->col($sql);
        
    }
}