<?php
/*
By Ivan Hanloth
本文件为用户中心框架文件
2022/7/31
*/
session_start();
include dirname(__FILE__)."/../../common.php";
if($_SESSION["admin"]!=$admintoken){
    echo "<script>window.location.href='/admin/page/login.php'</script>";
    exit;
}
if($admintoken=="21232f297a57a5a743894a0e4a801fc3ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ="){
    echo "<script>window.location.href='/admin/page/admin_edit.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $webname?> - 后台管理</title>    
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="../../public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="../lib/layui-v2.6.3/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">    
    <link rel="stylesheet" href="../lib/jq-module/zyupload/zyupload-1.0.0.min.css" media="all">
    <script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script src="../lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
</head>