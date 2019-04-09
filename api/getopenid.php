<?php
// 引入公用文件
require_once('../include/common.in.php');

// 获取code
$code=$code;

// 获取openid
$res=file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid=wx6c976f16465b2a18&secret=d0dff67a818f0def29f7c2e760aafa3f&js_code='.$code.'&grant_type=authorization_code');

// 输出json
echo $res;


?>