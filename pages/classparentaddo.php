<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 一级分类入库

// 1.入库语句
$sql="INSERT INTO chy_class_parent(cname) VALUES('".$title."')";

// 2.执行语句
$msql->execute($sql);

// 3.查看结果
$res=$msql->affectedRows();

if($res>0){
  $result='创建成功!';
}else{
  $result='创建失败!';
}

// 给模板提供数据


// 载入模板
include 'pages/templates/classparentaddo.html';
?>

