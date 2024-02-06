<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/11/23
*/
include dirname(__FILE__) . "/../../common.php";
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$a = $_POST["password"];
$a = base64_encode($a);
$a = md5($a);
$a = base64_encode($a);
if ($_POST['type'] == "login") {
    if (preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $_POST['account']) == 0) {
        $sql = "SELECT count(*) FROM `user` WHERE `account`=?";
    } else {
        $sql = "SELECT count(*) FROM `user` WHERE `mail`=?";
    }
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $_POST['account']);
    $stmt->execute();
    $count = $stmt->get_result();
    $count = $count->fetch_row();
    $stmt->close();
    if ($count[0] != 1) {
        echo return_json(array("code" => 100, "tip" => "不存在此账户"));
        exit;
    }
    if (preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $_POST['account']) == 0) {
        $sql = "SELECT * FROM `user` WHERE `account`=? AND `password`=?";
    } else {
        $sql = "SELECT * FROM `user` WHERE `mail`=? AND `password`=?";
    }
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $_POST['account'], $a);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows != 1) {
        echo return_json(array("code" => 100, "tip" => "账号或密码错误"));
        exit;
    }
    $result = $result->fetch_assoc();
    $account = $result["account"];
    $usertoken = md5(base64_encode($account)) . md5($a);
    setcookie("usertoken", $usertoken, time() + 3600 * 24 * 30, "/");
    echo return_json(array("code" => 200, "tip" => "登录成功！欢迎" . $account . "回来"));
    exit;
} elseif ($_POST["type"] == "register") {
    $sql = "SELECT count(*) FROM `user` WHERE `mail`=? OR `account`=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $_POST['mail'], $_POST['account']);
    $stmt->execute();
    $count = $stmt->get_result();
    $count = $count->fetch_row();
    $stmt->close();
    $account = $_POST["account"];
    $usertoken = md5(base64_encode($account)) . md5($a);
    if ($count[0] == 0) {
        $sql = "INSERT INTO `user` (`account`,`password`,`mail`,`usertoken`) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssss", $_POST['account'], $a, $_POST['mail'], $usertoken);
        $query = $stmt->execute();
        $stmt->close();
        if ($query) {
            setcookie("usertoken", $usertoken, time() + 3600 * 24 * 30, "/");
            echo return_json(array("code" => 200, 'tip' => "注册成功！欢迎" . $account . "加入"));
            exit;
        } else {
            echo return_json(array("code" => 100, "tip" => "数据库出错"));
            exit;
        }
    } else {
        echo return_json(array("code" => 100, "tip" => "该账号或邮箱已被注册"));
        exit;
    }
} else {
    echo return_json(array("code" => 200, "tip" => "无此类型"));
}
