<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__) . "/../../common.php";
session_start();
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$room = roominfo();
$time = time();
$roomid = $room["roomid"];
if ($_POST["state"] == "finish") {
    $my_stmt = $db->prepare("UPDATE `room` SET `total`=?,`origin`=?,`size`=?,`state`='sending',`starttime`=? WHERE binary `roomid`=?");
    $my_stmt->bind_param("isiis", $_POST['total'], $_POST['origin'], $_POST['size'], $time, $roomid);
    $my_stmt->execute();
    $my_stmt->close();
    //清除当前room之前的数据
    $my_stmt = $db->prepare("SELECT * FROM `roomdata` WHERE binary `roomid`=?");
    $my_stmt->bind_param("s", $roomid);
    $my_stmt->execute();
    $result = $my_stmt->get_result();
    $my_stmt->close();
    if ($result->num_rows != 0) {
        $result = $result->fetch_all(MYSQLI_BOTH);
        foreach ($result as $data) {
            $delete_file = unlink($data["path"]);
            if ($delete_file) {
                $my_stmt = $db->prepare("DELETE FROM `roomdata` WHERE `rdid`=?");
                $my_stmt->bind_param("i", $data["rdid"]);
                $my_stmt->execute();
                $my_stmt->close();
            }
        }
    }
    $my_stmt = $db->prepare("UPDATE `room` SET `state`='finish' WHERE binary `roomid`=?");
    $my_stmt->bind_param("s", $roomid);
    $my_stmt->execute();
    $my_stmt->close();
    echo return_json(array("code" => 200));
    exit;
}
if ($_SESSION["roomtype" . $room["rid"]] != "receive") {
    echo return_json(array("code" => 100, "tip" => "非法访问"));
    exit;
}
if ($room["state"] != "send-finish" and $room["state"] != "sending") {
    echo return_json(array("code" => 100, "tip" => "非法访问"));
    exit;
}
if ($room == false) {
    echo return_json(array("code" => 100, "tip" => "房间不存在"));
    exit;
}
$sql = "SELECT `rdid`,`url`,`num`,`roomid`,`size`,`origin`,`total` FROM `roomdata` WHERE binary `roomid`=?";
$my_stmt = $db->prepare($sql);
$my_stmt->bind_param("s", $roomid);
$my_stmt->execute();
$result = $my_stmt->get_result();
$my_stmt->close();
$result = $result->fetch_all(MYSQLI_ASSOC);
echo return_json($result);
?>