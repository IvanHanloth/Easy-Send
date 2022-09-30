<?php
session_start();
include dirname(__FILE__)."/../../common.php";
if($_SESSION["admin"]!=$admintoken){
    echo return_json(array("code"=>200,"tip"=>'修改成功，请重新登录'));
    exit;
}
$data=json_decode($_POST["data"],true);
if($data["adminpassword"]==""){
    save_setting("account",$data["adminaccount"]);
    echo return_json(array("code"=>200,"tip"=>'账号修改成功，请重新登录'));
    exit;
}else{
    $a=$data["adminpassword"];
    $a=base64_encode($a);
    $a=md5($a);
    $a=base64_encode($a);
    save_setting("account",$data["adminaccount"]);
    save_setting("password",$a);
    echo return_json(array("code"=>200,"tip"=>'账号密码修改成功，请重新登录'));
    exit;
}
?>