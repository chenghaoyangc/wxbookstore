<?php
  // 页面编码,防止乱码
  header("Content-type:text/html;charset=utf8");

  // 访问限制
  if(!defined('WWWROOT')){
    die('请求不被允许，请登录');
  }


  // 接收表单数据
//   echo $title;
//   print_r($_FILES['photo']);
//   echo $url;
$title=trim($title);
$url=trim($url);
$photo=$_FILES['photo'];

// 上传图片
$destFile=uploadFile($photo);

// 入库
$sql="INSERT INTO chy_swiper (title,photourl,gourl) VALUES ('".$title ."','".$destFile ."','".$url ."')";

// 执行语句
$msql->execute($sql);

// 执行结果
$as=$msql->affectedRows();


if($as>0 && strpos($destFile,'load')){// 数据入库成功并且图片上传成功

    echo'文件上传成功<br />数据入库成功';

    // 跳转到列表页
    jump('main.php?go=swiper');
}else{
    echo'数据入库失败';
    echo '<br />';
    echo $destFile;
}



?>