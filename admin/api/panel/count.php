<?php
include dirname(__FILE__)."/../header.php";
// $data=file_get_contents("https://ivanhanloth.github.io/Easy-Send/server.json", true);
// $data=json_decode($data,true);
$file_num=count_sql("data","*","WHERE `type`=1");
$text_num=count_sql("data","*","WHERE `type`=2");
$room_num=count_sql("room","*");
$user_total=count_sql("user","*");
echo return_json(array("file_total"=>$file_num,"text_total"=>$text_num,"room_total"=>$room_num,'user_total'=>$user_total))
?>