<?php
include dirname(__FILE__) . "/../header.php";
function get_data()
{
    global $cloud_way, $qiniu_Access_Key, $qiniu_Secret_Key, $qiniu_bucket, $qiniu_domain;
    return array("cloud_way"=>$cloud_way,"qiniu_Access_Key"=>$qiniu_Access_Key,"qiniu_Secret_Key"=>$qiniu_Secret_Key,"qiniu_bucket"=>$qiniu_bucket,"qiniu_domain"=>$qiniu_domain);
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