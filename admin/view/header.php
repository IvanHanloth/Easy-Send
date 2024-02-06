<?php
/*
By Ivan Hanloth
本文件为用户中心框架文件
2024/1/27
*/
session_start();
include dirname(__FILE__) . "/../../common.php";
if ($_SESSION["admin"] != $admintoken) {
    echo "<script>parent.layui.admin.refreshFrame();</script><script>window.location.href='/admin/login.php'</script>";
    exit;
}
if ($admintoken == "21232f297a57a5a743894a0e4a801fc3ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ=") {
    echo "<script>window.location.href='/admin/view/account/edit.php'</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../component/pear/css/pear.css" />
    <link rel="stylesheet" href="../../component/font-awesome-4.7.0/css/font-awesome.min.css" />
    <script src="../../component/layui/layui.js"></script>
    <script src="../../component/pear/pear.js"></script>
</head>

