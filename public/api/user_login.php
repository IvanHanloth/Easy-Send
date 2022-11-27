<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/11/23
*/
include dirname(__FILE__)."/../../common.php";
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$a=$_POST["password"];
$a=base64_encode($a);
$a=md5($a);
$a=base64_encode($a);
if($_POST['type']=="login"){
    if(preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$_POST['account'])==0){
        $sql="SELECT count(*) FROM `user` WHERE `account`='{$_POST['account']}'";
    }else{
        $sql="SELECT count(*) FROM `user` WHERE `mail`='{$_POST['account']}'";
    }
    $count=mysqli_query($db,$sql);
    $count=mysqli_fetch_array($count);
    if($count[0]!=1){
        echo return_json(array("code"=>100,"tip"=>"不存在此账户"));
        exit;
    }else{
        if(preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$_POST['account'])==0){
            $sql="SELECT count(*) FROM `user` WHERE `account`='{$_POST['account']}' AND `password`='{$a}'";
        }else{
            $sql="SELECT count(*) FROM `user` WHERE `mail`='{$_POST['account']}' AND `password`='{$a}'";
        }
        $count=mysqli_query($db,$sql);
        $count=mysqli_fetch_array($count);
        if($count[0]!=1){
            echo return_json(array("code"=>100,"tip"=>"账号或密码错误"));
            exit;
        }else{
            if(preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$_POST['account'])==0){
                $sql="SELECT `account` FROM `user` WHERE `account`='{$_POST['account']}' AND `password`='{$a}'";
            }else{
                $sql="SELECT `account` FROM `user` WHERE `mail`='{$_POST['account']}' AND `password`='{$a}'";
            }
            $account=mysqli_query($db,$sql);
            $account=mysqli_fetch_array($account);
            $account=$account[0];
            $usertoken=md5(base64_encode($account)).md5($a);
            setcookie("usertoken",$usertoken,time()+3600*24*30,"/");
            echo return_json(array("code"=>200,"tip"=>"登录成功！欢迎".$account."回来"));
            exit;
        }
    }
}elseif ($_POST["type"]=="register") {
    $sql="SELECT count(*) FROM `user` WHERE `mail`='{$_POST['mail']}' OR `account`='{$_POST['account']}'";
    $count=mysqli_query($db,$sql);
    $count=mysqli_fetch_array($count);
    $account=$_POST["account"];
    $usertoken=md5(base64_encode($account)).md5($a);
    if($count[0]==0){
        $sql="INSERT INTO `user` (`account`,`password`,`mail`,`usertoken`) VALUES ('{$_POST['account']}','{$a}','{$_POST['mail']}','{$usertoken}')";
        $query=mysqli_query($db,$sql);
        if($query){
            setcookie("usertoken",$usertoken,time()+3600*24*30,"/");
            echo return_json(array("code"=>200,'tip'=>"注册成功！欢迎".$account."加入"));
            exit;
        }else{
            echo return_json(array("code"=>100,"tip"=>"数据库出错"));
            exit;
        }
    }else{
        echo return_json(array("code"=>100,"tip"=>"该账号或邮箱已被注册"));
        exit;
    }
}else{
    echo return_json(array("code"=>200,"tip"=>"无此类型"));
}
?>