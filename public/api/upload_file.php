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
$date = date("Y/m/");
$dir = $_SERVER['DOCUMENT_ROOT'] . "/upload/files/" . $date;
$user = userinfo();
if (!$user) {
	$uid = 0;
} else {
	$uid = $user["uid"];
}
if (!is_dir($dir)) {
	mkdir($dir, 0777, true);
}
if ($_FILES["file"]["size"] / 1024 / 1024 > $uploadsize) {
	echo return_json(array("code" => "100", "tip" => "文件超过上限"));
	exit;
}
if ($cloud_way != "server") {
	echo return_json(array("code" => "100", "tip" => "非法操作"));
	exit;
}
if ($_FILES["file"]["error"] > 0) {
	echo return_json(array("code" => "0", "tip" => "错误" . $_FILES["file"]["error"]));
} else {
	$origin_name = $_FILES["file"]["name"];
	$file_name = random(6) . "_" . random(16) . "." . random(6);
	$mov = move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $file_name);
	if ($mov == TRUE) {
		$file_url = $domain . "upload/files/" . $date . $file_name;
		$file_path = $dir . $file_name;
		//剩余时长
		if ($limit_way_tillday == 1) { //固定值
			$tillday = time() + $settime * 24 * 60 * 60;
			$tilltime = date('Y-m-d H:i:s', $tillday);
		} else { //自定义值,此时tillday为最大到期时间
			$tillday = time() + $limit_num_tillday * 24 * 60 * 60;
			if (strtotime($_POST['tillday']) <= $tillday) { //合法时间
				$tilltime = $_POST['tillday'];
			} else {
				echo return_json(array("code" => 0, "tip" => "到期时间超过上限"));
				exit;
			}
		}
		//提取次数
		if ($limit_way_times == 2) { //自定义值
			if ($_POST['times'] <= $limit_num_times) { //合法提取次数
				$times = $_POST['times'];
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
		$my_stmt = $db->prepare("INSERT INTO `data` (`id`, `gkey`, `type`, `data`,`origin`,`path`, `tillday`, `times` ,`uid`,`cloud_way`) VALUES (NULL, ?, '1', ?,?,?, ?, ?, ?,'server')");
		$my_stmt->bind_param("sssssii", $key, $file_url, $origin_name, $file_path, $tilltime, $times, $uid);
		$my_stmt->execute();
		$my_stmt->close();
		echo return_json(array("code" => "200", "tip" => "文件上传成功", "key" => $key, "tillday" => $tilltime, "times" => $times, "qrcode" => $domain . "?key=" . $key));
		exit;
	} else {
		echo return_json(array("code" => "100", "tip" => "文件上传失败"));
		exit;
	}
}
