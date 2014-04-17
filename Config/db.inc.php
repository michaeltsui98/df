<?php

$dbConfig = array(
    '_db' => array(
        'adapter' => 'Mysqli',
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => '123456',
            'database' => 'df',
            'charset' => 'utf8',
            'table_prefix'=>'',
            'persitent' => false
        
    ),
     
    '_xhprofdb' => array(
        'adapter' => 'Pdo_Mysql',
        'host' => '172.16.0.3',
        'port' => 3306,
        'user' => 'cjsq',
        'password' => '1010',
        'database' => 'cjsq_xhprof',
        'charset' => 'utf8',
        'persistent' => true,
    ),
    '_commentDiscussdb' => array(
        'server' => 'mongodb://172.16.0.4:30000',
        'database' => 'cjsq'
    ),
     
    '_handlerSocker' => array(
        'host' => '172.16.0.3',
        'port' => 9998,
        'port_wr' => 9999,
        'options' => array()
    )
);
