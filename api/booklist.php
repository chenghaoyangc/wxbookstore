<?php

// 引入公用文件
require_once('../include/common.in.php');

// 接收TAP参数
// echo $tap;
// 接收option参数
$tap=$tap;
$searchKeywods=trim($$searchKeywods);
$comlumn=trim($comlumn);

// 根据不同的tap,查询不同的数据

// 初始化
$ccid='';
$tempArr=array();
$arrBookName=array();
$arrNew=array();

// 把tap转换成二级分类ID
switch ($tap) {
    case 'science':

       $ccid=23;
        break;
    
        case 'child':
        $ccid=22;
         break;

         case 'people':
         $ccid=20;
          break;

          case 'youth':
         $ccid=19;
          break;

         case 'health':
         $ccid=18;
         break;

       default:
       $ccid=23;
        break;
}

// 2.根据CCID(二级分类ID)查询该分类下的数据

// 2.1查询语句
if($searchKeywods&&$comlumn){

    $sql="SELECT b.id,bookname,author,public,price,descript,dt,coverurl FROM chy_book as b LEFT JOIN chy_cover as c ON (b.id=c.bookid) WHERE $comlumn LIKE '%".$searchKeywods."%' ORDER BY b.id DESC LIMIT 0,20";

} else if ($tap == 'free99'){

  $sql = "SELECT b.id,bookname,author,public,dt,descript,price,coverurl FROM chy_book as b LEFT JOIN chy_cover as c ON (b.id=c.bookid) WHERE fp=1 ORDER BY b.id DESC LIMIT 0,20";

}
else if($tap == 'bookmoretop'){
  $sql="SELECT b.id,pid,sum(counts) as total,bookname,price,author,public,o.dt,descript,coverurl FROM chy_order as o LEFT JOIN chy_book as b ON (o.pid=b.id) LEFT JOIN chy_cover as c ON(b.id=c.bookid) WHERE catagory='book' GROUP BY pid ORDER BY total DESC LIMIT 0,20";
}else{

    $sql="SELECT b.id,bookname,author,public,price,descript,dt,coverurl FROM chy_book as b LEFT JOIN chy_cover as c ON (b.id=c.bookid) WHERE ccid=$ccid ORDER BY b.id DESC LIMIT 0,20";

}


// 2.2执行语句
$msql->execute($sql);
$msql->error();
// 2.3获取数据
while($res=$msql->fetchquery()){

//a. 处理日期
$res['date']=date('Y-m-d',$res['dt']);

// b.处理简介

// b.1去掉html标签
$res['descript']=strip_tags($res['descript']);

// b.2截取长度
$res['descript']=mb_substr($res['descript'],0,35,'utf8').'...';

// c.处理价格12.25
$price=explode('.',$res['price']);

// c.1整数部分
$res['print_i']=$price[0];
// c.2c小数部分
$res['print_t']=$price[1];

//    d.处理评论星星数量
$res['stars']=5;

// e.评论数
$res['comment_count']=0;

   $tempArr[]=$res;



}

// 2.4二维数组去重
if(count($tempArr)>0){

 foreach($tempArr as $key =>$res){

  // 获取名称
  $bookname=$res['bookname'];
   
  //把图书名存入数组
  if(!in_array($bookname,$arrBookName)){
    $arrBookName[]=$bookname;
    $arrNew[]=$res;

  }
  

 }

}


// print_r ($tempArr);
// 2.4把数据转换成JSON格式，并返回给小程序
echo json_encode($arrNew);

?>