<?php
include 'Config/const.inc.php';
include 'Config/url.inc.php';
include 'Config/db.inc.php';
include 'Config/cache.inc.php';
include 'Config/queue.inc.php';
include 'Config/fs.inc.php';
include 'Config/webservices.inc.php';
include 'Config/xhprof.inc.php';
$config = array(
    '_xhprof' => array(
            'logDir' => 'D:\KKserv\wwwroot\xhprof\xhprof_log',
            'namespace' => 'df',
            'viewUrl' => 'http://localhost/xhprof/xhprof_html/index.php',
    ),
    '_modules'=>array('Admin','Sm','Xl'),
    '_modelsHome'      => 'Models',
    '_controllersHome' => 'Controllers',
    '_viewsHome'       => 'views',
    '_widgetsHome'     => 'widgets'
);
$config = array_merge($config, $constConfig, $urlConfig, $cacheConfig, $dbConfig, $fsConfig, $queueConfig, $webServicesConfig, $xhprofConfig);
