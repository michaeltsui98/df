<?php
error_reporting ( E_ALL | E_STRICT );
ini_set ( 'display_errors', 'on' );
date_default_timezone_set ( 'Asia/Shanghai' );
mb_internal_encoding ( 'utf-8' );
define ( 'DEBUG', FALSE );
header ( "Content-Type:text/html;charset=utf-8" );
define('S_ROOT', __DIR__.DIRECTORY_SEPARATOR);
define('BASE_PATH', '/df');
require 'Cola/Cola.php';
$cola = Cola::getInstance ();

$xh = new Cola_Com_Xhprof ();
//$benchmark = new Cola_Com_Benchmark ();
$cola->boot ()->dispatch ();
//echo "<br />cost:", $benchmark->cost (), 's';
echo $a = $xh->save ();