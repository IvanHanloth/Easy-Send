<?php
include dirname(__FILE__)."/./header.php";
$data=file_get_contents("https://ivanhanloth.github.io/Easy-Send/server.json", true);
$data=json_decode($data,true);
$file_num=count_sql("data","*","WHERE `type`=1");
$text_num=count_sql("data","*","WHERE `type`=2");
$room_num=count_sql("room","*");
$user_total=count_sql("user","*");
echo return_json(array("announcement"=>$data["announcement"],"file_num"=>$file_num,"text_num"=>$text_num,"room_num"=>$room_num,'user_total'=>$user_total))
?>