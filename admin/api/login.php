<?php
session_start();
include dirname(__FILE__)."/../../common.php";
$a=$_POST["password"];
$a=base64_encode($a);
$a=md5($a);
$a=base64_encode($a);
if($_POST["account"]==$adminaccount and $a==$adminpassword){
    $_SESSION["admin"]=$admintoken;
    echo json_encode(array("code"=>"200","tip"=>"欢迎回来！正在跳转……"),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}elseif($_POST["account"]!=$adminaccount or $a!=$adminpassword){
    echo json_encode(array("code"=>"100","tip"=>"用户名或密码错误"),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}
?>