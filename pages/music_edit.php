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
$sql="SELECT m.id,m.cid,musicname,singer,composer,writer,price,words,dt,cname,ccid FROM chy_music as m LEFT JOIN chy_class_child as c ON(m.ccid=c.id) WHERE m.id=$id";

// $sql="SELECT b.id,cid,musicname,singer,composer,writer,price,words,dt,cname FROM chy_music as b 
// LEFT JOIN chy_class_child as c ON (b.cid=c.id) WHERE b.id=$id ORDER BY b.id DESC LIMIT 1";
// 执行语句
$msql ->execute($sql);
// 获取数据
$res=$msql->fetchquery();
$msql->error();

// 二级分类名
$className=$res['cname'];

// 二级分类ID
$class_cid=$res['ccid'];


        // 获取全部二级分类
        // 初始化
        $data='';

        // 根据ID从数据库中读取该一级分类下的二级分类
        $sql="SELECT id,cname FROM chy_class_child WHERE cid=$class_cid";

        $msql->execute($sql);

        while($rex=$msql->fetchquery()){

        $data.='<option value="'.$rex['id'].'">'.$rex['cname'].'</option>';

     
        };


// 书名
$musicname=$res['musicname'];

// 作者
$singer=$res['singer'];

// 出版社
$composer=$res['composer'];

// 价格
$writer=$res['writer'];

// 描述
$price=$res['price'];

$words=$res['words'];


// 日期
$dt=date('Y-m-d',$res['dt']);

// 载入模板
include 'pages/templates/music_edit.html';
?>

