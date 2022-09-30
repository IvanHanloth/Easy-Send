<?php
include dirname(__FILE__)."/./header.php";
$data=get_data_by_id($_REQUEST["id"],"*");
$content=$data["data"];
if($data["method"]==2){
    $content=file_get_contents($content);
}
echo return_json(array("data"=>$content,"tillday"=>$data["tillday"],"times"=>$data["times"]))
?>