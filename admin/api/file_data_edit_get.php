<?php
include dirname(__FILE__)."/./header.php";
$data=get_data_by_id($_REQUEST["id"],"*");
echo return_json(array("origin"=>$data["origin"],"tillday"=>$data["tillday"],"times"=>$data["times"]))
?>