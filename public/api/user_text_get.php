<?php
header("Content-type:text/json");
include dirname(__FILE__) . "/../../common.php";
$user = userinfo();
if (!$user) {
    echo return_json(array("code" => 100, 'tip' => "非法访问"));
    exit;
}
$page = $_REQUEST["page"];
$limit = $_REQUEST["limit"];
if ($page == "" or $limit == "") {
    $page = 1;
    $limit = 10;
}
$start = ($page - 1) * $limit;
$my_stmt = $db->prepare("SELECT count(*) FROM `data` WHERE `type`='2' AND `uid`=?");
$my_stmt->bind_param("i", $user['uid']);
$my_stmt->execute();
$count = $my_stmt->get_result();
$my_stmt->close();
$count = $count->fetch_row();
$count = $count[0];
$my_stmt = $db->prepare("SELECT `gkey`,`preview`,`times`,`tillday` FROM `data` WHERE `type`='2' AND `uid`=? LIMIT ?,?");
$my_stmt->bind_param("iii", $user['uid'], $start, $limit);
$my_stmt->execute();
$result = $my_stmt->get_result();
$my_stmt->close();
if ($count != 0) {
    $result = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $result = array();
}
echo return_json(array(
    "code" => 0,
    "msg" => 0,
    "count" => $count[0],
    "data" => $result
));
