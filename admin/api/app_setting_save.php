<?php
include dirname(__FILE__)."/./header.php";
$data=json_decode($_POST["data"],true);
foreach ($data as $name=>$content){
    save_setting($_POST["type"]."_".$name,$content);
}
echo return_json(array("code"=>200,"tip"=>'保存成功'))
?>