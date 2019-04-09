<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 接收参数

$id=intval($id);

$cid=intval($cid);

$cname=trim($title);

// 修改语句
$sql="UPDATE chy_class_child SET cid=$cid,cname='".$cname."' WHERE id=$id";

// 执行语句
$msql -> execute($sql);

// 返回一个执行结果
$res=$msql->affectedRows();

if($res>0){
    $result='修改成功！';
}else{
    $result='抱歉,修改失败！';
}


// 载入模板
include 'pages/templates/classchild_edit_do.html';
?>

