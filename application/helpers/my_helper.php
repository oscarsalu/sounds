<?php

function check_live_server()
{ 
   $whitelist = array('127.0.0.1', "::1");
    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        return true;
    }else{
        return false;
    }                         
      
}
function exec_ffmeg($cmd)
{ 
    $FFMPEG_PATH = FCPATH .'application/libraries/ffmpeg/bin/ffmpeg.exe';
    if(check_live_server()){
   
         $res = exec('ffmpeg '. $cmd);
        
       // var_dump($return);
    }else if(PHP_OS=="Linux"){
       
       
        $res = exec('ffmpeg '. $cmd);
    
    } else {
        $res = exec($FFMPEG_PATH.' '. $cmd,$output,$return); 
    }
    return $res;
}
function time_to_seconds($str_time){
    $duration = explode(":",$str_time); 
    if(!empty($duration[0])){
        return $duration[0]*3600 + $duration[1]*60+ round($duration[2]); 
    }  return 0;
      
}
function formatSizeUnits($bytes)
{
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
function time_calculation($timestamp)
{
    
    $period  = array(
        "second",
        "minute",
        "hour",
        "day",
        "week",
        "month",
        "year",
        "decade"
    );
    $periods = array(
        "seconds",
        "minutes",
        "hours",
        "days",
        "weeks",
        "months",
        "years",
        "decades"
    );

    $lengths    = array(60,60,24,7,4.35,12,10);
    $timenow    = date("Y-m-d H:i:s");
    $now        = strtotime('now');
    $difference = $now - $timestamp;
    $tense      = "ago";
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
        $per = $periods[$j];
    } else {
        $per = $period[$j];
    }
    
    $string_result = $difference . " " . $per . " ago";
    
    return $string_result;
}
/**
* Echo text limit 
* Limiting the output of PHP's echo to $length characters
* @param string $x
* @param int $length
* @return string
*/
function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}
/**
* Echo text limit 
* Limiting the output of PHP's echo to $length characters
* @param string $str
* @param int $stringMaxLength
* @return string
*/
function custom_echo_html($str, $stringMaxLength)
{
    $text = strip_tags($str);
    $desLength 	=   strlen($text);        
    if($desLength > $stringMaxLength){
        $des			= substr($text,0,$stringMaxLength); 
        $text = $des.'...';   
        echo $text;
    }else{
        echo $text;
    }                   
}
?>