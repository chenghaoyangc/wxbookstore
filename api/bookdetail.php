<?php
// 引入公用文件
require_once('../include/common.in.php');

// 接收小程序传过来的ID
$id=intval($id);

// 查询语句
$sql="SELECT ccid,bookname,author,public,price,descript,cname FROM chy_book as b LEFT JOIN chy_class_child as cc ON (b.ccid=cc.id) WHERE b.id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取数据
$res=$msql->fetchquery();

// 处理价格
$price=explode('.',$res['price']);

// c.1整数部分
$res['print_int']=$price[0];
// c.2c小数部分
$res['print_dec']=$price[1];


// 处理封面
$sql="SELECT coverurl FROM chy_cover WHERE bookid=$id";
$msql->execute($sql);
while($rex=$msql->fetchquery()){
    $tempArr[]=$rex;
}

$res['cover']=$tempArr;

// echo $sql;
$msql->error();
// 转换成json，并输出
echo json_encode($res);


?>