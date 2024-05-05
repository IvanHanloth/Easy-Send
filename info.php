<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2024/2/6
*/
error_reporting(0);
include dirname(__FILE__)."/./config.php";
// 检查连接配置是否有效
if (empty($dbconfig['host']) || empty($dbconfig['account']) || empty($dbconfig['password']) || empty($dbconfig['name']) || empty($dbconfig['port'])) {
    $db=false;
}else{
    $db = new mysqli($dbconfig['host'], $dbconfig['account'], $dbconfig['password'], $dbconfig['name'], $dbconfig['port']);
    if ($db->connect_error) {
        $db=false;
    }
}

    $current_page_url = 'http';
    if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on") {
        $current_page_url .= "s";
    }
    $current_page_url .= "://";
    $domain=$webpath=$current_page_url.$_SERVER["HTTP_HOST"]."/";
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
    $if_scan=get_setting("if_scan");
    $if_gray=get_setting("if_gray");
    $cloud_way=get_setting("cloud_way");
    $qiniu_Access_Key=get_setting("qiniu_Access_Key");
    $qiniu_Secret_Key=get_setting("qiniu_Secret_Key");
    $qiniu_bucket=get_setting("qiniu_bucket");
    $qiniu_domain=get_setting("qiniu_domain");
    $limit_way_times=get_setting("limit_way_times");
    $limit_num_times=get_setting("limit_num_times");
    $limit_way_tillday=get_setting("limit_way_tillday");
    $limit_num_tillday=get_setting("limit_num_tillday");
    $whole_upload=get_setting("whole_upload");
?>
