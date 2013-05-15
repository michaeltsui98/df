<?php

class Controllers_Disk extends Cola_Controller
{
      function indexAction(){
          
          $this->view->row = Models_Disk::init()->getDiskCount();
           
          $this->display('index');
           
      }    
}
