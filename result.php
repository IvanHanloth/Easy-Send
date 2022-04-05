<?php
/*
By Ivan Hanloth
本文件为翰络云传文件提取接口文件
2022/4/3
*/
require "./config.php";
$db = mysqli_connect($dbpath, $dbaccount, $dbpassword, $dbname);
$r=$_REQUEST["key"];
$key=json_decode($r,true);
$key=$key["key"];
        $dbcount=mysqli_query($db,"SELECT count(*) FROM `data` WHERE `gkey` = '{$key}'");
        $dbcount=mysqli_fetch_row($dbcount);
    if($dbcount[0]==0){
        echo json_encode( array("code"=>"100","tip"=>"不存在此提取码或提取码已过期"),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }else{
        $dbinfo=mysqli_query($db,"SELECT * FROM `data` WHERE `gkey` = '{$key}'");
        $dbinfo=mysqli_fetch_assoc($dbinfo);
        $times=$dbinfo["times"]-1;
        $tillday=date('Y-m-d H:i:s', $dbinfo["tillday"]);
        echo json_encode( array("code"=>"200","times"=>$times,"type"=>$dbinfo["type"],"data"=>$dbinfo["data"],"tillday"=>$tillday),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        if($times>0){
            mysqli_query($db,"UPDATE `{$dbname}`.`data` SET `times` = '{$times}' WHERE `gkey` = '{$key}'");
        }else{
            if($dbinfo["type"]==1){
                $delete_file=unlink($dbinfo["path"]);
                if($delete_file==TRUE){
                    mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `gkey` = '{$key}'");
                };}elseif($dbinfo["type"]==2){
                    mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `gkey` = '{$key}'");
                }
        }
    };
?>