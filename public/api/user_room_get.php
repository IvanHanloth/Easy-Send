<?php
header("Content-type:text/json");
include dirname(__FILE__)."/../../common.php";
$user=userinfo();
if(!$user){
    echo return_json(array("code"=>100,'tip'=>"非法访问"));
    exit;
}
$page=$_REQUEST["page"];
$limit=$_REQUEST["limit"];
if($page=="" or $limit==""){
    $page=1;
    $limit=10;
}
$start=($page-1)*$limit;
$count=mysqli_query($db,"SELECT count(*) FROM `room` WHERE `receiveuid`='{$user['uid']}' OR `senduid`='{$user['uid']}' ");
$result=mysqli_query($db,"SELECT `roomid`,`roompassword`,`senduid`,`receiveuid`,`state` FROM `room` WHERE `receiveuid`='{$user['uid']}' OR `senduid`='{$user['uid']}' LIMIT {$start},{$limit}");

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