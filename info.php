<?php
require "config.php";
//获取协议头
function get_request_scheme(){
$current_page_url = 'http';

if ($_SERVER["HTTPS"] == "on") {
$current_page_url .= "s";
}
$current_page_url .= "://";
return $current_page_url;
}
$db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
if (mysqli_connect_errno($db)){ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
};
$result=mysqli_query($db,"SELECT * FROM `setting`");
$result=mysqli_fetch_assoc($result);
    $domain=$webpath=get_request_scheme().$_SERVER["HTTP_HOST"]."/";
    $webname=$result["webname"];
    $footer=$result["footer"];
    $header=$result["header"];
    $template=$result["template"];
    $times=$result["times"];
    $settime=$result["settime"];
    $uploadsize=$result["uploadsize"];
    $textsize=$result["textsize"];
    $textmethod=$result["textmethod"];
    $adminaccount=$result["account"];
    $adminpassword=$result["password"];
    $admintoken=md5($result["account"]).$result["password"];
?>