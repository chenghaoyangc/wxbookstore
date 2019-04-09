<?php

    // 页面编码,防止乱码
    header("Content-type:text/html;charset=utf8");

    // 访问限制
    if(!defined('WWWROOT')){
      die('请求不被允许，请登录');
    }
    
    //    获取ID
    $id=intval($id);

    //删除语句
    $sql="SELECT musicurl,coverurl FROM chy_music WHERE id=$id LIMIT 1";
    // $sql="DELETE FROM chy_music WHERE id=$id";
    $msql->execute($sql);
    $res=$msql->fetchquery();

// 封面地址
$coverUrl=$res['coverurl'];

// 音频地址
$musicurl=$res['musicurl'];


  

      // 判断文件是否存在，如果存在就删除
      if(file_exists($coverUrl)){
          @unlink($coverUrl);
      }

      if(file_exists($musicurl)){
      @unlink($musicurl);
  }

        // 删除封面(数据)
        $sql="DELETE FROM chy_music WHERE id=$id";
        // echo $sql;
        $msql->execute($sql);


      $as=$msql->affectedRows();
      if($as>0){
        $result='删除成功!';
        jump('main.php?go=musiclist');
      }else{
        $result='删除失败！';
      }


$msql->error();
    include 'pages/templates/music_del.html';

  ?>

