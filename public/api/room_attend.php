<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/../../common.php";
session_start();
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
if($_REQUEST["step"]=="input"){
    $data=$_REQUEST["data"];
    $data=json_decode($data,true);
    $roomid=$data["roomid"];
    $password=$data["roompassword"];
    if($roomid=="" or $password==""){
        echo return_json(array("code"=>100,"tip"=>"缺少必要参数"));
        exit;
    }
    $a=base64_encode($password);
    $a=md5($a);
    $a=base64_encode($a);
    $roomtoken=base64_encode(md5($roomid).md5($a));
    $check=mysqli_query($db,"SELECT count(*) FROM `room` WHERE binary `roomid` = '{$roomid}'");
    $check=mysqli_fetch_row($check);
    if($check[0]==0){
        mysqli_query($db,"INSERT INTO `room` (`roomid`,`password`,`roomtoken`,`state`) VALUES ('{$roomid}','{$a}','{$roomtoken}','waiting')");
        $_SESSION["roomtoken"]=$roomtoken;
        $room=roominfo();
        echo return_json(array("code"=>200,"tip"=>"房间创建成功！","roomid"=>$roomid,"state"=>"waiting"));
        exit;
    }elseif($check[0]==1){
        $check=mysqli_query($db,"SELECT count(*) FROM `room` WHERE binary `password` = '{$a}' AND binary `roomid`='{$roomid}' AND binary `roomtoken`='{$roomtoken}'");
        $check=mysqli_fetch_row($check);
        $room=roominfo();
        if($check[0]==1){
            $room=roominfo($roomtoken);
            if($room["receive"]>=1 and $room["send"]>=1 and $_SESSION["roomtoken"]!=$roomtoken){
                echo return_json(array("code"=>100,"tip"=>"房间已满员"));
                exit;
            }else{
                $_SESSION["roomtoken"]=$roomtoken;
                echo return_json(array("code"=>200,"tip"=>"房间加入成功！","roomid"=>$room['roomid'],"state"=>$room["state"]));
                exit;
            }
        }else{
            echo return_json(array("code"=>100,"tip"=>"房间号或密码错误"));
            exit;
        }
    }else{
        echo return_json(array("code"=>100,"tip"=>"系统错误"));
        exit;
    }
}elseif($_REQUEST["step"]=="choose"){
    $room=roominfo();
    $roomid=$room["id"];
    $r_type=$_REQUEST["type"];
    if($_REQUEST["type"]=="send"){
        $r_name="发送端";
    }elseif($_REQUEST["type"]=="receive"){
        $r_name="接收端";
    }

        if($room[$r_type]>=1){//存在该端
            if($_SESSION["roomtype".$room["rid"]]!=$r_type){
                echo return_json(array("code"=>100,"tip"=>"已存在".$r_name));
                exit;
            }else{
                mysqli_query($db,"UPDATE `room` SET `{$r_type}`='1' WHERE `rid`='{$room['rid']}'");
                $room=roominfo();            
                if($room["send"]==1 and $room["receive"]==1){
                mysqli_query($db,"UPDATE `room` SET `state`='connected' WHERE `rid`='{$room['rid']}'");
                $room=roominfo();
            }
                echo return_json(array("code"=>200,"tip"=>$r_name.'回归成功！',"state"=>$room["state"]));
                exit;
            }
        }else{//不存在该端
            if($room["state"]=="send-finish" or $room["state"]=="sending"){
                echo return_json(array("code"=>100,"tip"=>'上一次传输还未完成'));
                exit;
            }else{
                mysqli_query($db,"UPDATE `room` SET `{$r_type}`='1' WHERE `rid`='{$room['rid']}'");
                $_SESSION['roomtype'.$room["rid"]]=$r_type;
                $room=roominfo();
                if($room["send"]==1 and $room["receive"]==1){
                    mysqli_query($db,"UPDATE `room` SET `state`='connected' WHERE `rid`='{$room['rid']}'");
                    $room=roominfo();
                }
                echo return_json(array("code"=>200,"tip"=>$r_name.'创建成功！',"state"=>$room["state"]));
                exit;
            }
        }
}else{
    echo return_json(array("code"=>100,"tip"=>'没有此步骤'));
    exit;
}
?>