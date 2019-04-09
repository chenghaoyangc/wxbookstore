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
    $sql="DELETE FROM chy_book WHERE id=$id";

    $msql->execute($sql);
    $as=$msql->affectedRows();

    // 如果主表数据删除成功了
    if($as>0){

        $sql="SELECT coverurl FROM chy_cover WHERE bookid=$id";
        $msql->execute($sql);
        while($res=$msql ->fetchquery()){

            // 文件路径
            $path=$res['coverurl'];

            // 删除封面(文件)
           if(file_exists($path)){
               unlink($path);
           }

        }


        // 删除封面(数据)
        $sql="DELETE FROM chy_cover WHERE bookid=$id";

        $msql->execute($sql);
        $as=$msql->affectedRows();

        jump('main.php?go=booklist');
    }

    // 删除封面(数据+文件)
    

  ?>

