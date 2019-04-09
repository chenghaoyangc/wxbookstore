<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 接收id
$id=intval($id);

// 从数据库中查询该ID的数据
//定义变量
// $datas='<option value="">请选择分类</option>';
$datas='';
// 1.查询一级分类语句
$sql="SELECT id,cname FROM chy_class_parent";


//2. 执行语句
$msql ->execute($sql);


// echo $msql -> error();
// 3.获取数据
while($res=$msql ->fetchquery()){

    $datas.='<option value="'.$res['id'].'">'.$res['cname'].'</option>';

}

// 从数据库中查询该ID的数据
$sql="SELECT cc.cname as cname,cid,cp.cname as pname FROM chy_class_child as cc LEFT JOIN chy_class_parent as cp ON (cc.cid=cp.id) WHERE cc.id=$id LIMIT 1";

// 执行语句
$msql -> execute($sql);

// $msql -> error();
// 获取数据
$res=$msql ->fetchquery();

// print_r($res);

// 载入模板
include 'pages/templates/classchild_edit.html';
?>

