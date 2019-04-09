<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

//1. 获取ID
$id=intval($id);

// 2.删除语句
$sql="DELETE FROM chy_class_parent WHERE id=$id LIMIT 1";

// 3.执行删除
$msql->execute($sql);

// 4.返回执行结果
$res=$msql->affectedRows();

if($res>0){
    $result='删除一级分类成功!';
// 删除二级分类
$sql="DELETE FROM chy_class_parent WHERE cid=$id";

// 执行删除二级分类
$msql->execute($sql);

//获取执行二级分类结果
$res2 = $msql ->affectedRows();

if($res2>0){
    $result2='删除二级分类成功!';
}else{
    $result2='删除二级分类失败!';
}

}else{
    $result='删除失败!';
}

// 载入模板
include 'pages/templates/classparent_del.html';
?>

