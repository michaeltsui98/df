<?php
$config = array(
    '_urls' => array(
        '/^view\/?(\d+)?$/' => array(
            'controller' => 'IndexController',
            'action' => 'viewAction',
            'maps' => array(
                1 => 'id'
            ),
            'defaults' => array(
                'id' => 9527
            )
        ),

        '/^v-?(\d+)?$/' => array(
            'controller' => 'IndexController',
            'action' => 'viewAction',
            'maps' => array(
                1 => 'id'
            ),
            'defaults' => array(
                'id' => 9527
            )
        ),
        '/^dirNet\/(\w+)$/i' => array(
                'controller' => 'Controllers_Dir_Net',
                'action' => 'indexAction',
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
            'persitent' => true
        
    ),
    '_xhprof' => array(
            'logDir' => 'D:\KKserv\wwwroot\xhprof\xhprof_log',
            'namespace' => 'df',
            'viewUrl' => 'http://localhost/xhprof/xhprof_html/index.php',
    ),

    '_modelsHome'      => 'models',
    '_controllersHome' => 'controllers',
    '_viewsHome'       => 'views',
    '_widgetsHome'     => 'widgets'
);
