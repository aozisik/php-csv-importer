<?php
session_start();

$_SESSION['files'] = array();              
$_SESSION['sql']   = array();
$filepaths				 = array();
$filemtimes				 = array();


function sortArrayByArray(array $toSort, array $sortByValuesAsKeys)
{
    $commonKeysInOrder = array_intersect_key(array_flip($sortByValuesAsKeys), $toSort);
    $commonKeysWithValue = array_intersect_key($toSort, $commonKeysInOrder);
    $sorted = array_merge($commonKeysInOrder, $commonKeysWithValue);
    return $sorted;
}

$handler = opendir('tmp');
$count = 0;
while($r = readdir($handler))
{
  $file = 'tmp/' .$r;
	$ext  = pathinfo($file, PATHINFO_EXTENSION);
  if(is_file($file) and is_readable($file) and $ext == 'dat'){
  	
		$filepaths[]  = $file;
    $count++;
  } 
} 

$_SESSION['files'] = $filepaths;


closedir($handler);
echo json_encode($count);