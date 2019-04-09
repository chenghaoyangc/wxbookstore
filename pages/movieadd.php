<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 初始化
$class=$country='';

// /类型（二级分类）
$sql="SELECT id,cname FROM chy_class_child WHERE cid=$class_parent_movie";
// 执行语句
$msql->execute($sql);
// 抓取数据
while ($res=$msql->fetchquery()){

$class.='<option value="'.$res['cname'].'">'.$res['cname'].'</option>';

};


// /类型（二级分类）
$sql="SELECT id,cname FROM chy_class_child WHERE cid=$class_parent_country";
// 执行语句
$msql->execute($sql);
// 抓取数据
while ($res=$msql->fetchquery()){

  $country.='<option value="'.$res['cname'].'">'.$res['cname'].'</option>';

};


// $msql->error();

// 载入模板
include 'pages/templates/movieadd.html';
?>

