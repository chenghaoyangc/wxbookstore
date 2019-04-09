<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 类型
$class=$class;

// 地区
$country=$country;

// 名称
$moviename=trim($moviename);

// 导演
$director=trim($director);

// 编剧
$writer=trim($writer);

// 主演
$roles=trim($roles);

// 价格
$price=doubleval($price);

// 片长
$longs=trim(intval($longs));

// 花絮地址
$movieurl=trim($movieurl);

// 封面
$poster=$_FILES['poster'];

// 简介
$descript=trim($descript);

// 上架日期
$dt=strtotime($dt);

//////////////////////////

if(!$moviename){
    $result='请填写影片名称';
}else{

// 封面上传
$destFilePath=uploadFile($poster);

// 数据入库
$sql="INSERT INTO chy_movie (cid,class_style,class_country,moviename,director,writer,roles,price,longs,movieurl,descript,coverurl,dt)
VALUES ($class_parent_movie,'".$class."','".$country."','".$moviename."','".$director."','".$writer."','".$roles."',$price,$longs,'".$movieurl."','".$descript."','".$destFilePath."',$dt)";
}

// 执行入库
$msql->execute($sql);

// 返回执行结果
$as=$msql->affectedRows();

if($as>0){

$result='入库成功';

}else{
    $result='入库失败';
}


$msql->error();

// 载入模板
include 'pages/templates/movie_add_do.html';
?>

