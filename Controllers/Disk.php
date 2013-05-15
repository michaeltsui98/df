<?php

class Controllers_Disk extends Cola_Controller
{
      function indexAction(){
          
          $this->view->a = 'test';
          
          $t = new Tables_ndisk();
          $row = $t->row();
          $this->view->row = $row;
          $this->display('index');
           
      }    
}
