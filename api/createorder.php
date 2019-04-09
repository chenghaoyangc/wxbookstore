<?php
// 引入公用文件
require_once('../include/common.in.php');

// 引入公用函数
require_once('../include/common.fn.php');


// 接收小程序的表单数据
$openid=$openid;

$datas=json_decode(stripslashes($datas),true);

//定义入库状态
$result='success';

foreach($datas as $key=>$item){

  // 分类名称
  $catagory=$key;

  if(count($item)){
// 遍历内容
        foreach($item as $item2){
            // 产品ID
            $pid= $item2['pid'];

            // 产品数量
            $count=$item2['count'];

            $dt=time();
            // sql语句
            $sql="INSERT INTO chy_order(openid,catagory,pid,counts,dt) VALUES ('".$openid."','".$catagory."',$pid,$count,$dt)";

            $msql->execute($sql);

            $as=$msql->affectedRows();

                    if($as<1){
                        $result='fail';
                    }
               }
            }
        }


$msql->error();

echo $result;

?>