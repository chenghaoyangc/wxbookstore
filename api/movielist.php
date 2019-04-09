<?php

////引入公用文件
require_once('../include/common.in.php');

//语句
$sql = "SELECT id,moviename,director,writer,roles,class_style,class_country,price,coverurl FROM chy_movie ORDER BY id DESC";

//执行语句
$msql -> execute($sql);

//获取数据
while($res = $msql->fetchquery()){

    //处理价格
    $price = explode('.',$res['price']);

    $res['price_int'] = $price[0];

    $res['price_dec'] = $price[1];

    //星星
    $res['stars'] = 5;

    //评论数
    $res['counts'] = 0;

    $tempArr[] = $res;

}

//初始化
$tempArrCatagory = $tempArrCountry = array();

//分类语句
$sql = "SELECT cid,cname FROM chy_class_child WHERE cid=$class_parent_movie OR cid=$class_parent_country";

$msql -> execute($sql);

while($res = $msql->fetchquery()){

    if ($res['cid'] == $class_parent_movie){  //电影分类

        $tempArrCatagory[] = $res;

    } else { //电影国家

        $tempArrCountry[] = $res;
    }

}



$datas['class_catagory'] = $tempArrCatagory;

$datas['class_country'] = $tempArrCountry;

$datas['list_datas'] = $tempArr;


//输出JSON
echo json_encode($datas);   //{'class_catagory':[{cid:xx,cname:'xxx'},{}],'class_country':[{cid:xx,cname:'xxx'},{}],'list_datas':[{},{},{}}



?>