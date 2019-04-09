<?php
// 引入公用文件
require_once('../include/common.in.php');

$sql="SELECT uname,tel,address,post,header FROM chy_user WHERE openid='".$openid."' LIMIT 1";

$msql->execute($sql);
$res=$msql->fetchquery();

echo json_encode($res);



?>