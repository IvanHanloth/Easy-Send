<?php
include dirname(__FILE__)."/../header.php";

$now_version=get_setting("version");
$now_version_num=get_setting("version_num");
if(!class_exists("ZipArchive")){
    echo return_json(array("code"=>100,"tip"=>"服务器未安装ZipArchive扩展，无法在线更新","now_version"=>$now_version,"now_version_num"=>$now_version_num));
    exit();
}
if(!extension_loaded("curl")){
    echo return_json(array("code"=>100,"tip"=>"服务器未安装Curl扩展，无法在线更新","now_version"=>$now_version,"now_version_num"=>$now_version_num));
    exit();
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
curl_setopt($ch, CURLOPT_URL, "https://ivanhanloth.github.io/Easy-Send/server.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($ch);
if(curl_errno($ch)){
    echo return_json(array("code"=>100,"tip"=>"服务器连接Github出错，可能无法在线更新","now_version"=>$now_version,"now_version_num"=>$now_version_num));
    curl_close($ch);
    exit();
}
curl_close($ch);
$data=json_decode($data,true);
echo return_json(array("code"=>200,"announcement"=>$data["announcement"],"now_version"=>$now_version,"now_version_num"=>$now_version_num,"newest_version"=>$data["update"][0]["version"],"newest_version_num"=>$data["update"][0]["version_num"]));

?>