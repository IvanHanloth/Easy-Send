<?php
include dirname(__FILE__) . "/../header.php";
function get_data()
{
    global $db;
    $page = $_REQUEST["page"];
    $limit = $_REQUEST["limit"];
    if ($page == "" or $limit == "") {
        $page = 1;
        $limit = 10;
    }
    $start = ($page - 1) * $limit;
    if ($_REQUEST["action"] == "get") {
        $count = $db->query("SELECT count(*) FROM `data` WHERE `type`='1' ");
        $result = $db->query("SELECT `id`,`origin`,`times`,`tillday`,`uid` FROM `data` WHERE `type`='1' LIMIT {$start},{$limit}");
    } elseif ($_REQUEST["action"] == "search") {
        $data = json_decode($_REQUEST["data"], true);
        $origin = $data["origin"];
        $gkey = $data["gkey"];
        $times = $data["times"];
        $tillday = $data["tillday"];
        $uid = $data["uid"];
        $add = " WHERE `type`='1' AND `origin` LIKE '%{$origin}%'";
        if ($times != "") {
            $add .= " AND `times`='{$times}'";
        }
        if ($gkey != "") {
            $add .= " AND binary `gkey`='{$gkey}'";
        }
        if ($uid != "") {
            $add .= " AND binary `uid` = '{$uid}'";
        }
        if ($tillday != "") {
            $add .= " AND `tillday` LIKE '%{$tillday}%'";
        }
        $count = $db->query("SELECT count(*) FROM `data`" . $add);
        $result = $db->query("SELECT `id`,`origin`,`times`,`tillday`,`uid` FROM `data`" . $add . " LIMIT {$start},{$limit}");
    }
    $count = $count->fetch_row();
    if ($count[0] != 0) {
        $result = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $result = array();
    }
    return array(
        "code" => 0,
        "msg" => 0,
        "count" => $count[0],
        "data" => $result
    );
}
function delete_data()
{
    global $db;
    if ($_REQUEST["type"] == "one") {
        $res = delete_data_by_id($_REQUEST["id"]);
        if (!$res) {
            $wrong = $_REQUEST["id"];
        }
    } else {
        $data = json_decode($_REQUEST["data"], true);
        foreach ($data as $datal) {
            $res = delete_data_by_id($datal["id"]);
            if (!$res) {
                break;
                $wrong = $datal["id"];
            }
        }
    }
    if ($res) {
        return array("code" => 200, "tip" => "删除成功");
    } else {
        return array("code" => 100, "tip" => "删除失败,出错id" . $wrong . "，请刷新后重试");
    }
}
function edit_data()
{
    global $db;
    if ($_REQUEST["type"] == "get") {
        $data = get_data_by_id($_REQUEST["id"], "*");
        return array("origin" => $data["origin"], "tillday" => $data["tillday"], "times" => $data["times"]);
    }
    if ($_REQUEST["type"] == "save") {
        $data = json_decode($_POST["data"], true);
        foreach ($data as $name => $content) {
            if ($content != "") {
                save_data_by_id($_REQUEST["id"], $name, $content);
            }
        }
    }
    return array("code" => 200, "tip" => "保存成功");
}
function handler()
{
    switch ($_REQUEST["action"]) {
        case "get":
            $res = get_data();
            break;
        case "search":
            $res = get_data();
            break;
        case "delete":
            $res = delete_data();
            break;
        case "edit":
            $res = edit_data();
            break;
            // case "add":
            //     $res = add_data();
            //     break;
        default:
            $res = array("code" => "100", "tip" => "非法访问");
            break;
    }
    echo return_json($res);
}
handler();
