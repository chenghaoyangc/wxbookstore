<?php
// 页面编码,防止乱码
header("Content-type:text/html;charset=utf8");

// 接收id
$id=intval($id);

// 在删除数据之前删除文件
$sql="SELECT photourl FROM chy_swiper WHERE id=$id LIMIT 1";
$msql->execute($sql);
$res=$msql->fetchquery();
$photoUrl=$res['photourl'];
if(file_exists($photoUrl)){
    @unlink($photoUrl);
}



// 语句
$sql="DELETE FROM chy_swiper WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 获取执行结果
$as=$msql ->affectedRows();

if($as>0){
    echo '删除成功！';
    jump('main.php?go=swiper');
}else{
    echo '删除失败!';
}

// 载入模板
// include 'pages/templates/swiper_del.html';
?>

