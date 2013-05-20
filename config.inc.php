<?php
$config = array(
    '_urls' => array(
        '/^view\/?(\d+)?$/' => array(
            'controller' => 'IndexController',
            'action' => 'viewAction',
        ),
    ),
    '_routecache' => array(
            'adapter' => 'File'
    ),
    '_db' => array(
        'adapter' => 'Mysqli',
        
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => '123456',
            'database' => 'test',
            'charset' => 'utf8',
            'persitent' => false
        
    ),
    '_xhprof' => array(
            'logDir' => 'D:\KKserv\wwwroot\xhprof\xhprof_log',
            'namespace' => 'df',
            'viewUrl' => 'http://localhost/xhprof/xhprof_html/index.php',
    ),

    '_modelsHome'      => 'Models',
    '_controllersHome' => 'Controllers',
    '_viewsHome'       => 'views',
    '_widgetsHome'     => 'widgets'
);
