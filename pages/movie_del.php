<?php
    // 页面编码,防止乱码
    header("Content-type:text/html;charset=utf8");

    // 访问限制
    if(!defined('WWWROOT')){
      die('请求不被允许，请登录');
    }

    // 接收ID
    $id=intval($id);

    // 删除封面文件
    $sql="SELECT coverurl FROM chy_movie WHERE id=$id LIMIT 1";
     

    $msql->execute($sql);
   

    $res=$msql->fetchquery();

    $urel=$res['coverurl'];

    if(file_exists($url)){

      @unlink($url);

    }

    // 删除数据
    $sql="DELETE FROM chy_movie WHERE id=$id";
    $msql->execute($sql);

    $as=$msql->affectedRows();

    if($as>0){
        $result="删除成";

        // 跳转到列表页面
        jump('main.php?go=movielist',0);
    }else{
        $result='删除失败';
    }



?>