<?php

/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/12/28
*/
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
include_once dirname(__FILE__) . "/../../common.php";
$action = $_REQUEST["action"];
require dirname(__FILE__) . '/../lib/qiniu_php/autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

$accessKey = $qiniu_Access_Key;
$secretKey = $qiniu_Secret_Key;
//初始化Auth状态
$auth = new Auth($accessKey, $secretKey);


if ($action == "upload") {
	$expires = 3600;
	$policy = null;
	$policy = array(
		'callbackUrl' => $domain . 'public/api/qiniu.php?action=callback',
		'callbackBody' => 'filename=$(key)&action=$(x:action)&times=$(x:times)&tillday=$(x:tillday)'
	);
	$upToken = $auth->uploadToken($qiniu_bucket, null, $expires, $policy, true);
	$rand = random(8);
	echo return_json(array("token" => $upToken, "rand" => $rand, "bucket" => $qiniu_bucket));
} elseif ($action == "callback") {
	$file_name = $origin_name = $_REQUEST["filename"];
	//剩余时长
	if ($limit_way_tillday == 1) { //固定值
		$tillday = time() + $settime * 24 * 60 * 60;
		$tilltime = date('Y-m-d H:i:s', $tillday);
	} else { //自定义值,此时tillday为最大到期时间
		$tillday = time() + $limit_num_tillday * 24 * 60 * 60;
		if (strtotime($_REQUEST['tillday']) <= $tillday) { //合法时间
			$tilltime = $_REQUEST['tillday'];
		} else {
			echo return_json(array("code" => 0, "tip" => "到期时间超过上限"));
			exit;
		}
	}
	//提取次数
	if ($limit_way_times == 2) { //自定义值
		if ($_REQUEST['times'] <= $limit_num_times) { //合法提取次数
			$times = $_REQUEST['times'];
		} else {
			echo return_json(array("code" => 0, "tip" => "提取次数超过上限"));
			exit;
		}
	}
	$check = array(1);
	//定义进行循环检查
	while ($check[0] >= 1) {
		//进行循环检查
		$key = random($verify_num, $verify_type);
		//获得一个key
		$my_stmt = $db->prepare("SELECT count(*) FROM `data` WHERE binary `gkey` = ?");
		$my_stmt->bind_param("s", $key);
		$my_stmt->execute();
		$check = $my_stmt->get_result();
		$check = $check->fetch_row();
		$my_stmt->close();
	};
	$my_stmt=$db->prepare("INSERT INTO `data` (`id`,`cloud_way` ,`gkey`, `type`, `data`,`origin`, `tillday`, `times` ,`uid`) VALUES (NULL, 'qiniu',?,'1',?,?,?,?,?)");
	$my_stmt->bind_param("ssssii",$key,$file_name,$origin_name,$tilltime,$times,$uid);
	$my_stmt->execute();
	$my_stmt->close();
	echo return_json(array("code" => "200", "tip" => "文件上传成功", "key" => $key, "tillday" => $tilltime, "times" => $times, "qrcode" => $domain . "?key=" . $key, "filename" => $file_name));
	exit;
} elseif ($action == "delete") {
	$config = new \Qiniu\Config();
	$bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
	$res = get_files_from_dir(dirname(__FILE__) . "/../../temp/qiniu_delete/");
	foreach ($res as $filedir) {
		$filename = basename($filedir);
		$err = $bucketManager->delete($qiniu_bucket, $filename);
		if ($err[1] != "") {
			echo return_json(array("code" => 100));
			exit;
		} else {
			unlink($filedir);
			echo return_json(array("code" => 200));
			exit;
		}
	}
}
