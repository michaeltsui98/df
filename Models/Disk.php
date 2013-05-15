<?php
class Models_Disk extends  Cola_Model{
    
    public function getDiskCount(){
        return Tables_Model::factory('ndisk')->count();
    }
    
}