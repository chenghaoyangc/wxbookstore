<?php
// 引入公用文件
require_once('../include/common.in.php');

$sql="SELECT b.id,bookname,price,coverurl,fp FROM chy_book as b LEFT JOIN chy_cover as c ON (b.id=c.bookid) GROUP BY b.id ORDER BY b.fp ASC,b.id  DESC LIMIT 0,3";

$msql->execute($sql);


while($res=$msql->fetchquery()){

    // 处理价格
$price=explode('.',$res['price']);
// c.1整数部分
$res['print_int']=$price[0];
// c.2c小数部分
$res['print_dec']=$price[1];

// 处理标题
$title=$res['bookname'];

$titleLen=strlen($title);

if($titleLen>10){
    $res['bookname']=mb_substr($title,0,15,'utf-8').'...';
}



    $tempArr[]=$res;

}
echo json_encode($tempArr);
?>