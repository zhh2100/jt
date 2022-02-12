# JT只是为了取个名
JT静态文章系统  JT static presentation of the article system
类似dedecms，但多了自动更新，但更多以插件，模块形式使用
类似模板页的替换后，数据从接口来方便通用


#安装
	composer require jetee/jt    或下载包https://github.com/zhh2100/jt.git

#使用方法
	公网能访问的目录下新建个php,文件名随意
	例如：新建/blog/index.php,则此目录下会生成文章的内容
	不要删除该文件，自动更新需要它

```php
//require dirname(dirname(__DIR__)) . '/vendor/autoload.php'; //composer载入  或手动载入
require dirname(dirname(__DIR__)) . '/vendor/jetee/jt/src/jt.php';
(new \jetee\jt\Jt())->init();
```

