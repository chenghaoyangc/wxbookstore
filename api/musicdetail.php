<?php
// 引入公用文件
require_once('../include/common.in.php');

// 接收小程序传过来的ID
$id=intval($id);

// 查询语句
$sql="SELECT m.id,musicname,singer,composer,writer,price,musicurl,coverurl,words,cname FROM chy_music as m LEFT JOIN chy_class_child as cc ON (m.ccid=cc.id) WHERE m.id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取数据
$res=$msql->fetchquery();

// 处理价格
$price=explode('.',$res['price']);

// b.1去掉html标签
$res['words']=strip_tags($res['words']);

// c.1整数部分
$res['print_int']=$price[0];
// c.2c小数部分
$res['print_dec']=$price[1];

//    d.处理评论星星数量
$res['stars']=5;

// e.评论数
$res['counts']=0;

// print_r($res);

// 转换成json，并输出
echo json_encode($res);


?>