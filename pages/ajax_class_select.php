<?php

// 接收AJAX参数
$id=intval($id);

// 初始化
$data='';

// 根据ID从数据库中读取该一级分类下的二级分类
$sql="SELECT id,cname FROM chy_class_child WHERE cid=$id";

$msql->execute($sql);

while($res=$msql->fetchquery()){

$data.='<option value="'.$res['id'].'">'.$res['cname'].'</option>';


};
echo $data;

?>