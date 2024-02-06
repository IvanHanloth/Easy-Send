<?php
include dirname(__FILE__) . "/../header.php";
function get_data()
{
    global $mobile_version, $mobile_version_num, $mobile_update_description, $mobile_description, $mobile_android_url, $mobile_apple_url, $PC_version, $PC_version_num, $PC_update_description, $PC_description, $PC_windows_url, $PC_mac_url;
    return array("mobile" => array("version" => $mobile_version, "version_num" => $mobile_version_num, "update_description" => $mobile_update_description, "description" => $mobile_description, "android_url" => $mobile_android_url, "apple_url" => $mobile_apple_url), "PC" => array("version" => $PC_version, "version_num" => $PC_version_num, "update_description" => $PC_update_description, "description" => $PC_description, "windows_url" => $PC_windows_url, "mac_url" => $PC_mac_url));
}
function save_data()
{
    $data = json_decode($_POST["data"], true);
    foreach ($data as $name => $content) {
        save_setting($_POST["type"] . "_" . $name, $content);
    }
    return array("code" => 200, "tip" => '保存成功');
}
function handler()
{
    switch ($_REQUEST["action"]) {
        case "get":
            $res = get_data();
            break;
        case "save":
            $res = save_data();
            break;
        default:
            $res = array("code" => "100", "tip" => "非法访问");
            break;
    }
    echo return_json($res);
}
handler();
