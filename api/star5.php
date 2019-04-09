<?php
// 引入公用文件
require_once('../include/common.in.php');

// 定义一个数组，用于存放最终数据
$allDatasArr=array();




//////////////////////////////////
// 图书五星第一名
// $sql="SELECT pid,count(*) as counts FROM chy_comment WHERE stars=5 AND catagory='book' ORDER BY dt DESC LIMIT 1";
$sql="SELECT pid,bookname,price,coverurl FROM chy_comment as c LEFT JOIN chy_book as b ON(c.pid=b.id) LEFT JOIN chy_cover as x ON (c.pid=x.bookid) WHERE stars=5 AND catagory='book' ORDER BY c.id DESC LIMIT 1";

$msql->execute($sql);

$res=$msql->fetchquery();

// 符合条件的ID
$book_pid=$res['pid'];

// 根据PID统计评论数
$sql="SELECT count(*) as total FROM chy_comment WHERE pid=$book_pid";
$msql->execute($sql);
$res_book_count=$msql->fetchquery();

$res['counts']=$res_book_count['total'];

$allDatasArr['book']=$res;

////////////

// 音乐五星第一名
$sql="SELECT pid,musicname,price,coverurl FROM chy_comment as c LEFT JOIN chy_music as b ON(c.pid=b.id)  WHERE stars=5 AND catagory='music' ORDER BY c.id DESC LIMIT 1";

$msql->execute($sql);

$res=$msql->fetchquery();

// 符合条件的ID
$music_pid=$res['pid'];

$sql="SELECT count(*) as total FROM chy_comment WHERE pid=$music_pid";
$msql->execute($sql);
$res_music_count=$msql->fetchquery();

$res['counts']=$res_music_count['total'];


$allDatasArr['music']=$res;
//////////////////

// 电影五星第一名
$sql="SELECT pid,moviename,price,coverurl FROM chy_comment as c LEFT JOIN chy_movie as b ON(c.pid=b.id)  WHERE stars=5 AND catagory='movie' ORDER BY c.id DESC LIMIT 1";

$msql->execute($sql);

$res=$msql->fetchquery();

// 符合条件的ID
$movie_pid=$res['pid'];

$sql="SELECT count(*) as total FROM chy_comment WHERE pid=$movie_pid";
$msql->execute($sql);
$res_movie_count=$msql->fetchquery();

$res['counts']=$res_movie_count['total'];


$allDatasArr['movie']=$res;
////////////////
  

    // 处理价格
$price=explode('.',$res['price']);
// c.1整数部分
$res['print_int']=$price[0];
// c.2c小数部分
$res['print_dec']=$price[1];

// $allDatasArr=$res;
$msql->error();
echo json_encode($allDatasArr);

?>