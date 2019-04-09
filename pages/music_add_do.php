<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 接收表单数据

// 二级分类ID
$cclass=$cclass;

// 歌曲名称
$musicname=trim($musicname);

// 歌手
$singer=trim($singer);

// 作曲
$composer=trim($composer);

// 填词
$writer=trim($writer);

// 价格
$price=trim($price)?trim($price):0;

// 封面
$poster=$_FILES['poster'];

// 音乐
$music=$_FILES['music'];

//歌词
$descript=trim($descript);

// 上架日期
$dt=strtotime($dt);

/////////////////////////////////////
// 上传文件

// 上传封面
$destPosterUrl=uploadFile($poster);
// echo $destPosterUrel;

$destMusicUrl=uploadFile($music,'upload/music');


if(!$musicname){
    $result='请填写歌曲名称';
}else{
// 入库操作

// 语句
$sql="INSERT INTO chy_music(cid,ccid,musicname,singer,composer,writer,price,musicurl,coverurl,words,dt)
VALUES(2,$cclass,'".$musicname."','".$singer."','".$composer."','".$writer."',$price,
'".$destMusicUrl."','".$destPosterUrl."','".$descript."',$dt)";

// 执行语句
$msql->execute($sql);


// 获取执行结果
$as=$msql -> affectedRows();

if($as>0){
  $result='入库成功!<br />';
}else{
    $result='入库失败! <br />';

    $msql->error();
}

}


include 'pages/templates/music_add_do.html';
?>

