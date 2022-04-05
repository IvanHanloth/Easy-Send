<?php
/*
By Ivan Hanloth
本文件为翰络云传数据监控文件
2022/4/4
*/
require "./config.php";
$db = mysqli_connect($dbpath, $dbaccount, $dbpassword, $dbname);
$now=time();
$num=mysqli_query($db,"SELECT count(*) FROM `data`");
$num=mysqli_fetch_row($num);//sql对象转化为数组
$list=mysqli_query($db,"SELECT `tillday` FROM `data`");
$list=mysqli_fetch_row($list);//sql对象转化为数组
$idlist=mysqli_query($db,"SELECT `id` FROM `data`");
$idlist=mysqli_fetch_row($idlist);//sql对象转化为数组
for($i=0;$i<=$num[0]-1;$i++){
    if($list[$i]<=$now){
    $dbinfo=mysqli_query($db,"SELECT * FROM `data` WHERE `id` = '{$idlist[$i]}'");
    $dbinfo=mysqli_fetch_assoc($dbinfo);
        if($dbinfo["type"]==1){
            $delete_file=unlink($dbinfo["path"]);
            if($delete_file==TRUE){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$idlist[$i]}'");
            };
            
        }elseif($dbinfo["type"]==2){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$idlist[$i]}'");
            }
    };
};
echo "finish";
?>