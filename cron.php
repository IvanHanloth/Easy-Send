<?php
/*
By Ivan Hanloth
本文件为翰络云传数据监控文件
2022/4/9
*/
require "./config.php";
$db = mysqli_connect($dbpath, $dbaccount, $dbpassword, $dbname);
if (mysqli_connect_errno($db)){ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
};
$now=time();
$num=mysqli_query($db,"SELECT * FROM `data`");
$num=mysqli_num_rows($num);
$result=mysqli_query($db,"SELECT * FROM `data` ORDER BY `id`");
$result=mysqli_fetch_all($result,MYSQLI_BOTH);
for($i=0;$i<=$num;$i++){
    if($result[$i]["tillday"]<=$now){
        if($result[$i]["type"]==1){
            $delete_file=unlink($result[$i]["path"]);
            if($delete_file==TRUE){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$result[$i]['id']}'");
            }else{
                echo "";
            };
            
        }elseif($result[$i]["type"]==2){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$result[$i]['id']}'");
            }
    };
};
echo "finish";
?>