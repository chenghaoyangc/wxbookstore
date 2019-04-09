<?php
// 引入公用文件
require_once('../include/common.in.php');

// 获取code
// $code=$code;

// 获取openid
$openid=trim($openid);

// 查询语句
$sql="SELECT uname,tel,address,header FROM chy_user WHERE openid='".$openid."' LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取执行结果
$res=$msql->fetchquery();

// 输出json
echo json_encode($res);//{{uname:'',tel:'18000',adress:'xxx}}


?>