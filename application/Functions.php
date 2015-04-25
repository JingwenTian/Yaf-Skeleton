<?php 
//common functions
	
/**
 * 优雅打印
 */
function p()
{
	$args=func_get_args();  //获取多个参数
	if(count($args)<1){
		Debug::addmsg("<font color='red'>必须为p()函数提供参数!");
		return;
	}

	echo '<div style="width:100%;text-align:left; background-color: #fff;"><pre>';
	//多个参数循环输出
	foreach($args as $arg){
		if(is_array($arg)){
			print_r($arg);
			echo '<br>';
		}else if(is_string($arg)){
			echo $arg.'<br>';
		}else{
			var_dump($arg);
			echo '<br>';
		}
	}
	echo '</pre></div>';
}

/**
 * 时间轴函数
 * @param	int 	$time  参数：时间戳
 * return   string  $str   时间显示字符串: 刚刚/昨天 等
 */
function tranTime($time) { 
    $rtime = date("m-d H:i",$time); 
    $htime = date("H:i",$time); 
     
    $time = time() - $time; 
 
    if ($time < 60) { 
        $str = '刚刚'; 
    } 
    elseif ($time < 60 * 60) { 
        $min = floor($time/60); 
        $str = $min.'分钟前'; 
    } 
    elseif ($time < 60 * 60 * 24) { 
        $h = floor($time/(60*60)); 
        $str = $h.'小时前 '.$htime; 
    } 
    elseif ($time < 60 * 60 * 24 * 3) { 
        $d = floor($time/(60*60*24)); 
        if($d==1) 
           $str = '昨天 '.$rtime; 
        else 
           $str = '前天 '.$rtime; 
    } 
    else { 
        $str = $rtime; 
    } 
    return $str; 
} 

/**
 * getDescrShort 
 * 截取descr的长度
 * @param mixed $string  字符串
 * @param mixed $length  截取长度
 * @param string $dot    替换字符
 * @access public
 * @return void
 */
function getDescrShort($string, $length, $dot) {
	if (strlen($string) <= $length) {
	   return $string;
	}
	$pre = chr(1);
	$end = chr(1);
	$string = str_replace(array('&', '"', '<', '>'), array($pre . '&'. $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), $string);

	$strcut = '';
	if (@strtolower(CHARSET) == 'utf-8') {
	   $n = $tn = $noc = 0;
	   while ($n < strlen($string)) {

	       $t = ord($string[$n]);
	       if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
	           $tn = 1;
	           $n++;
	           $noc++;
	       } elseif (194 <= $t && $t <= 223) {
	           $tn = 2;
	           $n += 2;
	           $noc += 2;
	       } elseif (224 <= $t && $t <= 239) {
	           $tn = 3;
	           $n += 3;
	           $noc += 2;
	       } elseif (240 <= $t && $t <= 247) {
	           $tn = 4;
	           $n += 4;
	           $noc += 2;
	       } elseif (248 <= $t && $t <= 251) {
	           $tn = 5;
	           $n += 5;
	           $noc += 2;
	       } elseif ($t == 252 || $t == 253) {
	           $tn = 6;
	           $n += 6;
	           $noc += 2;
	       } else {
	           $n++;
	       }
	       if ($noc >= $length) {
	           break;
	       }
	   }
	   if ($noc > $length) {
	       $n -= $tn;
	   }
	   $strcut = substr($string, 0, $n);
	} else {
	   for ($i = 0; $i < $length; $i++) {
	       $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
	   }
	}
	$strcut = str_replace(array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), array('&', '"', '<', '>'), $strcut);

	$pos = strrpos($strcut, chr(1));
	if ($pos !== false) {
	   $strcut = substr($strcut, 0, $pos);
	}
	return $strcut . $dot;
}

/**
 * 获取用户真实 IP
 */
function getIP()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
 
    return $realip;
}

/***********************
**功能:将多维数组合并为一位数组
**$array:需要合并的数组
**$clearRepeated:是否清除并后的数组中得重复值
***********************/
function array_multiToSingle($array,$clearRepeated=false){
	if(!isset($array)||!is_array($array)||empty($array)){
		return false;
	}
	if(!in_array($clearRepeated,array('true','false',''))){
		return false;
	}
	static $result_array=array();
	foreach($array as $key=>$value){
		if(is_array($value)){
			array_multiToSingle($value);
		}else{
			$result_array[$key]=$value;
		}
	}
	if($clearRepeated){
		$result_array=array_unique($result_array);
	}
	return $result_array;
}
