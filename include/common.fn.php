<?php
// 页面跳转
function jump($go,$time='1000'){
    echo '<script>';
    echo'setTimeout(function(){location.href="'.$go.'"},'.$time.')';
    echo'</script>';
}



// 检查登录权限
function checkAuthor(){

  // echo $_SESSION['admin'];
// 获取session
if(!$_SESSION['admin']&& !preg_match('/^[A-Z]{6}$/',$_SESSION['admin'])){

// 跳转到登录页面
jump('login.html');

// 阻止代码继续执行
die();

  }

}

// 文件上传

function uploadFile($arrFile,$dir='upload'){

  // 判断路径是否存在，不存在则创建
   if(!file_exists($dir)){
     mkdir($dir);
   }


   // 确保提交了数据
   if(is_array($arrFile['name'])){//处理一次多个文件
 
    // 文件名
    $arrFn=$arrFile['name'];

    // 临时文件
    $arrTemp=$arrFile['tmp_name'];
 
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
    }
}
 return $tempDestArr;
}else{//处理一次上传单个文件

  // 临时文件
  $tempFile=$arrFile['tmp_name'];

   // 新文件名
    $newFileName=time().mt_rand(1,100);
      
    // 旧的文件名
    $oldName=$arrFile['name'];

    // 扩展名
    $pathInfo=pathinfo($oldName);
    $extension=$pathInfo['extension'];

       // 服务器文件路径
       $destFile=$dir.'/'.$newFileName.'.'.$extension;

       if(move_uploaded_file($tempFile,$destFile)){
        return $destFile;
     
    }else{
        return'封面上传失败!<br />';
    }
}

}


?>