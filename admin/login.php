<?php
session_start();
/*
BY Ivan Hanloth
本文件为易传后台登录页
2022/5/3
*/
require "../info.php";
if($_SESSION["admin"]==$admintoken){
    echo "<script>window.location.href='/admin/index.php'</script>";
}else{
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理-登录</title>

<link type="text/css" href="./style/login.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    
</head>
<body>

<div class="container">
  <form method="POST" action="/admin/login.php">
    <p>后台管理</p>
    <input type="text" placeholder="请输入账号" name="account"><br>
    <input type="password" placeholder="请输入密码" name="password"><br>
    <input type="submit" value="登录"><br>
  </form>

  <div class="drops">
    <div class="drop drop-1"></div>
    <div class="drop drop-2"></div>
    <div class="drop drop-3"></div>
    <div class="drop drop-4"></div>
    <div class="drop drop-5"></div>
  </div>
</div>

</body>
</html>
<?php
}
if(empty($_POST["password"])!=TRUE){
$a=$_POST["password"];
$a=base64_encode($a);
$a=md5($a);
$a=base64_encode($a);
if($_POST["account"]==$adminaccount and $a==$adminpassword){
    $_SESSION["admin"]=$admintoken;
    echo "<script>alert('登录成功！')</script>";
    echo "<script>window.location.href='/admin/index.php'</script>";
}elseif($_POST["account"]!=$adminaccount or $a!=$adminpassword){
    $_SESSION["admin"]=0;
    echo "<script>alert('账号或密码错误')</script>";
}
}?>
