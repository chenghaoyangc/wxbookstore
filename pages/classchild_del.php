<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 接收id
$id=intval($id);

// 语句
$sql="DELETE FROM chy_class_child WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 获取执行结果
$res=$msql ->affectedRows();

if($res>0){
    $result='删除成功！';
}else{
    $result='删除失败!';
}

// 载入模板
include 'pages/templates/classchild_del.html';
?>

