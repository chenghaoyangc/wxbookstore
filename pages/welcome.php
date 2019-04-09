<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

$content='welcome!!! pages';


include 'pages/templates/welcome.html';
?>

