<?php
namespace jetee\jt;
require_once __DIR__.'/inc/function.php';
class Jt
{
	public $script_name;
	public $root;
	public $rootPath;
	public $jtPath;
	public $tempPath;
	private $key='Kd&UJ66d8';
	public function init()
	{
		$this->script_name=$_SERVER['SCRIPT_NAME'];							#/blog/jt.php
		$this->root=str_replace('\\', '/', dirname($this->script_name));	#/blog/
		if($this->root!='/')$this->root.='/';								#/blog/  或 /
		$this->rootPath=str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).$this->root;#/www/wwwroot/public/blog/
		$this->jtPath=__DIR__.'/';													  #/www/wwwroot/vendor/jetee/jt/src/
		$this->tempPath=$this->rootPath.'jt_temp/';									  #/www/wwwroot/public/blog/jt_temp/

		//默认显示生成页
		$act=$_REQUEST['act'];
		if(empty($act)){
			$this->index();
		}elseif(in_array($act,explode(',', 'demo_getLists,demo_getContent,demo_update,doCreate,auto_update,save_auto_update_api'))){
			$this->$act();
		}
	}
	//默认显示生成页
	protected function index(){
		$error='';
		//检查权限
		if(intval(get_mod($this->rootPath))!==7 || get_own($this->rootPath)!=='www'){
			$error='请先检查目录'.$this->rootPath.'权限！';
		}
		//检查lock文件
		if(!is_file($this->rootPath.'create.lock')){
			require $this->jtPath.'inc/create.php';
			//var_dump(is_file('./inc/install.html'));
			//file_put_contents($this->rootPath.'install.lock','');
		}else echo '请先删除create.lock';
		//print_r($this);print_r($_SERVER);
	}	
	//自动更新静态化
	protected function save_auto_update_api(){		
		file_put_contents($this->rootPath.$dir.$filename, $content);
	}
	protected function auto_update(){
		$id=intval($_GET['id']);
		$time=intval($_GET['time']);
		$self=$_GET['self'];
		$ini=$_GET['ini'];
		if($_GET['code']!==md5(sha1($ini.$self.$time.$id).$this->key)) return;//确保不篡改
		$template=json_decode(file_get_contents($this->tempPath.$ini),true);
		$article1=file_get_contents(str_replace(['$id','$time'], [$id,$time],$template[1]));
		$article=json_decode($article1,true);
		//有数据就更新
		if($article){
			//print_r($article);
			@unlink($this->rootPath.$self);//可能不同目录
			$this->saveHtml($id,$template[0],$article,$ini);
		}
		//var_dump($article1);
	}
	protected function doCreate(){
		$id_api=$_REQUEST['id_api'];
		$content_api=$_REQUEST['content_api'];
		$template=$_REQUEST['template'];
		$auto_update_api=$_REQUEST['auto_update_api'];
		//保存模板与自动更新api
		$ini=random_name($this->tempPath,'txt');
		file_put_contents($this->tempPath.$ini, json_encode([$template,$auto_update_api]));

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
			//替换后保存
			$filename=$this->saveHtml($v,$template,$article,$ini);
			echo '<script>parent.progress('.$v.',"'.$this->root.$filename.'")</script>';
			//echo str_repeat(' ' , 1024*1024*10);
			flush();
			//sleep(1);
		}
		echo '<script>parent.finish();</script>';
		
	}
	//用内容替换模板保存
	private function saveHtml($id,$template,$article,$ini){
		$dir=isset($article['dir'])? trim($article['dir'],'\\/').'/':'';
		if(!is_dir($this->rootPath.$dir)){
			mkdir($this->rootPath.$dir,0755,true);
		}
		$content=$template;
		//替换保存
		foreach ($article as $k => $v) {
			$content=str_replace('{$'.$k.'}', $v, $content);
		}
		$filename=isset($article['filename'])? trim($article['filename'],'\\/'): $id.'.html';
		$filename=$dir.$filename;
		$time=time();
		$code=md5(sha1($ini.$filename.$time.$id).$this->key);//简单验证
		//自动更新js
		$content=str_replace('{$auto_update}', $this->script_name.'?act=auto_update&code='.$code.'&ini='.$ini.'&self='.urlencode($filename).'&id='.$id.'&time='.$time, $content);
		file_put_contents($this->rootPath.$filename, $content);
		chmod($this->rootPath.$filename, 0755);
		return $filename;// news/1.html
	}

	#示例
	protected function demo_update(){
		$id=intval($_GET['id']);
		//取文立章更新时间
		$updatetime=time();
		$time=intval($_GET['time']);
		if($updatetime>$time){
			echo json_encode(['dir'=>'news','filename'=>'new_'.$id.'.html','title'=>'中国式浪漫！冬奥健儿与中国诗词太搭了','content'=>str_repeat(date('H:i:s').' 自动更新修改内容<br>',1)],JSON_UNESCAPED_UNICODE);
		}
	}
	#示例
	protected function demo_getLists(){
		echo json_encode([1,2,3,4,5,6]);
	}
	#示例
	protected function demo_getContent(){
		$id=intval($_GET['id']);
		echo json_encode(['dir'=>'news','filename'=>'new_'.$id.'.html','title'=>'中国式浪漫！冬奥健儿与中国诗词太搭了','content'=>str_repeat($id.'文章内容<br>', 5)],JSON_UNESCAPED_UNICODE);
	}

}