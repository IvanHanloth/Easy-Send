<?php
include dirname(__FILE__)."/./header.php";
$data=json_decode($_POST["data"],true);
foreach ($data as $name=>$content){
    if($content!=""){
    save_data_by_id($_REQUEST["id"],$name,$content);}
}
echo return_json(array("code"=>200,"tip"=>'保存成功'))
?>