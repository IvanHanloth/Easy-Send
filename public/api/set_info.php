<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/../../common.php";
header("Content-type:text/json");
header("Access-Control-Allow-Origin:*");
echo return_json(array("code"=>"200","filesize"=>$uploadsize,"textsize"=>$textsize,"webname"=>$webname,"header"=>0,"footer"=>0,"mobile"=>array("version"=>$mobile_version,"version_num"=>$mobile_version_num,"update_description"=>$mobile_update_description,"description"=>$mobile_description,"android_url"=>$mobile_android_url,"apple_url"=>$mobile_apple_url),"PC"=>array("version"=>$PC_version,"version_num"=>$PC_version_num,"update_description"=>$PC_update_description,"description"=>$PC_description,"windows_url"=>$PC_windows_url,"mac_url"=>$PC_mac_url)));
?>
