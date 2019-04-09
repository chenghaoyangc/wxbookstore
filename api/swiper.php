<?php
// 引入公用文件
require_once('../include/common.in.php');

// 接收小程序传过来的ID
// $id=intval($id);

$tempArr=array();
// 查询语句
$sql="SELECT id,photourl,gourl FROM chy_swiper";

// 执行语句
$msql->execute($sql);

// 获取数据
while($res=$msql->fetchquery()){
    $tempArr[]=$res;
}

// $res['cover']=$tempArr;

$msql->error();
// 转换成json，并输出
echo json_encode($tempArr);


?>