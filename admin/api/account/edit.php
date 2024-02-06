<?php
include dirname(__FILE__)."/../header.php";
if($_POST["adminpassword"]==""){
    save_setting("account",$_POST["adminaccount"]);
    echo return_json(array("code"=>200,"tip"=>'账号修改成功，请重新登录'));
    exit;
}else{
    if($_POST["adminpassword"]!=$_POST["adminrepassword"]){
        echo return_json(array("code"=>100,"tip"=>'两次输入的密码不一致'));
        exit;
    }
    $a=$_POST["adminpassword"];
    $a=base64_encode($a);
    $a=md5($a);
    $a=base64_encode($a);
    save_setting("account",$_POST["adminaccount"]);
    save_setting("password",$a);
    echo return_json(array("code"=>200,"tip"=>'账号密码修改成功，请重新登录'));
    exit;
}
?>