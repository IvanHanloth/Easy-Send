<?php
include dirname(__FILE__)."/./header.php";
$data=json_decode($_POST["data"],true);
$uid=$_REQUEST["uid"];
foreach ($data as $name=>$content){
    if($name=="password"){
        $account=mysqli_query($db,"SELECT `account` FROM `user` WHERE `uid`={$uid}");
        $account=mysqli_fetch_array($account);
        $account=$account[0];
        $a=$content;
        $a=base64_encode($a);
        $a=md5($a);
        $a=base64_encode($a);
        $usertoken=md5(base64_encode($account)).md5($a);
        mysqli_query($db,"UPDATE `user` SET `password`='{$a}',`usertoken`='{$usertoken}' WHERE `uid`='{$uid}'");
        continue;
    }
    if($name=="account"){
        $password=mysqli_query($db,"SELECT `password` FROM `user` WHERE `uid`={$uid}");
        $password=mysqli_fetch_array($password);
        $a=$password[0];
        $usertoken=md5(base64_encode($content)).md5($a);
        mysqli_query($db,"UPDATE `user` SET `account`='{$content}',`usertoken`='{$usertoken}' WHERE `uid`='{$uid}'");
        continue;
    }
    if($name=="mail"){
        mysqli_query($db,"UPDATE `user` SET `mail`='{$content}' WHERE `uid`='{$uid}'");
        continue;
    }
}
echo return_json(array("code"=>200,"tip"=>'保存成功'))
?>