<?php
session_start();
include('php/config.php');
include('php/functions.php');

function mres($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return '"'.str_replace($search, $replace, $value).'"';
}

$to_process	 = array_shift($_SESSION['files']);

//echo $to_process;

$content = file_get_contents($to_process);
$data    = unserialize($content);

if(!isset($_SESSION['headers_installed'])) {
	$sql = 'CREATE TABLE IF NOT EXISTS '.get_arg('table').'(';

	$table_header_array = $data[0];
	$data = array_splice($data, 1, count($data)-1);

	$table_columns = array();
	foreach($table_header_array as $column) {
		$table_columns[] = '`' . slug($column) . '`' . ' varchar(255) NOT NULL';
	}

	$sql .= implode(',', $table_columns). ') ENGINE=MyISAM DEFAULT CHARSET=utf8;'."\n";
	$_SESSION['headers_installed'] = true;
}
else {
	$sql = '';
}

foreach($data as $val)
{
	$val = array_map('mres', $val);
  	$sql .= 'INSERT INTO '.get_arg('table').' VALUES('.join(", ", $val).");\n";
}
  
$sql_file = 'sql/'. (1000-count($_SESSION['files'])) .'.sql';
if(!empty($sql)) file_put_contents($sql_file, $sql);

$_SESSION['sql'][] = $sql_file;

unlink($to_process);
echo 1;