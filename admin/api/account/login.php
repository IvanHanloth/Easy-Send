<?php
session_start();
include dirname(__FILE__)."/../../../common.php";
header('Content-Type:application/json; charset=utf-8');
$a=$_POST["password"];
$a=base64_encode($a);
$a=md5($a);
$a=base64_encode($a);
if($_POST['captcha']=="" or $_POST['captcha']==null){
    echo return_json(array("code"=>"100","tip"=>"请输入验证码"));
    exit;
}
if(strtoupper($_POST["captcha"])!=strtoupper($_SESSION["captcha"])){
    echo return_json(array("code"=>"100","tip"=>"验证码错误"));
    exit;
}
if($_POST["account"]==$adminaccount and $a==$adminpassword){
    $_SESSION["admin"]=$admintoken;
    echo return_json(array("code"=>"200","tip"=>"欢迎回来！正在跳转……"));
}elseif($_POST["account"]!=$adminaccount or $a!=$adminpassword){
    echo return_json(array("code"=>"100","tip"=>"用户名或密码错误"));
}
?>