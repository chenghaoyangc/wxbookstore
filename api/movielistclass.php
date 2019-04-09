<?php

////引入公用文件
require_once('../include/common.in.php');

//初始化
$where = '';

//接收2个分类参数
$cls = trim($cls);
$country = trim($country);

//根据以上2个条件查询

if ($cls!='all_class'){ //如果选择全部分类，则where条件不变,否则就所选条件
    $where .= " AND class_style LIKE '%".$cls."%'";
} 

if ($country != 'all_country'){ 
    $where .= " AND class_country='".$country."'";
}

$sql = "SELECT id,moviename,director,writer,roles,class_style,class_country,price,coverurl FROM chy_movie WHERE 1 $where ORDER BY id DESC";

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

        if ($res['cname'] == $cls){

            //给当前所选的分类加样式
            $res['myclass'] = 'active-class';

        } else {

            $res['myclass'] = '';
        }
        
        $tempArrCatagory[] = $res;

    } else { //电影国家

        if ($res['cname'] == $country){
            $res['mycountry'] = 'active-country';
        } else {
            $res['mycountry'] = '';
        }

        $tempArrCountry[] = $res;
    }

}



$datas['class_catagory'] = $tempArrCatagory;

$datas['class_country'] = $tempArrCountry;

$datas['list_datas'] = $tempArr;

echo json_encode($datas);

?>