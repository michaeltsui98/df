<?php

class Models_Admin_Video extends Cola_Model
{

    protected $_table = 'exam_video';

    public $find_arr = array(
            'id' => '编号',
            'vidoe_title' => '视频标题'
    );
    public $fs_config = array();

    public function getFsKey ($fileName)
    {
        return hash_hmac('md5', 'dodo_xue' . $fileName . time(), 'video');
    }
    
    public function initFs(){
        $fsConfig = $this->fs_config;
        return new Cola_Com_Mogilefs($fsConfig['domain'], $fsConfig['class'],
                $fsConfig['trackers']);
    }
    public function fileUpload ($key, $file)
    {
        return (bool) $this->initFs()->setFile($key, $file);
    }
    
    
}
