<?php
/*
By Ivan Hanloth
本文件为易传文本存储接口文件
2022/4/4
*/
require "./config.php";
require "./common.php";

    $db=mysqli_connect($dbpath, $dbaccount, $dbpassword, $dbname);
    $r=$_POST["data"];
    $data=json_decode($r,true);
    $tillday=time()+864000;//剩余时长
    $tilltime=date('Y-m-d H:i:s', $tillday);
    $check=array(1);//定义进行循环检查
    while ($check[0]>=1){//进行循环检查
        $key=random(4);//获得一个key
        $check=mysqli_query($db,"SELECT count(*) FROM `data` WHERE `gkey` = '{$key}'");//获取数据库中是否存在相同key
        $check=mysqli_fetch_row($check);//sql对象转化为数组
        };
    mysqli_query($db,"INSERT INTO `data` (`id`, `gkey`, `type`, `data`, `tillday`, `times`) VALUES (NULL, '{$key}', '2', '{$data['text']}', '{$tillday}', '{$times}')");//插入数据
    echo json_encode( array("code"=>"200","tip"=>"文本保存成功","key"=>$key,"tillday"=>$tilltime,"times"=>$times),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

?>