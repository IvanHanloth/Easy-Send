<?php
include dirname(__FILE__)."/./header.php";
echo return_json(array("mobile"=>array("version"=>$mobile_version,"version_num"=>$mobile_version_num,"update_description"=>$mobile_update_description,"description"=>$mobile_description,"android_url"=>$mobile_android_url,"apple_url"=>$mobile_apple_url),"PC"=>array("version"=>$PC_version,"version_num"=>$PC_version_num,"update_description"=>$PC_update_description,"description"=>$PC_description,"windows_url"=>$PC_windows_url,"mac_url"=>$PC_mac_url)))
?>