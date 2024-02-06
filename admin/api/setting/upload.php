<?php
include dirname(__FILE__) . "/../header.php";
function get_data()
{
    global $times, $settime, $textmethod, $uploadsize, $textsize, $limit_way_times, $limit_num_times, $limit_way_tillday, $limit_num_tillday;
    return array(
        "times"=>$times,
        "settime"=>$settime,
        "textmethod"=>$textmethod,
        "uploadsize"=>$uploadsize,
        "textsize"=>$textsize,
        "limit_way_times"=>$limit_way_times,
        "limit_num_times"=>$limit_num_times,
        "limit_way_tillday"=>$limit_way_tillday,
        "limit_num_tillday"=>$limit_num_tillday
        );
}
function save_data()
{
    $data=json_decode($_POST["data"],true);
    foreach ($data as $name=>$content){
        save_setting($name,$content);
    }
    return array("code"=>200,"tip"=>'保存成功');
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
?>