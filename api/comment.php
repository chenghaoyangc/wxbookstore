<?php

//引入公用文件
require_once('../include/common.in.php'); 

// 接收数据并验证处理....

//评论日期
$dt = time();

if ($action == 'add'){

    //入库
    $sql = "INSERT INTO chy_comment (catagory,pid,openid,stars,notes,dt) VALUES ('".$catagory."',$pid,'".$openid."',$starnums,'".$content."',$dt)";

} 

if ($action == 'edit'){

    //修改
    $sql = "UPDATE chy_comment SET stars=$starnums,notes='".$content."' WHERE openid='".$openid."' AND catagory='".$catagory."' AND pid=$pid";

}

$msql -> execute($sql);

$as = $msql ->affectedRows();

if ($as>0){
    echo 'success';
} else {
    echo 'fail';
}



?>