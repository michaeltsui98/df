<?php

//域名
define('DOMAIN_NAME', 'http://dev.dodoedu.com');
//静态文件,美工效果图片，CSS文件显示路径
define('HTTP_UI', 'http://dev-images.dodoedu.com/shequPage/');
//分布图片文件
define('HTTP_MFS_IMG', 'http://dev-images.dodoedu.com/image/');
//分布附件文件
define('HTTP_MFS_ATS', 'http://dev-images.dodoedu.com/attachments/');
//分布式网盘文件
define('HTTP_MFS_DISK', 'http://dev-images.dodoedu.com/download.php?');
//分布应用图标文件
define('HTTP_APP_IMG', 'http://dev-images.dodoedu.com/');
//文库的地址
define('HTTP_WENKU', 'http://dev-wenku.dodoedu.com/');
//模板缓存
define('TPL_CACHE', 0);

//后台管理的静态文件地址
define('STATIC_ADMIN_PATH', 'http://localhost/df/static/');


 

//Debug true显示报错信息，false 跳转到404页面
//define('DEBUG', TRUE);

$constConfig = array(
    
    '_gradeCode' => array(
        '01' => array(
            'xd' => 'xx',
            'name' => '小学一年级',
            'code' => '1'
        ),
        '02' => array(
            'xd' => 'xx',
            'name' => '小学二年级',
            'code' => '2'
        ),
        '03' => array(
            'xd' => 'xx',
            'name' => '小学三年级',
            'code' => '3'
        ),
        '04' => array(
            'xd' => 'xx',
            'name' => '小学四年级',
            'code' => '4'
        ),
        '05' => array(
            'xd' => 'xx',
            'name' => '小学五年级',
            'code' => '5'
        ),
        '06' => array(
            'xd' => 'xx',
            'name' => '小学六年级',
            'code' => '6'
        ),
        '07' => array(
            'xd' => 'cz',
            'name' => '初中一年级',
            'code' => '7'
        ),
        '08' => array(
            'xd' => 'cz',
            'name' => '初中二年级',
            'code' => '8'
        ),
        '09' => array(
            'xd' => 'cz',
            'name' => '初中三年级',
            'code' => '9'
        ),
        '10' => array(
            'xd' => 'gz',
            'name' => '高中一年级',
            'code' => '10'
        ),
        '11' => array(
            'xd' => 'gz',
            'name' => '高中二年级',
            'code' => '11'
        ),
        '12' => array(
            'xd' => 'gz',
            'name' => '高中三年级',
            'code' => '12'
        )
    ),
    '_userSex' => array(
        '1' => '男',
        '2' => '女'
    ),
    '_userRole' => array(
        '1' => '学生',
        '2' => '教师',
        '3' => '家长',
        '4' => '教育从业者'
    ),
    
    
     
);
