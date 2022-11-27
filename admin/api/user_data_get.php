<?php
include dirname(__FILE__)."/./header.php";
$page=$_REQUEST["page"];
$limit=$_REQUEST["limit"];
if($page=="" or $limit==""){
    $page=1;
    $limit=10;
}
$start=($page-1)*$limit;
if($_REQUEST["type"]=="get"){
    $count=mysqli_query($db,"SELECT count(*) FROM `user`");
    $result=mysqli_query($db,"SELECT `uid`,`account`,`mail` FROM `user` LIMIT {$start},{$limit}");
}elseif($_REQUEST["type"]=="search"){
    $data=json_decode($_REQUEST["data"],true);
    $mail=$data["mail"];
    $account=$data["account"];
    $uid=$data["uid"];
    $add=" WHERE `account`!=''";
    if($uid!=""){
        $add.=" AND `uid`='{$uid}'";
    }
    if($mail!=""){
        $add.=" AND `mail` LIKE '%{$mail}%'";
    }
    if($account!=""){
        $add.=" AND `account` LIKE '%{$account}%'";
    }
    $count=mysqli_query($db,"SELECT count(*) FROM `user`".$add);
    $result=mysqli_query($db,"SELECT `uid`,`account`,`mail` FROM `user`".$add." LIMIT {$start},{$limit}");
}
$count=mysqli_fetch_row($count);
if($count[0]!=0){
    $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
}else{
    $result=array();
}
echo return_json(array
  ("code"=>0,
  "msg"=>0,
  "count"=>$count[0],
  "data"=>$result));
?>