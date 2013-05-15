<?php

class Controllers_Disk extends Cola_Controller
{
      function indexAction(){
          
          $disk = new Tables_ndisk();
          echo $disk->setWhere('disk_id = 2')->col('obj_id');
          //$ra = $disk->setWhere('disk_id = 2')->row();
          
          $ra = Orm_DB::select()->from('ndisk')->where('disk_id', '=', '2')->and_where('obj_type', '>', 0)
          ->getRow()->execute();
          var_dump($ra);
           
      }    
}
