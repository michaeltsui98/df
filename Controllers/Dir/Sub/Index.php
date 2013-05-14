<?php
class Controllers_Dir_Sub_Index extends Cola_Controller{
    
    public function indexAction(){
        echo __CLASS__;
        
        $c = new Controllers_Index();
        $c->indexAction();
        
        
       echo  Models_Sub_net::init()->subNet();
       
       
        /* $m = new Models_Sub_net();
       echo  $m->subNet(); */
        
    }
}