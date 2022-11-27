<?php
header("Content-type:text/json");
include dirname(__FILE__)."/../../common.php";
$user=userinfo();
if(!$user){
    echo return_json(array("code"=>100,'tip'=>"非法访问"));
    exit;
}
echo return_json(array("code"=>200,"account"=>$user['account'],"mail"=>$user["mail"]));
?>