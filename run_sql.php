<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

header('Content-type: text/html;charset=utf8');
session_start();
include('php/config.php');
include('php/functions.php');

$files = $_SESSION['sql'];


$to_process	 = array_shift($_SESSION['sql']);

mysql_connect($mysql['host'], get_arg('user'), get_arg('pass'));
mysql_select_db(get_arg('database'));

mysql_set_charset('utf8');

$get_sql = file_get_contents($to_process);
unlink($to_process);

$split   = explode("\n", $get_sql);

foreach($split as $x)
{
  if(empty($x)) return;
    
  mysql_query($x);
  $error = mysql_error();
  
  if(!empty($error)) file_put_contents('error.txt', $error."\n", FILE_APPEND);
}

echo '1';


mysql_close();

