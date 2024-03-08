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
$sessid=session_id();
$user=userinfo();
if(!$user) {
	$uid=0;
} else {
	$uid=$user["uid"];
}
if($_REQUEST["step"]=="input") {
	$data=$_REQUEST["data"];
	$data=json_decode($data,true);
	$roomid=$data["roomid"];
	$password=$data["roompassword"];
	if($roomid=="" or $password=="") {
		echo return_json(array("code"=>100,"tip"=>"缺少必要参数"));
		exit;
	}
	$a=base64_encode($password);
	$a=md5($a);
	$a=base64_encode($a);
	$roomtoken=base64_encode(md5($roomid).md5($a));
	$my_stmt=$db->prepare("SELECT * FROM `room` WHERE binary `roomid` = ? AND binary `password` = ?");
	$my_stmt->bind_param("ss",$roomid,$a);
	$my_stmt->execute();
	$result=$my_stmt->get_result();
	$my_stmt->close();
	if($result->num_rows==0){
		$my_stmt=$db->prepare("INSERT INTO `room` (`roomid`,`password`,`roomtoken`,`state`) VALUES (?,?,?,'waiting')");
		$my_stmt->bind_param("sss",$roomid,$a,$roomtoken);
		$my_stmt->execute();
		$my_stmt->close();
		$_SESSION["roomtoken"]=$roomtoken;
		$room=roominfo();
		echo return_json(array("code"=>200,"tip"=>"房间创建成功！","roomid"=>$roomid,"state"=>"waiting"));
		exit;
	}elseif($result->num_rows==1){
		$my_stmt=$db->prepare("SELECT * FROM `room` WHERE binary `password` = ? AND binary `roomid`=? AND binary `roomtoken`=?");
		$my_stmt->bind_param("sss",$a,$roomid,$roomtoken);
		$my_stmt->execute();
		$result=$my_stmt->get_result();
		$my_stmt->close();
		$room=roominfo();
		if($result->num_rows==1){
			$room=roominfo($roomtoken);
			if($room["receive"]!="" and $room["send"]!="" and $_SESSION["roomtoken"]!=$roomtoken){
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
} elseif($_REQUEST["step"]=="choose") {
	$room=roominfo();
	$roomid=$room["id"];
	$r_type=$_REQUEST["type"];
	$r_type_uid=$r_type.'uid';
	if($_REQUEST["type"]=="send") {
		$r_name="发送端";
	} elseif($_REQUEST["type"]=="receive") {
		$r_name="接收端";
	}
	if($room[$r_type]!="") {
		//存在该端
		if($_SESSION["roomtype".$room["rid"]]!=$r_type) {
			echo return_json(array("code"=>100,"tip"=>"已存在".$r_name));
			exit;
		} else {
			$my_stmt=$db->prepare("UPDATE `room` SET `{$r_type}`=?,`{$r_type_uid}`=? WHERE `rid`=? ");
			$my_stmt->bind_param("sii",$sessid,$uid,$room["rid"]);
			$my_stmt->execute();
			$my_stmt->close();
			$room=roominfo();
			if($room["send"]!="" and $room["receive"]!="") {
				$my_stmt=$db->prepare("UPDATE `room` SET `state`='connected' WHERE `rid`=? ");
				$my_stmt->bind_param("i",$room["rid"]);
				$my_stmt->execute();
				$my_stmt->close();
				$room=roominfo();
			}
			echo return_json(array("code"=>200,"tip"=>$r_name.'回归成功！',"state"=>$room["state"]));
			exit;
		}
	} else {
		//不存在该端
		if($room["state"]=="send-finish" or $room["state"]=="sending") {
			echo return_json(array("code"=>100,"tip"=>'上一次传输还未完成'));
			exit;
		} else {
			$my_stmt=$db->prepare("UPDATE `room` SET `{$r_type}`=?,`{$r_type_uid}`=? WHERE `rid`=? ");
			$my_stmt->bind_param("sii",$sessid,$uid,$room["rid"]);
			$my_stmt->execute();
			$my_stmt->close();
			$_SESSION['roomtype'.$room["rid"]]=$r_type;
			$room=roominfo();
			if($room["send"]!="" and $room["receive"]!="") {
				$my_stmt=$db->prepare("UPDATE `room` SET `state`='connected' WHERE `rid`=? ");
				$my_stmt->bind_param("i",$room["rid"]);
				$my_stmt->execute();
				$my_stmt->close();
				$room=roominfo();
			}
			echo return_json(array("code"=>200,"tip"=>$r_name.'创建成功！',"state"=>$room["state"]));
			exit;
		}
	}
} else {
	echo return_json(array("code"=>100,"tip"=>'没有此步骤'));
	exit;
}
?>