<?php
require "config.php";

$db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
if (mysqli_connect_errno($db)){ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
};
$result=mysqli_query($db,"SELECT * FROM `setting`");
$result=mysqli_fetch_assoc($result);
    $domain=$result["domain"];
    $webname=$result["webname"];
    $footer=$result["footer"];
    $header=$result["header"];
    $template=$result["template"];
    $times=$result["times"];
    $settime=$result["settime"];
    $uploadsize=$result["uploadsize"];
    $textsize=$result["textsize"];
    $textmethod=$result["textmethod"];
?>