<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
include dirname(__FILE__) . "/../../common.php";
$r = $_REQUEST["key"];
$key = json_decode($r, true);
$key = $key["key"];
if ($key == "") {
	echo return_json(array("code" => "100", "tip" => "请输入提取码"));
	exit;
}
$my_stmt = $db->prepare("SELECT * FROM `data` WHERE binary `gkey` = ?");
$my_stmt->bind_param("s", $key);
$my_stmt->execute();
$result = $my_stmt->get_result();
$my_stmt->close();
if ($result->num_rows == 0) {
	echo return_json(array("code" => "100", "tip" => "不存在此提取码或提取码已过期"));
	exit;
} else {
	$dbinfo = $result->fetch_assoc();
	$times = $dbinfo["times"] - 1;
	$tillday = $dbinfo["tillday"];
	if ($dbinfo["type"] == 1 and $dbinfo["cloud_way"] == "") { //1-文件，2-文本
		$times = $dbinfo["times"]; //向旧版数据适配
	}
	if ($dbinfo["type"] == 1 and $dbinfo["cloud_way"] == "server") { //1-文件，2-文本
		$times = $dbinfo["times"]; //server存储，在下载页面-1
	}
	if ($times < 0) {
		echo return_json(array("code" => "100", "tip" => "不存在此提取码或提取码已过期"));
		exit;
	} else {
		if ($dbinfo["method"] == 2) {
			$rdata = file_get_contents($dbinfo["data"]);
		} else {
			if ($dbinfo["type"] == 2) {
				$rdata = $dbinfo['data'];
			} else {
				if ($dbinfo["cloud_way"] == "" or $dbinfo["cloud_way"] == "server") {
					$rdata = $domain . "public/api/download.php?key=" . $dbinfo["gkey"];
				} elseif ($dbinfo["cloud_way"] == "qiniu") {
					include dirname(__FILE__) . "/./qiniu.php";
					$baseUrl = $qiniu_domain . $dbinfo["data"];
					$rdata = $auth->privateDownloadUrl($baseUrl);
				}
			}
		}
		echo return_json(array("code" => "200", "times" => $times, "type" => $dbinfo["type"], "data" => $rdata, "origin" => $dbinfo["origin"], "tillday" => $tillday));
		if ($times > 0) {
			$my_stmt = $db->prepare("UPDATE `data` SET `times` = ? WHERE binary `gkey` = ?");
			$my_stmt->bind_param("is", $times, $key);
			$my_stmt->execute();
			$my_stmt->close();
			exit;
		} else {
			if ($dbinfo["type"] == 1 or $dbinfo["method"] == 2) {
				$now = time();
				$deletetime = date('Y-m-d H:i:s', $now + 1800);
				$my_stmt = $db->prepare("UPDATE `data` SET `tillday` = ?,`times` = ? WHERE binary `gkey` = ?");
				$my_stmt->bind_param("sis", $deletetime, $times, $key);
				$my_stmt->execute();
				$my_stmt->close();
			} elseif ($dbinfo["type"] == 2) {
				$my_stmt = $db->prepare("DELETE FROM `{$dbname}`.`data` WHERE binary `gkey` = ?");
				$my_stmt->bind_param("s", $key);
				$my_stmt->execute();
				$my_stmt->close();
			}
		}
	}
}
