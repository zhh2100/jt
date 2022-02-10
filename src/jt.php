<?php
namespace jetee\jt;
class Jt
{
	public $script_name;
	public $root;
	public $rootPath;
	public $jtPath;
	public function init()
	{
		$this->script_name=$_SERVER['SCRIPT_NAME'];							#/blog/jt.php
		$this->root=str_replace('\\', '/', dirname($this->script_name));	#/blog/
		if($this->root!='/')$this->root.='/';								#/blog/  或 /
		$this->rootPath=str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).$this->root;#/www/wwwroot/public/blog/
		$this->jtPath=__DIR__.'/';													  #/www/wwwroot/vendor/jetee/jt/src/

		$act=$_REQUEST['act'];
		if(empty($act)){
			$this->create();
		}elseif(in_array($act,['getLists','getContent','doCreate'])){
			$this->$act();
		}
	}
	private function doCreate(){
		$id_api=$_REQUEST['id_api'];
		$content_api=$_REQUEST['content_api'];
		$template=$_REQUEST['template'];

		set_time_limit(0);
		header('Cache-Control: no-cache');//禁用浏览器缓存
		header('X-Accel-Buffering: no');  //适用于Nginx服务器环境
		ob_end_flush(); //重点:禁止PHP缓存数据		
		$ids=file_get_contents($id_api);
		$ids=json_decode($ids);
		if(!$ids){
			die('获取文章ID接口错误');
		}
		foreach($ids as $k=>$v){
			$article=file_get_contents(str_replace('$id', $v,$content_api));
			$article=json_decode($article,true);//file_put_contents('./1.txt', print_r($article,1),FILE_APPEND);
			$article['dir']=isset($article['dir'])? trim($article['dir'],'\\/').'/':'';
			//替换后保存
			$this->saveHtml($v,$template,$article);
			echo '<script>parent.progress('.$v.',"'.$this->root.$article['dir'].'")</script>';
			//echo str_repeat(' ' , 1024*1024*10);
			flush();
			//sleep(1);
		}
		echo '<script>parent.finish();</script>';
		
	}
	private function saveHtml($id,$template,$article){
		$dir=$article['dir'];
		if(!is_dir($this->rootPath.$dir)){
			mkdir($this->rootPath.$dir,0755,true);
		}
		$content=$template;
		//替换保存
		foreach ($article as $k => $v) {
			if($k=='dir') continue;
			$content=str_replace('{$'.$k.'}', $v, $content);
		}
		file_put_contents($this->rootPath.$dir.$id.'.html', $content);
		chmod($this->rootPath.$dir.$id.'.html', 0755);
		return;
	}	
	private function create(){
		//检查lock文件
		if(!is_file($this->rootPath.'create.lock')){
			require $this->jtPath.'inc/install.php';
			//var_dump(is_file('./inc/install.html'));
			//file_put_contents($this->rootPath.'install.lock','');
		}else echo '请先删除create.lock';
		//print_r($this);
		//print_r($_SERVER);
	}
	#
	private function getLists(){
		echo json_encode([1,2,3,4,5,6]);
	}
	private function getContent(){
		$id=intval($_GET['id']);
		echo json_encode(['dir'=>'news','id'=>1,'title'=>'中国式浪漫！冬奥健儿与中国诗词太搭了','content'=>str_repeat($id.'文章内容 ', 5),'updatetime'=>1644425718],JSON_UNESCAPED_UNICODE);
	}



	/**
	 * 取得当前的域名 完整 协议 +域名/ip+端口 https://www.jetee.cn:8080
	 *
	 * @access  public
	 *
	 * @return  string      当前的域名
	 */
	private function getDomain()
	{
		static $get_domain=null;
		if($get_domain!==null)	{
			return $get_domain;
		}
		/* 协议 */
		$protocol = $this->is_ssl()?'https://':'http://';

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
	private function is_ssl() {
		if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
			return true;
		}elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
			return true;
		}
		return false;
	}
}