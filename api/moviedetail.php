<?php
// 引入公用文件
require_once('../include/common.in.php');

// 接收小程序传过来的ID
$id=intval($id);

// 查询语句
$sql="SELECT m.id,class_style,class_country,moviename,director,writer,roles,price,longs,movieurl,descript,coverurl,dt FROM chy_movie as m  WHERE m.id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取数据
$res=$msql->fetchquery();
// print_r($res);


// b.1去掉html标签
$res['descript']=strip_tags($res['descript']);


// 处理价格
$price=explode('.',$res['price']);
// c.1整数部分
$res['print_int']=$price[0];
// c.2c小数部分
$res['print_dec']=$price[1];

//    d.处理评论星星数量
$res['stars']=5;

// e.评论数
$res['counts']=0;

$msql->error();

// 转换成json，并输出
echo json_encode($res);


?>