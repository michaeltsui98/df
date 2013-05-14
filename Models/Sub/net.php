<?php

class Models_Sub_net extends Cola_Model
{
    protected static $_instance = NULL;
    /**
     * 
     * @return self
     */
    public static function init(){
        if(self::$_instance ===NULL){
            return self::$_instance = new static();
        }
        return self::$_instance;
    }
    
    function subNet(){
       //$this->db()->col();
       $sql = "select ad_id from keke_witkey_ad where ad_id= 292";
       return $this->db()->col($sql);
    }
    
    function objNet(){
        return Orm_DB::select('ad_id')
        ->from('keke_witkey_ad')
        ->where('ad_id', '=', 292)
        ->getCol()
        ->execute();
    }
}

?>