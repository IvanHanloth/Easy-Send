<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/11/15
*/
/*
文件上传接口
filename:文件名(可选，默认原文件名)
path:文件夹路径，以/开头，结尾没有/(可选，默认网站根目录，若relative为true则为相对路径)
relative:是否为相对路径(true/false)(可选，默认否)

*/
include dirname(__FILE__) . "/../header.php";

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$filename = $_FILES["file"]["name"];
if (isset($_POST["filename"])) {
    $filename = $_POST["filename"];
}
$dir = $_POST["path"];
if ($dir == "") {
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/";
}
if (isset($_POST["relative"])) {
    if ($_POST["relative"] == "true") {
        $dir = realpath($_SERVER['DOCUMENT_ROOT'] . $dir . "/");
    }
}
if ($_FILES["file"]["error"] > 0) {
    echo return_json(array("code" => "0", "tip" => "错误" . $_FILES["file"]["error"]));
} else {
    $mov = move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $filename);
    if ($mov) {
        echo return_json(array("code" => 200, "tip" => "上传成功"));
    } else {
        echo return_json(array("code" => 100, "tip" => "文件上传失败"));
    }
}
