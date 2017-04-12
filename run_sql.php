<?php

header('Content-type: text/html;charset=utf8');
session_start();
include('php/config.php');
include('php/functions.php');

$files = $_SESSION['sql'];
$to_process	= array_shift($_SESSION['sql']);

$dbh = new PDO('mysql:host='.MYSQL_HOST.';dbname='.get_arg('database') .';charset=utf8', get_arg('user'), get_arg('pass'));

$get_sql = file_get_contents($to_process);
unlink($to_process);

$split   = explode("\n", $get_sql);

foreach($split as $sql)
{
  if(empty($sql)) {
	return;
  }
  
  $stmt = $dbh->exec($sql);
  if(!$stmt) {
  	file_put_contents('error.txt', $sql . "\n" . implode(', ', $dbh->errorInfo())."\n", FILE_APPEND);
  }
}

echo count($split);

