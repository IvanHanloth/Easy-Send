<?php

/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__) . "/../../common.php";
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$room = roominfo();
if ($room == false) {
    echo return_json(array("code" => 100, "tip" => "房间不存在"));
    exit;
}
if ($_SESSION["roomtype" . $room["rid"]] != "send") {
    echo return_json(array("code" => 100, "tip" => "非法访问"));
    exit;
}
if ($room["state"] != "connected" and $room["state"] != "sending") {
    echo return_json(array("code" => 100, "tip" => "非法访问"));
    exit;
}
$now = time();
$roomid = $room["roomid"];
$date = date("Y/m/");
$add = "upload/room/" . $roomid . "/" . $date;
$dir = $_SERVER['DOCUMENT_ROOT'] . "/" . $add;
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
if ($_REQUEST["index"] == 1) {
    $my_stmt = $db->prepare("UPDATE `room` SET `total`=?,`origin`=?,`size`=?,`state`='sending',`starttime`=? WHERE binary `roomid`=?");
    $my_stmt->bind_param("isiis", $_POST['total'], $_POST['origin'], $_POST['size'], $now, $roomid);
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
}
if ($_POST["index"] == $_POST["total"]) {
    $my_stmt = $db->prepare("UPDATE `room` SET `state`='send-finish',`send`='',`endtime`=? WHERE binary `roomid`=?");
    $my_stmt->bind_param("is", $now, $roomid);
    $my_stmt->execute();
    $my_stmt->close();
    $_SESSION["roomtype" . $room["rid"]] = "";
}
if ($_FILES["file"]["error"] > 0) {
    echo return_json(array("code" => "0", "tip" => "错误" . $_FILES["file"]["error"]));
} else {
    $file_name = random(16) . time() . "." . random(6);
    $mov = move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $file_name);
    if ($mov == TRUE) {
        $file_url = $domain . $add . $file_name;
        $file_path = $dir . $file_name;
        $my_stmt = $db->prepare("INSERT INTO `roomdata` (`roomid`,`num`,`url`,`path`,`total`,`origin`,`size`) VALUES (?,?,?,?,?,?,?)");
        $my_stmt->bind_param("sissisi", $roomid, $_POST['index'], $file_url, $file_path, $_POST['total'], $_POST['origin'], $_POST['size']);
        $my_stmt->execute();
        $my_stmt->close();
        echo return_json(array("code" => "200", "tip" => "文件直传成功"));
    } else {
        echo return_json(array("code" => "100", "tip" => "文件直传失败"));
    }
}
