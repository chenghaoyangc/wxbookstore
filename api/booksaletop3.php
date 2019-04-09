<?php
// 引入公用文件
require_once('../include/common.in.php');


$sql="SELECT pid,sum(counts) as total,bookname,price FROM chy_order as o LEFT JOIN chy_book as b ON (o.pid=b.id) WHERE catagory='book' GROUP BY pid ORDER BY total DESC LIMIT 0,3";

$msql->execute($sql);

while($res=$msql->fetchquery()){

    // 获取图书封面
    $pid=$res['pid'];
    
    // 查询封面
    $sql="SELECT coverurl FROM chy_cover WHERE bookid=$pid LIMIT 1";
    $msql->execute($sql,'book');
    $res_cover=$msql->fetchquery('book');

    $res['coverurl']=$res_cover['coverurl'];


// 处理标题
$title=$res['bookname'];

$titleLen=strlen($title);


$res['titleleth']=strlen($title);
if($titleLen>43){
    $res['bookname']=mb_substr($title,0,21,'utf-8').'...';
}

$res['titlelenth']=strlen($title);

// 处理价格
$price=explode('.',$res['price']);
// c.1整数部分
$res['print_int']=$price[0];
// c.2c小数部分
$res['print_dec']=$price[1];

$tempArr[]=$res;

}

// echo $sql;
$msql->error();
echo json_encode($tempArr);

?>