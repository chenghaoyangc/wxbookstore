<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 给模板提供数据

//定义变量
// $datas='<option value="">请选择分类</option>';
$datas='';
// 1.查询一级分类语句
$sql="SELECT id,cname FROM chy_class_parent";


//2. 执行语句
$msql ->execute($sql);


// echo $msql -> error();
// 3.获取数据
while($res=$msql ->fetchquery()){


    $datas.='<option value="'.$res['id'].'">'.$res['cname'].'</option>';

}


include 'pages/templates/classchild_add.html';
?>

