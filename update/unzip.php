<?php
header("Content-type:text/json");
include dirname(__FILE__) . "/../common.php";
$a = true;
$b = true;
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/update/file/code.zip")) {
    chmod($_SERVER['DOCUMENT_ROOT'] . "/update/file/code.zip", 0755);
    $a = unzip($_SERVER['DOCUMENT_ROOT'] . "/update/file/code.zip", $_SERVER['DOCUMENT_ROOT'] . "/");
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/update/file/sql.zip")) {
    chmod($_SERVER['DOCUMENT_ROOT'] . "/update/file/sql.zip", 0755);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/update/update.sql")) {
        unlink($_SERVER['DOCUMENT_ROOT'] . "/update/update.sql");
    }
    $b = unzip($_SERVER['DOCUMENT_ROOT'] . "/update/file/sql.zip", $_SERVER['DOCUMENT_ROOT'] . "/update/");
}
sleep(2);
if ($a and $b) {
    echo return_json(array("code" => 200, "tip" => "解压完成"));
    exit;
}
if (!$a or !$b) {
    if (!$a) {
        $tip .= "目录文件解压失败";
    }
    if (!$b) {
        $tip .= "数据库文件解压失败";
    }
    echo return_json(array("code" => 100, "tip" => $tip));
    exit;
}
