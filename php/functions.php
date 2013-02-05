<?php

function list_csv_files($folder)
{
  $handler = opendir($folder);
  
  while($read = readdir($handler))
  {
    $file = $folder.'/' .$read;
		
		$extension = substr($file, strlen($file)-3, 3);
    
    if(is_file($file) and is_readable($file) and $extension == 'csv')
      echo '<option value="'.$read.'">'.$read.'</option>';
  }
}

function slug($str)
{
  $str = str_replace(array('ğ', 'Ğ', 'İ', 'ı', 'ü', 'Ü', 'ş', 'Ş', 'ö', 'Ö', 'ç', 'Ç'), array('g', 'g', 'i', 'i', 'u', 'u', 's', 's', 'o', 'o', 'c', 'c'), $str); 
  
  $str = strtolower(trim($str));
  $str = preg_replace('/[^a-z0-9-]/', '_', $str);
  $str = preg_replace('/-+/', "_", $str);
  return $str;
}


function get_arg($arg_name)
{
	if(!isset($_SESSION['args']))
	{
		return '';
	}
	
	return (!isset($_SESSION['args'][$arg_name])) ? '' : $_SESSION['args'][$arg_name]; 
}

if (!function_exists('str_getcsv')) 
{
    function str_getcsv($input, $delimiter = ',', $enclosure = '"', $escape = '\\', $eol = '\n') {
        if (is_string($input) && !empty($input)) {
            $output = array();
            $tmp    = preg_split("/".$eol."/",$input);
            if (is_array($tmp) && !empty($tmp)) {
                while (list($line_num, $line) = each($tmp)) {
                    if (preg_match("/".$escape.$enclosure."/",$line)) {
                        while ($strlen = strlen($line)) {
                            $pos_delimiter       = strpos($line,$delimiter);
                            $pos_enclosure_start = strpos($line,$enclosure);
                            if (
                                is_int($pos_delimiter) && is_int($pos_enclosure_start)
                                && ($pos_enclosure_start < $pos_delimiter)
                                ) {
                                $enclosed_str = substr($line,1);
                                $pos_enclosure_end = strpos($enclosed_str,$enclosure);
                                $enclosed_str = substr($enclosed_str,0,$pos_enclosure_end);
                                $output[$line_num][] = $enclosed_str;
                                $offset = $pos_enclosure_end+3;
                            } else {
                                if (empty($pos_delimiter) && empty($pos_enclosure_start)) {
                                    $output[$line_num][] = substr($line,0);
                                    $offset = strlen($line);
                                } else {
                                    $output[$line_num][] = substr($line,0,$pos_delimiter);
                                    $offset = (
                                                !empty($pos_enclosure_start)
                                                && ($pos_enclosure_start < $pos_delimiter)
                                                )
                                                ?$pos_enclosure_start
                                                :$pos_delimiter+1;
                                }
                            }
                            $line = substr($line,$offset);
                        }
                    } else {
                        $line = preg_split("/".$delimiter."/",$line);
   
                        /*
                         * Validating against pesky extra line breaks creating false rows.
                         */
                        if (is_array($line) && !empty($line[0])) {
                            $output[$line_num] = $line;
                        } 
                    }
                }
                return $output;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}