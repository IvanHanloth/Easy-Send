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
    $query=mysqli_query($db,"UPDATE `room` SET `{$type}`='' WHERE `rid`='{$room['rid']}'");
    if(!$query){
        echo return_json(array("code"=>100,"tip"=>"退出失败"));
        exit;
    }
}
$_SESSION["roomtype".$room["rid"]]="";
$url=$domain."cron.php";
$curl = curl_init();
$timeout = 10;
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
$content = curl_exec($curl);
curl_close($curl);
echo return_json(array("code"=>200,"tip"=>"退出成功"));
?>