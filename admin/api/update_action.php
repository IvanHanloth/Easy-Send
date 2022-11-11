<?php
include dirname(__FILE__)."/./header.php";
$a=$_POST["password"];
$a=base64_encode($a);
$a=md5($a);
$a=base64_encode($a);
if($a!=$adminpassword){
    echo return_json(array("code"=>"100","tip"=>"密码错误"));
    exit;
}
$data=file_get_contents("https://ivanhanloth.github.io/Easy-Send/server.json", true);
$data=json_decode($data,true);
if($_POST["all"]=="true"){
    $dir =$_SERVER['DOCUMENT_ROOT']."/";
    $code_url=$data["update"][0]["all_url"];
    save_setting("install",0);
    unlink($_SERVER['DOCUMENT_ROOT']."/install/install.lock");
}else{
    $dir =$_SERVER['DOCUMENT_ROOT']."/update/file/";
    foreach ($data["update"] as $value) {
        if($value["version_num"]==$_POST["version_num"]){
            $code_url=$value["code_url"];
            $sql_url=$value["sql_url"];
            break;
        }
    }
    save_setting("update",1);
    unlink($_SERVER['DOCUMENT_ROOT']."/update/update.lock");
}

if($code_url!=""){
    curl_download($code_url,$dir,"code.zip");
}
if($sql_url!=""){
    curl_download($sql_url,$dir,"sql.zip");
}
echo return_json(array("code"=>"200","tip"=>"更新准备完成！"));
if($_POST["all"]=="true"){
    unzip($dir."code.zip",$dir);
}
?>