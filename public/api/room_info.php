<?php
include dirname(__FILE__)."/../../common.php";

header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$room=roominfo();
if($room==false){
    echo return_json(array("code"=>100,"tip"=>"房间不存在"));
    exit;
}
echo return_json(array("code"=>200,"roomid"=>$room['roomid'],"state"=>$room["state"],"type"=>
        $_SESSION["roomtype".$room["rid"]],"total"=>$room["total"],"origin"=>$room["origin"],"qrcode"=>$qrcode.$domain."?roomid=".$room['roomid']."&roompassword=".$room['roompassword']));
?>