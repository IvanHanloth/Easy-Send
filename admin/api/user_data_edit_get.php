<?php
include dirname(__FILE__)."/./header.php";
$data=mysqli_query($db,"SELECT * FROM `user` WHERE `uid`='{$_REQUEST['uid']}'");
$data=mysqli_fetch_assoc($data);
echo return_json(array("account"=>$data["account"],"mail"=>$data["mail"]))
?>