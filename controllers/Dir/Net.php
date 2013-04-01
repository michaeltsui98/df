<?php

class Controllers_Dir_Net extends Cola_Controller
{
    function indexAction(){
        
        echo "中文输入出";
        echo  'class:'.__CLASS__."function:".__FUNCTION__;
    }
    function testAction(){
        $sql = "select * from keke_witkey_ad where ad_id= 292";
        //$res = Kohana_DB::query(Kohana_Database::SELECT, $sql)->execute();
        $res = Kohana_DB::select('ad_id')
            ->from('keke_witkey_ad')
            ->where('ad_id', '=', 292)
            ->getCol()
            ->execute();
        /* $res = Kohana_DB::update('keke_witkey_ad')
        ->set(array('listorder'=>Kohana_DB::expr('listorder+1')))
        ->where('ad_id', '=', 292)
        ->execute(); */
        Cola_DB::test();
        
        var_dump($res);
    }    
}

?>