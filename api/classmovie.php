<?php
// 引入公用文件
require_once('../include/common.in.php');

$tempArr=array();
// 查询语句
$sql="SELECT cid,cname FROM chy_class_child WHERE cid=$class_parent_movie";

// 执行语句
$msql->execute($sql);

// 获取数据
while($res=$msql->fetchquery()){



    $arrtemp[]=$res;


}

// $res['cover']=$tempArr;

$msql->error();
// 转换成json，并输出
echo json_encode($arrtemp);


?>