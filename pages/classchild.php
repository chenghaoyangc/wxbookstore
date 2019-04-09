<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 给模板提供数据

$datas='';


// 1.读取数据语句
$sql="SELECT cc.id as ccid,cc.cname as cname,cp.cname as pname,cp.id as cpid FROM chy_class_child as cc LEFT JOIN chy_class_parent as cp ON (cc.cid=cp.id) ORDER BY cc.id DESC";

// 2.执行语句

$msql->execute($sql);

// 3.获取查询结果
while($res=$msql->fetchquery()){
  $datas .='<tr>
  <td>'.$res['ccid'].'</td>
  <td>'.$res['pname'].$res['cpid'].'</td>
  <td>'.$res['cname'].'</td>
  <td><a href="main.php?go=classchild_edit&id='.$res['ccid'].'">修改</a>|
  <a href="javascript:void(0)"onclick="ask('.$res['ccid'].')">删除</a></td>
</tr> ';
};
// $msql->error();
include 'pages/templates/classchild.html';
?>

