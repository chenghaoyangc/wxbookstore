<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

//1. 获取ID
$id=intval($id);

// 2.获取表单新值
$title=trim($title);

// 3.执行语句
$sql="UPDATE chy_class_parent SET cname='".$title."' WHERE id=$id";

// 4.执行语句
$msql->execute($sql);

// 返回执行结果
$res=$msql->affectedRows();

if($res>0){
    $result='修改成功!';
}else{
    $result='修改失败!';
}

// 载入模板
include 'pages/templates/classparent_edit_do.html';
?>

