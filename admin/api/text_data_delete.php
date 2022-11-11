<?php
include dirname(__FILE__)."/./header.php";
if($_REQUEST["type"]=="one"){
    $res=delete_data_by_id($_REQUEST["id"]);        
    if(!$res){
            $wrong=$_REQUEST["id"];
        }
}else{
    $data=json_decode($_REQUEST["data"],true);
    foreach ($data as $datal){
        $res=delete_data_by_id($datal["id"]);
        if(!$res){
            break;
            $wrong=$datal["id"];
        }
    }
}
if($res){
    echo return_json(array("code"=>200,"tip"=>"删除成功"));
}else{
    echo return_json(array("code"=>100,"tip"=>"删除失败,出错id".$wrong));
}
?>