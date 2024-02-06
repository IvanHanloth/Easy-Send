<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/11/24
*/
include dirname(__FILE__) . "/../../common.php";
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$user = userinfo();
if (!$user) {
    echo return_json(array("code" => 100, "tip" => "用户未登录"));
    exit;
}
if ($user["file_num"] > 100) {
    $user["file_num"] = "99" . "+";
}
echo return_json(array(
    "code" => 200,
    "uid" => $user["uid"],
    "account" => $user["account"],
    "mail" => $user["mail"],
    "file_num" => $user["file_num"],
    "text_num" => $user["text_num"],
    "data_num" => $user["data_num"],
    "receive_num" => $user["receive_num"],
    "send_num" => $user["send_num"],
    "room_num" => $user["room_num"]
));
