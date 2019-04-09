<?php
// 引入公用文件
require_once('../include/common.in.php');

// 接收小程序传过来的ID
$ccid=intval($ccid);

if($ccid){
    $sql="SELECT id,musicname,singer,composer,writer,price,coverurl,words FROM chy_music WHERE ccid=$ccid ORDER BY id DESC LIMIT 0,20";
  
}else{
    $sql="SELECT id,musicname,singer,composer,writer,price,coverurl,words FROM chy_music ORDER BY id DESC LIMIT 0,20";

}

// 查询语句
$tempArr=array();
// 执行语句
$msql->execute($sql);

// 获取数据
while($res=$msql->fetchquery()){

// c.处理价格12.25
$price=explode('.',$res['price']);

// c.1整数部分
$res['print_i']=$price[0];
// c.2c小数部分
$res['print_t']=$price[1];

//    d.处理评论星星数量
$res['stars']=5;

// e.评论数
$res['counts']=0;


    $arrtemp[]=$res;


}

// $res['cover']=$tempArr;

$msql->error();
// 转换成json，并输出
echo json_encode($arrtemp);


?>