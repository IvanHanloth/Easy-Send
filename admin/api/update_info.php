<?php
include dirname(__FILE__)."/./header.php";
$data=file_get_contents("https://ivanhanloth.github.io/Easy-Send/server.json", true);
$data=json_decode($data,true);
$now_version=get_setting("version");
$now_version_num=get_setting("version_num");
$need_version=array();
if($_GET["type"]=="info"){
    foreach ($data["update"] as $value) {
        if($value["version_num"]>$now_version_num){
            $need_version[]=$value;
        }
    }
    echo return_json(array("now_version"=>$now_version,"newest_version"=>$data["update"][0]["version"],"newest_version_num"=>$data["update"][0]["version_num"],"info"=>$need_version));
}elseif($_GET["type"]=="log"){
    echo return_json(array("log"=>$data["update"]));
}
?>