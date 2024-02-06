<?php
include dirname(__FILE__) . "/../header.php";
function get_data()
{
    global $webname, $theme, $header, $logo, $footer, $head, $keywords, $description,  $announcement, $verify_num, $verify_type, $if_scan, $if_gray,$whole_upload;
    return array(
        "webname"=>$webname,
    "theme"=>$theme,
    "header"=>$header,
    "logo"=>$logo,
    "footer"=>$footer,
    "head"=>$head,
    "keywords"=>$keywords,
    "description"=>$description,
    "announcement"=>$announcement,
    "verify_num"=>$verify_num,
    "verify_type"=>$verify_type,
    "if_scan"=>$if_scan,
    "if_gray"=>$if_gray,
    'whole_upload'=>$whole_upload
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