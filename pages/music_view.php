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
$sql="SELECT m.id,musicname,singer,composer,writer,price,words,dt,cname FROM chy_music as m LEFT JOIN chy_class_child as c ON(m.ccid=c.id)  WHERE m.id=$id
ORDER BY m.id DESC";

// 执行语句
$msql ->execute($sql);

// 获取数据
$res=$msql->fetchquery();

// 二级分类名
$className=$res['cname'];

// 书名
$musicname=$res['musicname'];

// 作者
$singer=$res['singer'];

// 出版社
$composer=$res['composer'];

// 价格
$writer=$res['writer'];

// 价格
$price=$res['price'];

// 描述
$words=$res['words'];

// 日期
$dt=date('Y-m-d',$res['dt']);

// $msql->error();
// 载入模板
include 'pages/templates/music_view.html';
?>

