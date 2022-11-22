<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/../../common.php";

header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$room=roominfo();
$time=time();
$roomid=$room["roomid"];
if($_POST["state"]=="finish"){
    mysqli_query($db,"UPDATE `room` SET `total`='{$_POST['total']}',`origin`='{$_POST['origin']}',`size`='{$_POST['size']}',`state`='sending',`starttime`='{$now}' WHERE binary `roomid`='{$roomid}'");
    //清除当前room之前的数据
    $result=mysqli_query($db,"SELECT * FROM `roomdata` WHERE binary `roomid`='{$roomid}'");
    $num=mysqli_num_rows($result);
    if($num!=0){
    $result=mysqli_fetch_all($result,MYSQLI_BOTH);
    foreach($result as $num=>$content){
        $delete_file=unlink($content["path"]);
        if($delete_file){
                mysqli_query($db,"DELETE FROM `roomdata` WHERE `rdid`='{$content['rdid']}'");
            }
    }}
    mysqli_query($db,"UPDATE `room` SET `state`='finish' WHERE binary `roomid`='{$roomid}'");
    echo return_json(array("code"=>200));
    exit;
}
if($_SESSION["roomtype".$room["rid"]]!="receive"){
    echo return_json(array("code"=>100,"tip"=>"非法访问"));
    exit;
}
if($room["state"]!="send-finish" and $room["state"]!="sending"){
    echo return_json(array("code"=>100,"tip"=>"非法访问"));
    exit;
}
    if($room==false){
        echo return_json(array("code"=>100,"tip"=>"房间不存在"));
        exit;
    }
    $sql="SELECT * FROM `roomdata` WHERE binary `roomid`='{$roomid}'";
    $result=mysqli_query($db,$sql);
    $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo return_json($result);

?>