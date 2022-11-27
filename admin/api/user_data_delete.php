<?php
include dirname(__FILE__)."/./header.php";
if($_REQUEST["type"]=="one"){
    $res=mysqli_query($db,"DELETE FROM `user` WHERE `uid`='{$_REQUEST['uid']}'");
    if(!$res){
            $wrong=$_REQUEST["uid"];
        }
}else{
    $data=json_decode($_REQUEST["data"],true);
    foreach ($data as $datal){
        $res=mysqli_query($db,"DELETE FROM `user` WHERE `uid`='{$_REQUEST['uid']}'");
        if(!$res){
            break;
            $wrong=$datal["uid"];
        }
    }
}
if($res){
    echo return_json(array("code"=>200,"tip"=>"删除成功"));
}else{
    echo return_json(array("code"=>100,"tip"=>"删除失败,出错id".$wrong."，请刷新后重试"));
}
?>