<?php
// 引入公用文件
require_once('../include/common.in.php');
// 获取分类和产品

$catagory=$catagory;

$pid=$pid;
// echo $pid;
// 查询
$sql="SELECT stars,notes,c.dt,uname,header FROM chy_comment as c LEFT JOIN chy_user as u ON(c.openid=u.openid) WHERE catagory='".$catagory."' AND pid=$pid";

$msql->error();
// 执行语句
$msql->execute($sql);

while($res=$msql->fetchquery()){

    $tempArr[]=$res;
}

// echo $sql;
echo json_encode($tempArr);
?>