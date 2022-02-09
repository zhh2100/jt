# jt
JT静态文章系统  JT static presentation of the article system
类似dedecms，但更多以插件，模块形式使用。

#使用方法
公网能访问的目录下
require __DIR__ . '/../vendor/autoload.php';
new \jetee\jt\article()->init();
