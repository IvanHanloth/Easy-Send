<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
require dirname(__FILE__)."/./info.php";

/*




简易简化函数区




*/

//返回json
function return_json($data){
    return json_encode($data,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_HEX_TAG | JSON_BIGINT_AS_STRING);
}
//随机数字字母混合字符串生成
function random($len, $type=""){  
    if ($type=="number") {
        $chars="1234567890";
    }elseif($type=="text"){
        $chars = "abcdefghijkmnopqrstuvxyzABCDEFGHJKLMNPQRSTUVXYZ";
    }elseif($type=="capital"){
        $chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
    }elseif($type=="lower"){
        $chars = "abcdefghijkmnopqrstuvwxyz";
    }elseif($type=="" or $type=="mix"){
        $chars = "abcdefgh12345678ijkmnopqrstuvxyzABCDEFGHJKLMNPQRSTUVXYZ9";
    }else{
        $chars = $type;
    }
    mt_srand(1900000*(double)microtime()*rand(10,300));  
    for ($i = 0, $result = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        $result .= $chars[mt_rand(0, $lc)];  
    }  
    return $result;  
}
//删除文件
function deletefile($path){
    unlink($path);
}
//解压文件
function unzip($filePath, $path) {
    if ($path=="" or $filePath=="") {
        return false;
    }
    $zip = new ZipArchive();
    if ($zip->open($filePath) === true) {
        $zip->extractTo($path);
        $zip->close();
        return true;
    } else {
        return false;
    }
}
//curl下载文件
function curl_download($url,$dir,$name){
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
    }
    $curl = curl_init();
    $timeout = 60;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $content = curl_exec($curl);
    curl_close($curl);
    $fp = @fopen($dir.$name, 'a');
    fwrite($fp, $content);
    fclose($fp);
    unset($content, $url);
}

//判断是否为手机端
function is_mobile() {
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$mobile_browser = Array(
"mqqbrowser", //手机QQ浏览器
"opera mobi", //手机opera
"juc","iuc",//uc浏览器
"fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
"iemobile", "windows ce",//windows phone
"240×320","480×640","acer","android","asus","audio","blackberry","blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo","lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony","symbian","tablet","tianyu","wap","xda","xde","zte"
);
$is_mobile = false;
foreach ($mobile_browser as $device) {
    if (stristr($user_agent, $device)) {
    $is_mobile = true;
    break;
    }
}
return $is_mobile;
}
function could_download() {
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$mobile_browser = Array(
"mqqbrowser","juc","iuc","Quark"
);
$is_mobile = false;
foreach ($mobile_browser as $device) {
    if (stristr($user_agent, $device)) {
    $is_mobile = true;
    break;
    }
}
return $is_mobile;
}
/*




后台函数区




*/
function get_setting($name){
    global $db;
    $result=mysqli_query($db,"SELECT `content` FROM `setting` WHERE `name`='{$name}'");
    if(!$result){
        return false;
    }else{
        $result=mysqli_fetch_array($result);
        return $result[0];
    }
}
function save_setting($name,$content){
    global $db;
    $result=mysqli_query($db,"UPDATE `setting` SET `content`='{$content}' WHERE `name`='{$name}'");
    return $result;
}
function get_data_by_id($id,$field){
    global $db;
    if($field!="*"){
        $field="`".$field."`";
    }
    $result=mysqli_query($db,"SELECT {$field} FROM `data` WHERE `id`='{$id}'");
    if(!$result){
        return false;
    }elseif($field="*"){
        $result=mysqli_fetch_assoc($result);
        return $result;
    }else{
        $result=mysqli_fetch_array($result);
        return $result[0];
    }
}
function save_data_by_id($id,$name,$content){
    global $db;
    $result=mysqli_query($db,"UPDATE `data` SET `{$name}`='{$content}' WHERE `id`='{$id}'");
    return $result;
}
function delete_data_by_id($id){
    global $db;
    $info=mysqli_query($db,"SELECT * FROM data` WHERE `id`='{$id}'");
    if($info["type"]==1){
        $res=unlink($info["path"]);
        if($res){
            $result=mysqli_query($db,"DELETE FROM `data` WHERE `id`='{$id}'");
        }
    }elseif($info["type"]==2){
        $res=true;
        if($info["method"]==2){
            $res=unlink($info["data"]);
        }
        if($res){
            $result=mysqli_query($db,"DELETE FROM `data` WHERE `id`='{$id}'");
        }
    }
    return $result;
}
function count_sql($table,$field='*',$add=""){
    global $db;
    if($field!="*"){
        $field="`".$field."`";
    }
    $sql="SELECT count({$field}) FROM `{$table}` ".$add;
    $result=mysqli_query($db,$sql);
    $result=mysqli_fetch_array($result);
    return $result[0];
}

/*





直传函数区





*/
function roominfo($roomtoken=""){
    global $db;
    session_start();
    if($roomtoken==""){
        $roomtoken=$_SESSION["roomtoken"];
    }
    if(empty($roomtoken)){
        return FALSE;
        }else{
        $check=mysqli_query($db,"SELECT count(*) FROM `room` WHERE binary `roomtoken` = '{$roomtoken}'");
        $check=mysqli_fetch_row($check);
        if($check[0]!=1){
            return FALSE;
        }else{
            $room=mysqli_query($db,"SELECT * FROM `room` WHERE binary `roomtoken` = '{$roomtoken}'");
            $room=mysqli_fetch_assoc($room);
            return $room;
        }
    }
}
function delete_roomdata($rid,$delete_room=false){
    global $db;
    $info=mysqli_query($db,"SELECT * FROM `room` WHERE binary `rid` = '{$rid}'");
    $info=mysqli_fetch_assoc($info);
    $result=mysqli_query($db,"SELECT * FROM `roomdata` WHERE binary `roomid`='{$info['roomid']}'");
    $num=mysqli_num_rows($result);
    if($num!=0){
        $result=mysqli_fetch_all($result,MYSQLI_BOTH);
        for($i=0;$i<=$num;$i++){
            $delete_file=unlink($result[$i]["path"]);
            if($delete_file==TRUE){
                    mysqli_query($db,"DELETE FROM `roomdata` WHERE `rdid`='{$result[$i]['rdid']}'");
            }
        }
    }
    if($delete_room){
        mysqli_query($db,"DELETE FROM `room` WHERE `rid`='{$rid}'");
    }
    return true;
}
?>