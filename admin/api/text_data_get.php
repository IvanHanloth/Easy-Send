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
    $count=mysqli_query($db,"SELECT count(*) FROM `data` WHERE `type`='1' ");
    $result=mysqli_query($db,"SELECT `id`,`preview`,`times`,`tillday` FROM `data` WHERE `type`='2' LIMIT {$start},{$limit}");
}elseif($_REQUEST["type"]=="search"){
    $data=json_decode($_REQUEST["data"],true);
    $preview=$data["preview"];
    $gkey=$data["gkey"];
    $times=$data["times"];
    $tillday=$data["tillday"];
    $add=" WHERE `type`='2' AND `preview` LIKE '%{$preview}%'";
    if($times!=""){
        $add.=" AND `times`='{$times}'";
    }
    if($gkey!=""){
        $add.=" AND binary `gkey`='{$gkey}'";
    }
    if($tillday!=""){
        $add.=" AND `tillday` LIKE '%{$tillday}%'";
    }
    $count=mysqli_query($db,"SELECT count(*) FROM `data`".$add);
    $result=mysqli_query($db,"SELECT `id`,`preview`,`times`,`tillday` FROM `data`".$add." LIMIT {$start},{$limit}");
}
$count=mysqli_fetch_row($count);
if($count!=0){
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