<?php
// 获取权限
function get_mod($filepath){
    return substr(base_convert(@fileperms($filepath),10,8),-3,1);
}
//文件所有都
function get_own($filepath){
    return posix_getpwuid(fileowner($filepath))['name'];
}
/**
 * 不重名生成日期目录加随机文件名   如：201412/Dad83ad.js
 * @param       string      folder     目录路径
 * @return      str    
 */
function random_name($folder,$ext='jpg',$len=8){
	$folder=rtrim($folder,'/\\');
	do{
		$random=substr(str_shuffle(str_repeat('ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789', 5)), 0, $len);
		$date_dir = date('Ym');
		@mkdir($folder.'/'.$date_dir,0755,true);
		$file_name=$date_dir.'/'.$random.'.'.$ext;
	}while(is_file($folder.'/'.$file_name));  
	return $file_name;
}

/**
 * 取得当前的域名 完整 协议 +域名/ip+端口 https://www.jetee.cn:8080
 *
 * @access  public
 *
 * @return  string      当前的域名
 */
function getDomain()
{
	static $get_domain=null;
	if($get_domain!==null)	{
		return $get_domain;
	}
	/* 协议 */
	$protocol = is_ssl()?'https://':'http://';

	/* 域名或IP地址 */
	if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])){
		$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
	}elseif (isset($_SERVER['HTTP_HOST'])){
		$host = $_SERVER['HTTP_HOST'];
	}else{
		/* 端口 */
		if (isset($_SERVER['SERVER_PORT']))	{
			$port = ':' . $_SERVER['SERVER_PORT'];
			if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol)){
				$port = '';
			}
		}else{
			$port = '';
		}
		
		if (isset($_SERVER['SERVER_NAME']))	{
			$host = $_SERVER['SERVER_NAME'] . $port;
		}elseif (isset($_SERVER['SERVER_ADDR'])){
			$host = $_SERVER['SERVER_ADDR'] . $port;
		}
	}
	return $get_domain=$protocol . $host;
}
/**
 * 判断是否SSL协议
 * @return boolean
 */
function is_ssl() {
	if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
		return true;
	}elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
		return true;
	}
	return false;
}
