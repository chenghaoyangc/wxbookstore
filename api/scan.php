<?php
// 引入公用文件
require_once('../include/common.in.php');
// echo $code;
if($code){

    $catagory=$pid='';

    $sql="SELECT id FROM chy_book WHERE code='".$code."' LIMIT 1";

    $msql->execute($sql);

    $res=$msql->fetchquery();

    if($res['id']){
        $catagory='book';
        $pid=$res['id'];
 
    }else{
        
        $sql="SELECT id FROM chy_music WHERE code='".$code."' LIMIT 1";

        $msql->execute($sql);

        $res=$msql->fetchquery();

        if($res['id']){
            $catagory='music';
            $pid=$res['id'];
        }else{
                    
        $sql="SELECT id FROM chy_movie WHERE code='".$code."' LIMIT 1";

        $msql->execute($sql);

        $res=$msql->fetchquery();
        
        if($res['id']){

            $catagory='movie';

            $pid=$res['id'];

            }

        }

  }
}

$tempArr['catagory']=$catagory;
$tempArr['pid']=$pid;



echo json_encode($tempArr);


?>