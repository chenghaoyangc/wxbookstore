<?php

    // 页面编码,防止乱码
    header("Content-type:text/html;charset=utf8");

    // 访问限制
    if(!defined('WWWROOT')){
      die('请求不被允许，请登录');
    }
    
//  获取ID
$id=intval($id);

// 根据ID获取数据
$sql="SELECT b.id,b.cid,ccid,bookname,author,public,price,dt,c.cname as cname,descript FROM chy_book as b 
LEFT JOIN chy_class_child as c ON (b.ccid=c.id) WHERE b.id=$id ORDER BY b.id DESC LIMIT 1";

// 执行语句
$msql ->execute($sql);

// 获取数据
$res=$msql->fetchquery();

// 二级分类名
$className=$res['cname'];

// 书名
$bookname=$res['bookname'];

// 作者
$author=$res['author'];

// 出版社
$public=$res['public'];

// 价格
$price=$res['price'];

// 描述
$descript=$res['descript'];

// 日期
$dt=date('Y-m-d',$res['dt']);

// $msql->error();
// 载入模板
include 'pages/templates/book_view.html';
?>

