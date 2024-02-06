<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
require dirname(__FILE__) . "/./info.php";

/*




简易简化函数区




*/

//返回json
function return_json($data)
{
    return json_encode($data,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_HEX_TAG | JSON_BIGINT_AS_STRING);
}
//随机数字字母混合字符串生成
function random($len, $type = "")
{
    if ($type == "number") {
        $chars = "1234567890";
    } elseif ($type == "text") {
        $chars = "abcdefghijkmnopqrstuvxyzABCDEFGHJKLMNPQRSTUVXYZ";
    } elseif ($type == "capital") {
        $chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
    } elseif ($type == "lower") {
        $chars = "abcdefghijkmnopqrstuvwxyz";
    } elseif ($type == "" or $type == "mix") {
        $chars = "abcdefgh12345678ijkmnopqrstuvxyzABCDEFGHJKLMNPQRSTUVXYZ9";
    } else {
        $chars = $type;
    }
    mt_srand(1900000 * (float)microtime() * rand(10, 300));
    for ($i = 0, $result = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
        $result .= $chars[mt_rand(0, $lc)];
    }
    return $result;
}
//删除文件
function deletefile($path)
{
    unlink($path);
}
//解压文件
function unzip($filePath, $path)
{
    if ($path == "" or $filePath == "") {
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
function curl_download($url, $dir, $name)
{
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    $curl = curl_init();
    $timeout = 60;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $content = curl_exec($curl);
    curl_close($curl);
    $fp = @fopen($dir . $name, 'a');
    fwrite($fp, $content);
    fclose($fp);
    unset($content, $url);
}

//判断是否为手机端
function is_mobile()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $mobile_browser = array(
        "mqqbrowser", //手机QQ浏览器
        "opera mobi", //手机opera
        "juc", "iuc", //uc浏览器
        "fennec", "ios", "applewebKit/420", "applewebkit/525", "applewebkit/532", "ipad", "iphone", "ipaq", "ipod",
        "iemobile", "windows ce", //windows phone
        "240×320", "480×640", "acer", "android", "asus", "audio", "blackberry", "blazer", "coolpad", "dopod", "etouch", "hitachi", "htc", "huawei", "jbrowser", "lenovo", "lg", "lg-", "lge-", "lge", "mobi", "moto", "nokia", "phone", "samsung", "sony", "symbian", "tablet", "tianyu", "wap", "xda", "xde", "zte"
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

//获取指定目录下所有文件，返回包含由directory组成的完整文件路径数组，目录以/结尾
function get_files_from_dir($directory)
{
    if (is_dir($directory)) {
        $files = scandir($directory);
        $res = array();
        foreach ($files as $filename) {
            if ($filename != '.' && $filename != '..') { // 一定要排除两个特殊的目录
                $subFile = $directory . $filename; //将目录下的文件与当前目录相连
                if (is_file($subFile)) { // 如果是文件条件则成立
                    array_push($res, $subFile);
                }
            }
        }
    } else {
        $res = false;
    }
    return $res;
}


/*




后台函数区




*/
//获取指定设置项
function get_setting($name)
{
    global $db;
    if(!$db){
        return false;
    }
    $db_stmt = $db->prepare("SELECT `content` FROM `setting` WHERE `name`=?");
    $db_stmt->bind_param("s", $name);
    $db_stmt->execute();
    $db_stmt->bind_result($content); //绑定结果
    $db_stmt->fetch(); //获取结果
    $db_stmt->close();
    return $content;
}

//保存指定设置项
function save_setting($name, $content)
{
    global $db;
    $db_stmt = $db->prepare("UPDATE `setting` SET `content`=? WHERE `name`=?");
    $db_stmt->bind_param("ss", $content, $name);
    $result = $db_stmt->execute();
    $db_stmt->close();

    return $result;
}

//通过id获取data详细信息
function get_data_by_id($id, $field)
{
    global $db;
    $SQL = "SELECT * FROM `data` WHERE `id`=?";
    $my_stmt = $db->prepare($SQL);
    $my_stmt->bind_param("i", $id);
    $my_stmt->execute();
    $result = $my_stmt->get_result();
    $result = $result->fetch_assoc();
    $my_stmt->close();
    if ($field == "*") {
        return $result;
    } else {
        return $result[$field];
    }
}

//通过id保存data
function save_data_by_id($id, $name, $content)
{
    global $db;
    $my_stmt = $db->prepare("UPDATE `data` SET `{$name}`=? WHERE `id`=?");
    $my_stmt->bind_param("si", $content, $id);
    $result = $my_stmt->execute();
    $my_stmt->close();
    return $result;
}

//通过id删除Data
function delete_data_by_id($id)
{
    global $db, $domain;
    $my_stmt = $db->prepare("SELECT * FROM `data` WHERE `id`=?");
    $my_stmt->bind_param("i", $id);
    $my_stmt->execute();
    $info = $my_stmt->get_result();
    $info = $info->fetch_assoc();
    $my_stmt->close();
    $result = false;
    if ($info["type"] == 1) {
        if ($info["cloud_way"] == "" or $info["cloud_way"] == "server") {
            try {
                $res = unlink($info["path"]);
                if ($res) {
                    $my_stmt = $db->prepare("DELETE FROM `data` WHERE `id`=?");
                    $my_stmt->bind_param("i", $id);
                    $result = $my_stmt->execute();
                    $my_stmt->close();
                }
            } catch (Exception $e) {
                $result = false;
            }
        } elseif ($info['cloud_way'] == "qiniu") {
            $dir = dirname(__FILE__) . "/./temp/qiniu_delete/";
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            file_put_contents($dir . $info['data'], $info['data']);
            $query = file_get_contents($domain . "public/api/qiniu.php?action=delete");
            $query = json_decode($query, true);
            if ($query["code"] == 200) {
                $my_stmt = $db->prepare("DELETE FROM `data` WHERE `id`=?");
                $my_stmt->bind_param("i", $id);
                $result = $my_stmt->execute();
                $my_stmt->close();
            }
        }
    } elseif ($info["type"] == 2) {
        $res = true;
        if ($info["method"] == 2) {
            $res = unlink($info["data"]);
        }
        if ($res) {
            $my_stmt = $db->prepare("DELETE FROM `data` WHERE `id`=?");
            $my_stmt->bind_param("i", $id);
            $result = $my_stmt->execute();
            $my_stmt->close();
        }
    }
    return $result;
}

//数据库计数，第二个参数为需要指定的列，第三个参数为附加在查询指令最后的筛选条件
//不是数据库安全的
function count_sql($table, $field = '*', $add = "")
{
    global $db;
    if ($field != "*") {
        $field = "`" . $field . "`";
    }
    $sql = "SELECT count({$field}) FROM `{$table}` " . $add;
    $result=$db->query($sql);
    $result=$result->fetch_row();
    return $result[0];
}

/*





直传函数区





*/
//获取room所有信息
function roominfo($roomtoken = "")
{
    global $db;
    session_start();
    if ($roomtoken == "") {
        $roomtoken = $_SESSION["roomtoken"];
    }
    if (empty($roomtoken)) {
        return FALSE;
    } else {
        $my_stmt = $db->prepare("SELECT count(*) FROM `room` WHERE binary `roomtoken` = ?");
        $my_stmt->bind_param("s", $roomtoken);
        $my_stmt->execute();
        $result = $my_stmt->get_result();
        $result = $result->fetch_row();
        $my_stmt->close();
        if ($result[0] != 1) {
            return FALSE;
        } else {
            $my_stmt = $db->prepare("SELECT * FROM `room` WHERE binary `roomtoken` = ?");
            $my_stmt->bind_param("s", $roomtoken);
            $my_stmt->execute();
            $result = $my_stmt->get_result();
            $result = $result->fetch_assoc();
            $my_stmt->close();
            return $result;
        }
    }
}
//根据rid删除roomdata
function delete_roomdata($rid, $delete_room = false)
{
    global $db;
    $my_stmt = $db->prepare("SELECT * FROM `room` WHERE binary `rid` = ?");
    $my_stmt->bind_param("i", $rid);
    $my_stmt->execute();
    $info = $my_stmt->get_result();
    $info = $info->fetch_assoc();
    $my_stmt->close();
    $my_stmt = $db->prepare("SELECT * FROM `roomdata` WHERE binary `roomid`=?");
    $my_stmt->bind_param("i", $info['roomid']);
    $my_stmt->execute();
    $result = $my_stmt->get_result();
    $num = $result->num_rows;
    if ($num == 0) {
        return true;
    }
    $result = $result->fetch_all(MYSQLI_BOTH);
    $my_stmt->close();
    for ($i = 0; $i <= $num; $i++) {
        $delete_file = unlink($result[$i]["path"]);
        if ($delete_file == TRUE) {
            $my_stmt = $db->prepare("DELETE FROM `roomdata` WHERE `rdid`=?");
            $my_stmt->bind_param("i", $result[$i]['rdid']);
            $my_stmt->execute();
            $my_stmt->close();
        }
    }
    if ($delete_room) {
        $my_stmt = $db->prepare("DELETE FROM `room` WHERE `rid`=?");
        $my_stmt->bind_param("i", $rid);
        $my_stmt->execute();
        $my_stmt->close();
    }
    return true;
}
/*





用户函数区





*/
//获取用户信息
function userinfo($usertoken = "")
{
    global $db;
    if ($usertoken == "") {
        $usertoken = $_COOKIE["usertoken"];
    }
    if (empty($usertoken)) {
        return FALSE;
    } else {
        $my_stmt = $db->prepare("SELECT * FROM `user` WHERE binary `usertoken` = ?");
        $my_stmt->bind_param("s", $usertoken);
        $my_stmt->execute();
        $result = $my_stmt->get_result();
        $num=$result->num_rows;
        $user = $result->fetch_assoc();
        $my_stmt->close();
        if ($num!=1) {
            return FALSE;
        } else {
            $uid=$user['uid'];
            $my_stmt = $db->prepare("SELECT count(*) FROM `data` WHERE binary `uid` = ? AND `type`='1'");
            $my_stmt->bind_param("i", $uid);
            $my_stmt->execute();
            $result = $my_stmt->get_result();
            $file_num = $result->fetch_row();
            $user['file_num'] = $file_num[0];
            $my_stmt->close();
            $my_stmt = $db->prepare("SELECT count(*) FROM `data` WHERE binary `uid` = ? AND `type`='2'");
            $my_stmt->bind_param("i", $uid);
            $my_stmt->execute();
            $result = $my_stmt->get_result();
            $text_num = $result->fetch_row();
            $user['text_num'] = $text_num[0];
            $my_stmt->close();
            $data_num = $text_num[0] + $file_num[0];
            $user['data_num'] = $data_num;
            $my_stmt = $db->prepare("SELECT count(*) FROM `room` WHERE binary `receiveuid` = ?");
            $my_stmt->bind_param("i", $uid);
            $my_stmt->execute();
            $result = $my_stmt->get_result();
            $receive_num = $result->fetch_row();
            $user['receive_num'] = $receive_num[0];
            $my_stmt->close();
            $my_stmt = $db->prepare("SELECT count(*) FROM `room` WHERE binary `senduid` = ?");
            $my_stmt->bind_param("i", $uid);
            $my_stmt->execute();
            $result = $my_stmt->get_result();
            $send_num = $result->fetch_row();
            $user['send_num'] = $send_num[0];
            $my_stmt->close();
            $room_num = $receive_num[0] + $send_num[0];
            $user['room_num'] = $room_num;
            return $user;
        }
    }
}
