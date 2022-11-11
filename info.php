<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/./config.php";
$db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
if (mysqli_connect_errno($db)){ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
};
function get_request_scheme(){
    $current_page_url = 'http';
    
    if ($_SERVER["HTTPS"] == "on") {
    $current_page_url .= "s";
    }
    $current_page_url .= "://";
    return $current_page_url;
}
    $domain=$webpath=get_request_scheme().$_SERVER["HTTP_HOST"]."/";
    $webname=get_setting("webname");
    $footer=get_setting("footer");
    $head=get_setting("head");
    $logo=get_setting("logo");
    $description=get_setting("description");
    $keywords=get_setting("keywords");
    $header=get_setting("header");
    $theme=get_setting("theme");
    $announcement=get_setting("announcement");
    $times=get_setting("times");
    $qrcode=get_setting("qrcode");
    $settime=get_setting("settime");
    $uploadsize=get_setting("uploadsize");
    $textsize=get_setting("textsize");
    $textmethod=get_setting("textmethod");
    $adminaccount=get_setting("account");
    $adminpassword=get_setting("password");
    $admintoken=md5(get_setting("account")).get_setting("password");
    $mobile_version=get_setting("mobile_version");
    $mobile_version_num=get_setting("mobile_version_num");
    $mobile_android_url=get_setting("mobile_android_url");
    $mobile_apple_url=get_setting("mobile_apple_url");
    $mobile_update_description=get_setting("mobile_update_description");
    $mobile_description=get_setting("mobile_description");
    $PC_version=get_setting("PC_version");
    $PC_version_num=get_setting("PC_version_num");
    $PC_windows_url=get_setting("PC_windows_url");
    $PC_mac_url=get_setting("PC_mac_url");
    $PC_update_description=get_setting("PC_update_description");
    $PC_description=get_setting("PC_description");
    $verify_type=get_setting("verify_type");
    $verify_num=get_setting("verify_num");
?>