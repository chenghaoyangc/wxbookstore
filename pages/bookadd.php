<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 初始化
$option_parent='';

//1.获取一级分类 
//查询语句
$sql="SELECT id,cname FROM chy_class_parent WHERE id=1";

// 执行语句
$msql->execute($sql);

// 抓取数据
while ($res=$msql->fetchquery()){

$option_parent.='<option value="'.$res['id'].'">'.$res['cname'].'</option>';

};
// $msql->error();

// 载入模板
include 'pages/templates/bookadd.html';
?>

