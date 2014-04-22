<?php

class Controllers_Index extends Cola_Controller
{
    /**
     * @var Models_Index
     */
   protected static  $_model = NULL;
 
    
    function indexAction(){
            
    	 $pageTitle = '首页信息测试';
    	
         $layout = 'layout/index';
         $this->setLayout($layout);
         
       
         $this->view->vars = get_defined_vars();
        
         $this->tpl();
          
    }
    function setCacheAction(){
        $res = Cola::cache('test','i love you ',6000);
        
    }
    function getCacheAction(){
         
         
        phpinfo();
    }
 
    
    function testOrmAction(){
        $model = new Models_Index();
        $res = $model->orm();
        var_dump($res);
    }
    function delAction(){
        $res = self::$_model->ormDel();
        var_dump($res);
    }
    function updateAction(){
        $res = self::$_model->ormUpdate();
        var_dump($res);
    }
    function insertAction(){
        $res = self::$_model->ormInsert();
        var_dump($res);
    }
    function tableAction(){
        $res = self::$_model->tableQuery();
        var_dump($res);
    }
    function modelAction(){
        $res = self::$_model->modelCount();
        var_dump($res);
    }
    function modelInsertAction(){
        $res = self::$_model->modelInsert();
        var_dump($res);
    }
    function modelUpdateAction(){
        $res = self::$_model->modelUpdate();
        var_dump($res);
    }
    function modelDelAction(){
        $res = self::$_model->modelDel();
        var_dump($res);
    }
    
    
}

?>