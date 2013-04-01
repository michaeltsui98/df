<?php

class Controllers_Index extends Cola_Controller
{
    /**
     * @var Models_Index
     */
    protected $_model = NULL;
    
    function __construct(){
        $this->_model = new Models_Index();
    }
    
    function indexAction(){
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
        $res = $this->_model->test();
       // $res = $this->model('Index','models')->test();
        var_dump($res); 
    }
    function testOrmAction(){
        $model = new Models_Index();
        $res = $model->orm();
        var_dump($res);
    }
    function delAction(){
        $res = $this->_model->ormDel();
        var_dump($res);
    }
    function updateAction(){
        $res = $this->_model->ormUpdate();
        var_dump($res);
    }
    function insertAction(){
        $res = $this->_model->ormInsert();
        var_dump($res);
    }
    function tableAction(){
        $res = $this->_model->tableQuery();
        var_dump($res);
    }
    function modelAction(){
        $res = $this->_model->modelCount();
        var_dump($res);
    }
    function modelInsertAction(){
        $res = $this->_model->modelInsert();
        var_dump($res);
    }
    function modelUpdateAction(){
        $res = $this->_model->modelUpdate();
        var_dump($res);
    }
    function modelDelAction(){
        $res = $this->_model->modelDel();
        var_dump($res);
    }
    
    
}

?>