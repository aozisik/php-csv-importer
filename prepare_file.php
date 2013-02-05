<?php
/*
* CSV IMPORT
*
* @version 0.3
* @author Ahmet Özışık
*/
session_start();
require('php/functions.php');

$handler     = file('csv/'.$_GET['name']);

if(isset($_SESSION['headers_installed']))
{
	unset($_SESSION['headers_installed']);
}

if(!$handler) die('Cannot handle');

$outcount = 1;
$count  = 0;
$array  = array();
$split  = array();

$_SESSION['args'] = $_GET;


function make_tmp_file($array)
{
	global $outcount;
  file_put_contents('tmp/tmpfile_'.sprintf("%04d", $outcount).'.dat', serialize($array));    
}

foreach($handler as $line)
{
                    
	
  $get = str_getcsv($line, get_arg('seperator'), get_arg('wrapper'));
	
  if(empty($get)) continue;
  array_push($array, $get);
  
  // Takes memory under control
  if($count == 1000)
  {

    make_tmp_file($array);
    unset($array);
    $array = array();
    $count = 0;
		$outcount++;
		
  }
  
  $count++;
}

make_tmp_file($array);
unset($array);
 
echo json_encode($outcount);


