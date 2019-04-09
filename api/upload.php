<?php
// 引入公用文件
require_once('../include/common.in.php');

// 引入公用函数
require_once('../include/common.fn.php');

$openid=$openid;

// 接收小程序的表单数据
// echo $uname=trim($uname);

// 电话
$tel=trim($tel);

// 地址
$address=trim($address);

// 邮编
$post=trim($post);

// 头像
$photo=$_FILES['file'];

// echo $uname.$adress.$tel.$post.$photo['name'];

// 上传头像
$remoterUrl=uploadFile($photo,'../upload');
$remoterUrl=substr($remoterUrl,3);

// 日期
$dt=time();

// 查询表中是否已经存在该用户，如果有，则修改，否则新创建

$sql="SELECT id FROM chy_user WHERE openid='".$openid."' LIMIT 1";

$msql->execute($sql);

$res=$msql->fetchquery();

if(!$res['id']){
//    入库
$sql="INSERT INTO chy_user(openid,uname,tel,address,post,header,dt) VALUES ('".$openid."','".$uname."',$tel,'".$address."','".$post."','".$remoterUrl."',$dt)";

}else{
  //    修改
   if($photo){//重新选择头像
       
    $sql="UPDATE chy_user SET uname='".$uname."',tel='".$tel."',address='".$address."',post='".$post."',header='".$remoterUrl."' WHERE openid='".$openid."'";

   }else{//没有重置头像
    $sql="UPDATE chy_user SET uname='".$uname."',tel='".$tel."',address='".$address."',post='".$post."' WHERE openid='".$openid."'";

   }


}



// 执行入库
$msql->execute($sql);

// 获取执行结果
$as=$msql->affectedRows();

if($as>0){
    $result='success';
}else{
    $result='fail';
}


// $msql->error();
echo $result;


?>