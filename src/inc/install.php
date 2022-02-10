
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>生成文章静态页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<meta name="renderer" content="webkit">
	<style>
	body {background: #f1f6fd;margin: 0;padding: 0;line-height: 1.5;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
	body, input, button {font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, 'Microsoft Yahei', Arial, sans-serif;font-size: 14px;color: #7E96B3;}
	.container {width:90%;max-width:1000px;margin: 0 auto;padding: 20px;text-align: center;}
	a {color: #4e73df;text-decoration: none;}
	a:hover {text-decoration: underline;}
	h1 {margin-top: 0;margin-bottom: 10px;}
	h2 {font-size: 28px;font-weight: normal;color: #3C5675;margin-bottom: 0;margin-top: 0;}
	h3 {font-size: 20px;font-weight: normal;color: #999;text-align: left;}
	form {margin-top: 40px;}
	.form-group {margin-bottom: 20px;}
	.form-group .form-field:first-child input {border-top-left-radius: 4px;border-top-right-radius: 4px;}
	.form-group .form-field:last-child input {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;}
	.form-field input {background: #fff;margin: 0 0 2px;border: 2px solid transparent;transition: background 0.2s, border-color 0.2s, color 0.2s;width: 100%;padding: 15px 15px 15px 180px;box-sizing: border-box;}
	.form-field input:focus {border-color: #4e73df;background: #fff;color: #444;outline: none;}
	.form-field label {float: left;width: 160px;text-align: right;margin-right: -160px;position: relative;margin-top: 15px;font-size: 14px;pointer-events: none;opacity: 0.7;}
	.form-field a {float: right;width: 160px;text-align: left;margin-right: -180px;position: relative;margin-top: 15px;font-size: 14px;opacity: 0.7;}
	button, .btn {background: #3C5675;color: #fff;border: 0;font-weight: bold;border-radius: 4px;cursor: pointer;padding: 15px 30px;-webkit-appearance: none;}
	button[disabled] {opacity: 0.5;}
	.form-buttons {height: 52px;line-height: 52px;}
	.form-buttons .btn {margin-right: 5px;}
	#error, .error, #success, .success, #warmtips, .warmtips {background: #D83E3E;color: #fff;padding: 15px 20px;border-radius: 4px;margin-bottom: 20px;}
	#success {background: #3C5675;}
	#error a, .error a {color: white;text-decoration: underline;}
	#warmtips {background: #ffcdcd;font-size: 14px;color: #e74c3c;}
	#warmtips .a {background: #ffffff7a;display: block;height: 30px;line-height: 30px;margin-top: 10px;color: #e21a1a;border-radius: 3px;}
	</style>
</head>

<body>
<form method="post" action="?act=doCreate" target="progress">
<div class="container">
	<h1>
		<svg viewBox="0 0 60 60" x="0" y="0" width="109" height="109" class="image-svg-svg bn"><g hollow-target="iconBnFill" mask="url(#b96dea35-0b3a-4518-9838-a4259998ffb0)"><g><svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="5 5 90 90" style="enable-background:new 0 0 100 100;" xml:space="preserve" width="60" height="60" filtersec="colorsf7372197540"><g><g i:extraneous="self"><path d="M50,5L5,50l45,45l45-45L50,5z"></path></g></g></svg></g> <g filter="url(#colors7591314779)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 56.664 48.02400000000001" width="45" height="45" x="7.5" y="7.5"><path transform="translate(-1.008 48.02400000000001)" d="M11.88 0L1.01 0L1.01-8.57L10.80-8.57Q15.41-8.57 17.60-8.89Q19.80-9.22 20.95-10.22L20.95-10.22Q22.54-11.45 23.15-13.75Q23.76-16.06 23.76-21.02L23.76-21.02L23.76-48.02L33.91-48.02L33.91-21.02Q33.91-15.98 33.55-13.39Q33.19-10.80 32.11-8.50L32.11-8.50Q29.38-2.38 22.18-0.65L22.18-0.65Q18.72 0 11.88 0L11.88 0ZM31.54 0L31.54-39.46L16.27-39.46L16.27-48.02L57.67-48.02L57.67-39.46L41.76-39.46L41.76 0L31.54 0Z"></path></svg></g></g><mask id="b96dea35-0b3a-4518-9838-a4259998ffb0"><g fill="white"><svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="5 5 90 90" style="enable-background:new 0 0 100 100;" xml:space="preserve" width="60" height="60" filtersec="colorsf7372197540"><g><g i:extraneous="self"><path d="M50,5L5,50l45,45l45-45L50,5z"></path></g></g></svg></g> <g fill="black"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 56.664 48.02400000000001" width="45" height="45" x="7.5" y="7.5"><path transform="translate(-1.008 48.02400000000001)" d="M11.88 0L1.01 0L1.01-8.57L10.80-8.57Q15.41-8.57 17.60-8.89Q19.80-9.22 20.95-10.22L20.95-10.22Q22.54-11.45 23.15-13.75Q23.76-16.06 23.76-21.02L23.76-21.02L23.76-48.02L33.91-48.02L33.91-21.02Q33.91-15.98 33.55-13.39Q33.19-10.80 32.11-8.50L32.11-8.50Q29.38-2.38 22.18-0.65L22.18-0.65Q18.72 0 11.88 0L11.88 0ZM31.54 0L31.54-39.46L16.27-39.46L16.27-48.02L57.67-48.02L57.67-39.46L41.76-39.46L41.76 0L31.54 0Z"></path></svg></g></mask></svg>
	</h1>
	<h2>生成文章静态页</h2>
	<h3>原理与用途是根据获取文章id数组，取文章内容匹配模板生成静态页，生成目录在接口中给定</h3>
	<div style="margin-top: 40px;">

		<div id="error" style="display:none"></div>
		<div id="success" style="display:none"></div>
		<div id="warmtips" style="display:none"></div>

		<div class="form-group">
			<div class="form-field">
				<label>获取json文章ID数组</label>
				<input type="text" name="id_api" value="<?php echo $this->getDomain().$this->script_name;?>?act=getLists" required="" 
				title="接口示例：<?php echo $this->getDomain().$this->script_name;?>?act=getLists
				接口返回json
				[id1,id2,id3...]">
				<a href="?act=getLists" target="_blank">接口示例</a>
			</div>

			<div class="form-field">
				<label>获取文章内容json</label>
				<input type="text" name="content_api" value="<?php echo $this->getDomain().$this->script_name;?>?act=getContent&id=$id" required="" 
				title="接口示例：<?php echo $this->getDomain().$this->script_name;?>?act=getContent&id=$id
				接口返回json
				['dir'=>'生成到指定目录,可空可无[相对于当前访问目录如news]','title'=>'文章名称','content'=>'文章内容']
				
				除了dir固定名称，其它参数匹配模板后替换，
					">
				<a href="?act=getContent&id=1" target="_blank">接口示例</a>
			</div>
		</div>

	</div>
</div>

<div style="width:90%;max-width:1000px;margin: 0 auto;">
	<div style="padding: 10px 0;">文章页模板</div>
	<div>
		<textarea name="template" required="" style="width:100%;height: 300px;border-color: #ccc;"><?php
			echo  htmlspecialchars('<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>{$title}</title>
		</head>
		<body>

	{$nav}
			<h1>{$title}</h1>

			{$content}

			接口返回中的参数，除了dir，其它参数匹配模板后替换

	{$foot}
		</body>
	</html>');
			?></textarea>
	</div>
</div>



<div class="container">
	<div class="form-buttons">
		<!--@formatter:off-->
		<button type="submit" >点击生成</button>
		<!--@formatter:on-->
	</div>
</div>
</form>

<div style="width:90%;max-width:1000px;margin: 0 auto;">
<iframe name="progress" style="width:100%;height: 50px;" frameborder="0" scrolling="yes" id="progress" src="javascript:void(function(){document.open();document.write(&quot;<!DOCTYPE html><html xmlns='http://www.w3.org/1999/xhtml' class='view' ><head><style type='text/css'>.view{padding:0;word-wrap:break-word;cursor:text;}body{font-size:14px;}p{margin:5px 0;}</style><script>function show(a){alert(a);}</script></head><body class='view'><div></div></body></html>&quot;);document.close();}())"></iframe>
</div>

<div style="width:90%;max-width:1000px;margin: 0 auto;">
	<div style="padding: 10px 0;">获取文章ID接口php示例</div>
	<div>
		<textarea id="getLists" required="" style="width:100%;height: 300px;border-color: #ccc;"><?php
echo  htmlspecialchars(file_get_contents($this->jtPath.'../demo/list.php'));
?></textarea>
	</div>
</div>


<div style="width:90%;max-width:1000px;margin: 0 auto;">
	<div style="padding: 10px 0;">获取文章内容接口php示例</div>
	<div>
		<textarea id="getContent" required="" style="width:100%;height: 300px;border-color: #ccc;"><?php
echo  htmlspecialchars(file_get_contents($this->jtPath.'../demo/content.php'));
?></textarea>
	</div>
</div>

<!-- jQuery -->
<script src="https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>

<script>
function progress(id,dir){
	$("#warmtips").html(id+' 已生成 '+'<a href="'+dir+id+'.html" target="_blank">查看</a>').show();
}	
//生成完成
function finish(){
	$('button').text("点击生成").prop('disabled', false);
	$("#success").text('已完成').show();
}
$(function () {

	$('form :input:first').select();

	$('form').on('submit', function (e) {
		//e.preventDefault();
		var form = this;
		$("#error").hide();
		$("#success").hide();
		var $button = $(this).find('button')
			.text("生成中...")
			.prop('disabled', true);
			return true;
		/*$.ajax({
			url: "",
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			success: function (ret) {
				if (ret.code == 1) {
					var data = ret.data;
					$error.hide();
					$(".form-group", form).remove();
					$button.remove();
					$("#success").text(ret.msg).show();

					$buttons = $(".form-buttons", form);
					$("<a class='btn' href='./'>访问首页</a>").appendTo($buttons);

					if (typeof data.adminName !== 'undefined') {
						var url = location.href.replace(/install\.php/, data.adminName);
						$("#warmtips").html("温馨提示：请将以下后台登录入口添加到你的收藏夹，为了你的安全，不要泄漏或发送给他人！如有泄漏请及时修改！" + '<a href="' + url + '">' + url + '</a>').show();
						$('<a class="btn" href="' + url + '" id="btn-admin" style="background:#4e73df">' + "进入后台" + '</a>').appendTo($buttons);
					}
					localStorage.setItem("fastep", "installed");
				} else {
					$error.show().text(ret.msg);
					$button.prop('disabled', false).text("点击安装");
					$("html,body").animate({
						scrollTop: 0
					}, 500);
				}
			},
			error: function (xhr) {
				$error.show().text(xhr.responseText);
				$button.prop('disabled', false).text("点击安装");
				$("html,body").animate({
					scrollTop: 0
				}, 500);
			}
		});
		return false;*/
		
	});
});
</script>
</body>
</html>
