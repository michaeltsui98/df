<?php
error_reporting(E_ALL|E_STRICT);

define('S_ROOT', __DIR__);

ini_set('display_errors', 'on');

date_default_timezone_set('Asia/Shanghai');

//define('COLA_ROOT', dirname(__DIR__));

require 'Cola/Cola.php';


$cola = Cola::getInstance();
$xh =  new Cola_Com_Xhprof();
$benchmark = new Cola_Com_Benchmark();

$cola->boot()->dispatch();

  

echo "<br />cost:", $benchmark->cost(), 's';

echo  $a = $xh->save();