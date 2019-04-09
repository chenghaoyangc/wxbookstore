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
    $sql="SELECT m.id,musicname,singer,composer,writer,price,words,dt,cname FROM chy_music as m LEFT JOIN chy_class_child as c ON(m.ccid=c.id)
    ORDER BY m.id DESC";


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

            // 给目标提供数据
            $tempStr.='
            <tr>
            <td>'.$res['id'].'</td>
           <td>'.$res['cname'].'</td>
            <td>'.$res['musicname'].'</td>
            <td>'.$res['singer'].'</td>
            <td>'.$res['composer'].'</td>
            <td>'.$res['writer'].'</td>
            <td>'.$res['price'].'</td>
            <td>'.$res['words'].'</td>
            <td>'.$date.'</td>
            <td><a href="main.php?go=music_view&id='.$res['id'].'">预览</a>|
            <a href="main.php?go=music_edit&id='.$res['id'].'">修改</a>|
            <a href="main.php?go=music_del&id='.$res['id'].'">删除</a></td>
          </tr>               
            ';

    }
$msql->error();
// 载入模板
include 'pages/templates/musiclist.html';
?>

