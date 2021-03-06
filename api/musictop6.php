<?php
// 引入公用文件
require_once('../include/common.in.php');

// 查询销量最高的6首歌曲
$sql="SELECT pid,sum(counts) as total,musicname,coverurl,price FROM chy_order as o LEFT JOIN chy_music as m ON (o.pid=m.id) WHERE catagory='music' GROUP BY pid ORDER BY total DESC LIMIT 0,6";

$msql->execute($sql);
/////////////////////////////////////

// 查询销量最高的6首歌曲
// $sql="SELECT pid,sum(counts) as total,moviename,coverurl,price FROM chy_order as o LEFT JOIN chy_movie as m ON (o.pid=m.id) WHERE catagory='movie' GROUP BY pid ORDER BY total DESC LIMIT 0,6";

$msql->execute($sql);
while($res=$msql->fetchquery()){
  
    // 处理星星数
    $pid=$res['pid'];

    $sql="SELECT AVG(stars) as avgstars FROM chy_comment WHERE catagory='music' AND pid=$pid";

    $msql->execute($sql,'xxx');

    $res_star=$msql->fetchquery('xxx');

    $res_star['avgstars']=$res_star['avgstars']?$res_star['avgstars']:5;

    $res['stars']=ceil($res_star['avgstars']);

    $tempArr[]=$res;

}

$msql->error();
echo json_encode($tempArr);

?>