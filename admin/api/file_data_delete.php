<?php
include dirname(__FILE__)."/./header.php";
if($_REQUEST["type"]=="one"){
    delete_data_by_id($_REQUEST["id"]);
}else{
    $data=json_decode($_REQUEST["data"],true);
    foreach ($data as $data){
        delete_data_by_id($data["id"]);
    }
}
echo return_json(array("code"=>200,"tip"=>"删除成功"))
?>