<?php
// 引入公用文件
require_once('../include/common.in.php');

// 获取分类和ID
// echo $catagory.$pid; 
$catagory=$catagory;
$pid=$pid;

// 查询
switch($catagory){

    case'book':
    $sql="SELECT bookname as pname FROM chy_book WHERE id=$pid LIMIT 1";
    break;

    case'music':
    $sql="SELECT musicname as pname FROM chy_music WHERE id=$pid LIMIT 1";
    break;

    case'movie':
    $sql="SELECT moviename as pname FROM chy_movie WHERE id=$pid LIMIT 1";
    break;

}
// 执行语句
$msql->execute($sql);

// 获取数据
$res=$msql->fetchquery();


// 返回JSON
echo json_encode($res);

$msql->error();



?>