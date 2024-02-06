<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");

include dirname(__FILE__)."/../../common.php";
$room=roominfo();
if($room==false){
    echo return_json(array("code"=>100,"tip"=>"房间不存在"));
    exit;
}
$type=$_SESSION["roomtype".$room["rid"]];
if($type!=""){
    $my_stmt=$db->prepare("UPDATE `room` SET `{$type}`='',`state`='waiting' WHERE `rid`=? ");
    $my_stmt->bind_param("i",$room['rid']);
    $query=$my_stmt->execute();
    $my_stmt->close();
    if(!$query){
        echo return_json(array("code"=>100,"tip"=>"退出失败"));
        exit;
    }
}
$_SESSION["roomtype".$room["rid"]]="";
ob_clean();
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
echo return_json(array("code"=>200,"tip"=>"退出成功"));
ob_flush();
flush();
$url=$domain."cron.php";
file_get_contents($url);
?>