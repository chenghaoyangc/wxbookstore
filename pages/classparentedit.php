<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

//1. 获取ID
$id=intval($id);

// 2.根据ID,查询数据库语句
$sql="SELECT cname FROM chy_class_parent WHERE id=$id LIMIT 1";

// 3.执行语句
$msql ->execute($sql);

// 4.获取数据
$res=$msql->fetchquery();

// 5.给模板提供数据
$value=$res['cname'];

// 给模板提供数据

// 载入模板
include 'pages/templates/classparentedit.html';
?>

