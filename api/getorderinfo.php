<?php
// 引入公用文件
require_once('../include/common.in.php');

// 接收OPENID
$openid=$openid;

if($openid){
    $sql="SELECT pid,catagory,dt FROM chy_order WHERE openid='".$openid."'";

    $msql->execute($sql);

    while($res=$msql->fetchquery()){
       
        // 初始化
        $arrBook=$arrMusic= $arrMovie=array();
 
        // 分类
        $class=$res['catagory'];

        // 产品ID
        $pid=$res['pid'];

        // 根据不同的分类，去不同表中查找该pid对应的数据（名称，封面，价格）

        if($class=='book'){

           $sql="SELECT bookname,price,coverurl FROM chy_book as b LEFT JOIN chy_cover as c ON (b.id=c.bookid) WHERE b.id=$pid LIMIT 1";

           $msql->execute($sql,'book');

           $res_book=$msql->fetchquery('book');

        //    产品名称
        $pname=$res_book['bookname'];

        $res_book['pname']=$pname;

        // 产品价格
        $pprice=$res_book['price'];

        // 封面
        $pcover=$res_book['coverurl'];
        
        //产品ID
        $res_book['catagory']=$class;

        $res_book['pid']=$pid;


        // 上架日期
        $res_book['dt']=date('Y-m-d',$res['dt']);

        $arrBook[]=$res_book;

        //  评论
       $sql="SELECT stars,notes,dt FROM chy_comment WHERE catagory='book' AND pid=$pid AND openid='".$openid."' ORDER BY id DESC LIMIT 1";
         
       $msql->execute($sql,'comment');

       $res_comment=$msql->fetchquery('comment');
       $res_comment['date']=date('Y-m-d',$res_comment['dt']);
       $res_book['comment']=$res_comment;

    //       //    存入总数组 
        $tempArr[]=$res_book;

        }


        if($class=='music'){

            $sql="SELECT musicname,price,coverurl FROM chy_music  WHERE id=$pid LIMIT 1";
 
            $msql->execute($sql,'music');
 
            $res_music=$msql->fetchquery('music');

         $res_music['pname']=$res_music['musicname'];
         //    产品名称
         $pname=$res_music['musicname'];
         // 产品价格
         $pprice=$res_music['price'];
 
         // 封面
         $pcover=$res_music['coverurl'];
         
         //产品ID
         $res_music['catagory']=$class;
 
         $res_music['pid']=$pid;
 
 
         // 上架日期
         $res_music['dt']=date('Y-m-d',$res['dt']);
 
 
    //    //  评论
       $sql="SELECT stars,notes,dt FROM chy_comment WHERE catagory='music' AND pid=$pid AND openid='".$openid."' ORDER BY id DESC LIMIT 1";
         
       $msql->execute($sql,'comment2');

       $res_comment=$msql->fetchquery('comment2');
       $res_comment['date']=date('Y-m-d',$res_comment['dt']);
       $res_book['comment']=$res_comment;

        //  存入总数组
         $tempArr[]=$res_music;
 
         }

         if($class=='movie'){

            $sql="SELECT moviename,price,coverurl FROM chy_movie  WHERE id=$pid LIMIT 1";
 
            $msql->execute($sql,'movie');
 
            $res_movie=$msql->fetchquery('movie');
           
            $res_movie['pname']=$res_movie['moviename'];
         //    产品名称
         $pname=$res_movie['moviename'];
         // 产品价格
         $pprice=$res_movie['price'];
 
         // 封面
         $pcover=$res_movie['coverurl'];
         
         //产品ID
         $res_movie['catagory']=$class;
 
         $res_movie['pid']=$pid;
 
 
         // 上架日期
         $res_movie['dt']=date('Y-m-d',$res['dt']);
 
 
        // //  评论
        $sql="SELECT stars,notes,dt FROM chy_comment WHERE catagory='movie' AND pid=$pid AND openid='".$openid."' ORDER BY id DESC LIMIT 1";
         
        $msql->execute($sql,'comment3');
 
        $res_comment=$msql->fetchquery('comment3');
        $res_comment['date']=date('Y-m-d',$res_comment['dt']);
        $res_book['comment']=$res_comment;

        //  存入总数组
         $tempArr[]=$res_movie;
 
         }


    }
//   echo $sql;
    // $msql->error();
    echo json_encode($tempArr);
}

?>