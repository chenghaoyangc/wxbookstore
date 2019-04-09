<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 访问限制
if(!defined('WWWROOT')){
  die('请求不被允许，请登录');
}

// 接收表单数据
$id=intval($id);

// 1.一级分类ID
// $class_pid=intval($pclass);

// 2.二级分类ID
$class_cid=intval($cclass);

// 3.书名
$bookname=trim($bookname);

// 4.作者
$author=trim($author);

// 5.出版社
$public=trim($public);

// 6.价格
$price=trim($price);

// 7.封面
$poster=$_FILES['poster'];

// 8.图书介绍
$descript=trim(stripslashes($descript));

// 9.上架日期
$dt=strtotime($dt);

// echo $class_pid.'</br>'.$class_cid.'</br>'.$bookname.'</br>'.$author.'</br>'.$public.'</br>'.$price.'</br>'.$descript.'</br>'.$dt.'</br>';
// print_r($poster);

// 初始化变量
$result_upload=$result_book=$result_poster='';


// 数据验证

// if(!$class_cid || !is_numeric($class_cid)){
//     die('分类有误');
// }

// if(strlen($bookname)<2 || !$author || !$public || !$price){
//     die('填写不规范');
// }

// 处理封面上传


if($poster['name'][0]){

    // 文件名
    $arrFn=$poster['name'];

    // 临时文件
    $arrTemp=$poster['tmp_name'];
 
    // 定义临时数组
    $tempDestArr=array();

    // 遍历临时文件
    foreach($arrTemp as $key=> $item){

    //   临时文件名
    $tempFile=$item;

    // 新文件名
    $newFileName=time().mt_rand(1,100);
      
    // 旧的文件名
    $oldName=$arrFn[$key];

    // 扩展名
    $pathInfo=pathinfo($oldName);
    $extension=$pathInfo['extension'];

    // 服务器文件路径
    $destFile='upload/'.$newFileName.'.'.$extension;

    // 执行长传
    if(move_uploaded_file($tempFile,$destFile)){
        $tempDestArr[]=$destFile;
        $result_upload='封面上传成功!<br />';
    }else{
        $result_upload='封面上传失败!<br />';
    }
}

}


//////////////////////////////////////////
// 入库操作

// 1.图书入库
// $sql="INSERT INTO chy_book(cid,ccid,bookname,author,public,price,descript,dt) VALUES($class_pid,$class_cid,'".$bookname."','".$author."','".$public."','".$price."','".$descript."',$dt)";
$sql="UPDATE chy_book SET ccid=$class_cid,bookname='".$bookname."',author='".$author."',
public='".$public."',price=$price,descript='".$descript."',dt=$dt WHERE id=$id";

// 2.封面入库

// 2.执行语句
$msql->execute($sql);

// 获取最近一次入库的数据ID
$as=$msql -> affectedRows();

if($as>0){
  $result_book='图书数据入库成功!<br />';
 
}else{
    $result_book='图书数据入库失败! <br />';
}


// 2.封面入库

if(count($tempDestArr)>0){

    foreach($tempDestArr as $url){
      
        // 语句
        $sql="INSERT INTO chy_cover(bookid,coverurl) VALUES ($id,'".$url."')";

        // 执行语句
        $msql->execute($sql);
       
        $as=$msql->affectedRows();
        if($as>0){
             $result_poster='封面入库成功!<br />';
        }else{
            $result_poster='封面入库失败! <br />';
        }

}
}

$msql->error();

include 'pages/templates/book_edit_do.html';
?>

