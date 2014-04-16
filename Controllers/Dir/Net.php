<?php

class Controllers_Dir_Net extends Cola_Controller
{
    function indexAction(){
        
        echo "中文输入出";
        echo  'class:'.__CLASS__."function:".__FUNCTION__;
    }
    function testAction(){
        //$sql = "select 'ad_id' from keke_witkey_ad where ad_id= 292";
        //$res = Kohana_DB::query(Kohana_Database::SELECT, $sql)->execute();
        
      // $res =  Models_Sub_net::init()->subNet();

    	
    	/* $res = Orm_DB::select('log_msg')
            ->from('sys_log')
            ->where('id', '=', 14)
            ->getCol()
            ->execute(); */ 
    	$res = Cola_Model::init()->table('sys_log')->count('1');
        
        var_dump($res);
    }
    function objAction(){
        $res = Models_Sub_net::init()->objNet();
        var_dump($res);
    }    
}

?>