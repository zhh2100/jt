# JT只是为了取个名
JT静态文章系统  JT static presentation of the article system
类似dedecms，但多了自动更新，但更多以插件，模块形式使用

#使用方法
	公网能访问的目录下新建jt.php,文章即生成在此目录下  
	例如：新建/blog/jt.php,则此目录下会生成文章的目录及内容

```php
//require dirname(dirname(__DIR__)) . '/vendor/autoload.php'; //composer载入  或手动载入
require dirname(dirname(__DIR__)) . '/vendor/jetee/jt/src/jt.php';
(new \jetee\jt\Jt())->init();
```

	生成静态页[覆盖生成]：/blog/jt.php
