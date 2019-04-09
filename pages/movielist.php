<?php

    // 页面编码,防止乱码
    header("Content-type:text/html;charset=utf8");

    // 访问限制
    if(!defined('WWWROOT')){
      die('请求不被允许，请登录');
    }
    
    // 定义变量
    $tempStr='';

    // 查询语句
    $sql="SELECT id,class_style,class_country,moviename,director,writer,roles,price,dt FROM chy_movie ORDER BY id DESC";


    // 执行语句
    $msql->execute($sql);

    // 抓取数据
    while($res=$msql->fetchquery()){

      $date=date('Y-m-d',$res['dt']);
          // // 一级分类ID
          // $class_pid=$res['cid'];

          // // 查询一级分类名称
          // $sql="SELECT cname FROM chy_class_parent WHERE id=$class_pid LIMIT 1";
          // $msql ->execute($sql,'hhh');
          // $rex=$msql->fetchquery('hhh');
          // $class_pname=$rex['cname'];
          $date=date('Y-m-d',$res['dt']);
            // 给目标提供数据
            $tempStr.='
            <tr>
            <td>'.$res['id'].'</td>
           <td>'.$res['class_style'].'</td>
            <td>'.$res['moviename'].'</td>
            <td>'.$res['director'].'</td>
            <td>'.$res['writer'].'</td>
            <td>'.$res['price'].'</td>
            <td>'.$date.'</td>
            <td><a href="main.php?go=movie_view&id='.$res['id'].'">预览</a>|
            <a href="main.php?go=movie_edit&id='.$res['id'].'">修改</a>|
            <a href="main.php?go=movie_del&id='.$res['id'].'">删除</a></td>
          </tr>               
            ';

    }
$msql->error();
// 载入模板
include 'pages/templates/movielist.html';
?>

