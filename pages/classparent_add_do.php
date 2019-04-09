<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 接收表单数据
$cid=intval($cid);
$title=trim($title);

// 验证合法性

// 入库语句
$sql="INSERT INTO chy_class_child (cid,cname) VALUES ($cid,'".$title."')";
echo $sql;

// 执行语句
$msql -> execute($sql);

// 验证数据是否已入库
$res=$msql -> affectedRows();

if($res>0){
    echo '数据入库成功!';
    echo '<a href="main.php?go=classchild_add">继续新增</a>';
    echo '<a href="main.php?go=classchild">返回列表</a>';
}else{
    echo '数据入库失败';
}

// 载入模板
// include 'pages/templates/classchild_add.html';
?>

