<?php
header("Content-type:text/json");
include dirname(__FILE__)."/../../common.php";
$user=userinfo();
if(!$user){
    echo return_json(array("code"=>100,'tip'=>"非法访问"));
    exit;
}
$data=json_decode($_POST["data"],true);
$a=$data["password"];
$a=base64_encode($a);
$a=md5($a);
$a=base64_encode($a);
$usertoken=md5(base64_encode($data['account'])).md5($a);
if($data["newpassword"]=="" and $data["renewpassword"]=="" and $data["password"]==""){
    mysqli_query($db,"UPDATE `user` SET `account`='{$data['account']}',`mail`='{$data['mail']}',`usertoken`='{$usertoken}' WHERE `uid`='{$user['uid']}'");
    echo return_json(array("code"=>200,"tip"=>"修改成功，请重新登录")); 
    exit;
}
if($data['newpassword']!="" or $data["renewpassword"]!=""){
    if($data["renewpassword"]!=$data["newpassword"]){
        echo return_json(array("code"=>100,"tip"=>"两次新密码不一致"));
        exit;
    }
    if($a!=$user['password']){
        echo return_json(array("code"=>200,"tip"=>"原密码输入错误"));
        exit;
    }
    $a=$data["newpassword"];
    $a=base64_encode($a);
    $a=md5($a);
    $a=base64_encode($a);
    $usertoken=md5(base64_encode($data['account'])).md5($a);
    mysqli_query($db,"UPDATE `user` SET `account`='{$data['account']}',`mail`='{$data['mail']}',`usertoken`='{$usertoken}',`password`='{$a}' WHERE `uid`='{$user['uid']}'");
    echo return_json(array("code"=>200,"tip"=>"修改成功，请重新登录")); 
    exit;
}
?>