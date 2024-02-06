<?php
include dirname(__FILE__) . "/../header.php";
function info()
{

    $now_version = get_setting("version");
    $now_version_num = get_setting("version_num");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_URL, "https://ivanhanloth.github.io/Easy-Send/server.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        return array("code" => 100, "tip" => "服务器连接Github出错，可能无法在线更新", "now_version" => $now_version, "now_version_num" => $now_version_num);
    }
    curl_close($ch);
    $data = json_decode($data, true);
    $need_version = array();
    foreach ($data["update"] as $value) {
        if ($value["version_num"] > $now_version_num) {
            $need_version[] = $value;
        }
    }
    return array("code" => 200, "now_version" => $now_version, "newest_version" => $data["update"][0]["version"], "newest_version_num" => $data["update"][0]["version_num"], "info" => $need_version);
}
function updatelog()
{
    $data = file_get_contents("https://ivanhanloth.github.io/Easy-Send/server.json");
    $data = json_decode($data, true);
    return array("code" => 200, "log" => $data["update"]);
}

function evaluate()
{
    $now_version = get_setting("version");
    $now_version_num = get_setting("version_num");
    if (!class_exists("ZipArchive")) {
        return array("code" => 100, "tip" => "服务器未安装ZipArchive扩展，无法进行更新", "now_version" => $now_version, "now_version_num" => $now_version_num);
    }
    if (!extension_loaded("curl")) {
        return array("code" => 100, "tip" => "服务器未安装Curl扩展，无法在线更新，推荐使用离线更新", "now_version" => $now_version, "now_version_num" => $now_version_num);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_URL, "https://ivanhanloth.github.io/Easy-Send/server.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return array("code" => 100, "tip" => "服务器连接Github出错，无法在线更新，推荐使用离线更新", "now_version" => $now_version, "now_version_num" => $now_version_num);
    }
    curl_close($ch);
    $data = json_decode($data, true);
    return array("code" => 200, "tip" => "建议使用在线更新");
}
function online_update(){
    global $adminpassword;
    $a=$_POST["password"];
    $a=base64_encode($a);
    $a=md5($a);
    $a=base64_encode($a);
    if($a!=$adminpassword){
        return array("code"=>"100","tip"=>"密码错误");
    }
    $data=file_get_contents("https://ivanhanloth.github.io/Easy-Send/server.json", true);
    $data=json_decode($data,true);
    $sql_url="";
    $code_url="";
    if($_POST["all"]=="true"){
        $dir =$_SERVER['DOCUMENT_ROOT']."/";
        $code_url=$data["update"][0]["all_url"];
        save_setting("install",0);
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/install/install.lock")){
            unlink($_SERVER['DOCUMENT_ROOT']."/install/install.lock");
        }
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
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/update/update.lock")){
            unlink($_SERVER['DOCUMENT_ROOT']."/update/update.lock");
        }
    }
    
    if($code_url!=""){
        if(file_exists($dir."code.zip")){
            unlink($dir."code.zip");
        }
        curl_download($code_url,$dir,"code.zip");
    }
    if($sql_url!=""){
        if(file_exists($dir."sql.zip")){
            unlink($dir."sql.zip");
        }
        curl_download($sql_url,$dir,"sql.zip");
    }
    if($_POST["all"]=="true"){
        unzip($dir."code.zip",$dir);
    }
    return array("code"=>"200","tip"=>"更新准备完成！");
}
function offline_update(){
    global $adminpassword;
    $a=$_POST["password"];
    $a=base64_encode($a);
    $a=md5($a);
    $a=base64_encode($a);
    if($a!=$adminpassword){
        return array("code"=>"100","tip"=>"密码错误");
    }
    if($_POST["type"]=="重装"){
        $dir =$_SERVER['DOCUMENT_ROOT']."/";
        if(!file_exists($dir."code.zip")){
            return array("code"=>"100","tip"=>"完整包不存在");
        }
        save_setting("install",0);
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/install/install.lock")){
            unlink($_SERVER['DOCUMENT_ROOT']."/install/install.lock");
        }
        unzip($dir."code.zip",$dir);
    }else{
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/update/file/code.zip")){
            return array("code"=>"100","tip"=>"代码文件不存在");
        }if(!file_exists($_SERVER['DOCUMENT_ROOT']."/update/file/sql.zip")){
            return array("code"=>"100","tip"=>"数据库文件不存在");
        }
        save_setting("update",1);
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/update/update.lock")){
            unlink($_SERVER['DOCUMENT_ROOT']."/update/update.lock");
        }
    }
    return array("code"=>"200","tip"=>"更新准备完成！");
}
function handler()
{
    switch ($_REQUEST["action"]) {
        case "info":
            $res = info();
            break;
        case "log":
            $res = updatelog();
            break;
        case "evaluate":
            $res = evaluate();
            break;
        case "online_update":
            $res = online_update();
            break;
        case "offline_update":
            $res = offline_update();
            break;
        default:
            $res = array("code" => "100", "tip" => "非法访问");
            break;
    }
    echo return_json($res);
}
handler();
