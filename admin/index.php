<?php
session_start();
require "../info.php";
if($_SESSION["admin"]!=$admintoken){
    echo "<script>window.location.href='/admin/login.php'</script>";
}else{
?>

<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>后台管理-首页</title>
        <link rel="stylesheet" type="text/css" href="./style/css/main.css">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    </head>
    <body>
        <h2 style="text-align:center">后台管理</h2>
            <div class="input-pack">
                <form method="POST">
                    <label>网站名称</label>
                    <input name="webname" type="text" placeholder="请输入网站名称" value="<?php echo $webname?>"require>
                    
                    <label>网站域名</label>
                    <input name="domain" type="url" placeholder="请输入网站域名(含http(s)://及结尾的/)" value="<?php echo $domain?>"require>
                    
                    <label>头部代码</label>
                    <input name="header" type="text" placeholder="请输入网站头部代码" value="<?php echo $header?>">
                    <label>底部代码</label>
                    <input name="footer" type="text" placeholder="请输入网站底部代码" value="<?php echo $footer?>">
                    <label>网站模板名称</label>
                    <input name="template" type="text" placeholder="请输入网站模板名称" value="<?php echo $template?>"require>
                    <label>提取次数</label>
                    <input name="times" type="number" placeholder="请输入提取码可用次数" value="<?php echo $times?>"require>
                    <label>过期时长</label>
                    <input name="settime" type="number" placeholder="请输入文件过期时长(秒)" value="<?php echo $settime?>"require>
                    
                    <label>文件限制</label>
                    <input name="uploadsize" type="number" placeholder="请输入文件上传大小限制(B)" value="<?php echo $uploadsize?>"require>
                    <label>文本限制</label>
                    <input name="textsize" type="number" placeholder="请输入文本长度限制" value="<?php echo $textsize?>"require>
                    
                    <label>存储方式</label>
                    <input name="textmethod" type="number" placeholder="请输入文本存储方式" value="<?php echo $textmethod?>"require>
                    <hr>
                    <label>管理员账号</label>
                    <input name="account" type="text" placeholder="请要修改的管理员账号" value="<?php echo $adminaccount?>"require>
                    <label>管理员密码</label>
                    <input name="password" type="text" placeholder="请输入要修改的管理员密码（无需修改请留空）">
                    <div class="button">
                    <button type="submit">保存</button></div>
                </form>
            </div>
<?php
};?><?php
require_once "../info.php";
require_once "../config.php";
if(empty($_POST["account"])==FALSE){
    $domain=$_POST["domain"];
    $webname=$_POST["webname"];
    $footer=$_POST["footer"];
    $header=$_POST["header"];
    $template=$_POST["template"];
    $times=$_POST["times"];
    $settime=$_POST["settime"];
    $uploadsize=$_POST["uploadsize"];
    $textsize=$_POST["textsize"];
    $textmethod=$_POST["textmethod"];
    $adminaccount=$_POST["account"];
    if(empty($_POST["password"])==FALSE){
        $a=$_POST["password"];
        $a=base64_encode($a);
        $a=md5($a);
        $a=base64_encode($a);
        $adminpassword=$a;
    }
    
$db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
if (mysqli_connect_errno($db)){ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
};
$sql="UPDATE `setting` SET `domain`='".$domain."',`webname`='".$webname."',`footer`='".$foote."',`header`='".$header."',`template`='".$template."',`times`='".$times."',`settime`='".$settime."',`uploadsize`='".$uploadsize."',`textsize`='".$textsize."',`textmethod`='".$textmethod."',`account`='".$adminaccount."',`password`='".$adminpassword."' WHERE `id`=1";
$query=mysqli_query($db,$sql);
if($query==TRUE){
    echo "<script>alert('保存成功！')</script>";
    echo "<script>window.location.href='/admin/login.php'</script>";
}elseif($query==FALSE){
    echo "<script>alert('保存失败！')</script>";
}}
?>