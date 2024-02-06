<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
include dirname(__FILE__)."/../../common.php";
if($_SESSION["admin"]!=$admintoken){
    echo return_json(array("code"=>"100","tip"=>"非法访问"));
    exit;
}
?>