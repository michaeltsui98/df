<?php

class Controllers_Index extends Cola_Controller
{
    /**
     * @var Models_Index
     */
   protected static  $_model = NULL;
    
    function __construct(){
        //self::$_model = new Models_Index();
    }
    
    function indexAction(){
        
       

        
        
               
        self::request()->isAjax();
       
        
         /* echo "home_page".__FUNCTION__;
        echo '<br/>';
        //直接调用模型
        $m = new Models_Index();
        echo $m->test();
        //控制器调用控制器
        $nn = new Controllers_Dir_Net();
        echo $nn->indexAction();
        //直接调用带目录的模型
        echo "<p/>";
        $sub = new Models_Sub_net();
        echo $sub->subNet();
         */
         /* $res = Orm_DB::select()->from('keke_witkey_ad')
        ->where('ad_id', '=', '292')
        ->getCol()
        ->execute();  */
        //$model = new Models_Index();
       // $res = self::$_model->test();
       // $res = $this->model('Index','models')->test();
       //throw new Cola_Exception('eroror test');
        //$i = 5/0;
        //$model = new Models_Index();
        //$res = $model->testModel();
        
        //var_dump($res);
        
        $model = new Models_Index();
        $model->testCache(); 
        
       // Models_Sub_net::init()->subNet();
        
        $this->request->charset();
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