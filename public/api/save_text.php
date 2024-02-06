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
$r = $_POST["data"];
$data = json_decode($r, true);
$user = userinfo();
if (!$user) {
	$uid = 0;
} else {
	$uid = $user["uid"];
}
//剩余时长
if ($limit_way_tillday == 1) { //固定值
	$tillday = time() + $settime * 24 * 60 * 60;
	$tilltime = date('Y-m-d H:i:s', $tillday);
} else { //自定义值,此时tillday为最大到期时间
	$tillday = time() + $limit_num_tillday * 24 * 60 * 60;
	if (strtotime($data['tillday']) <= $tillday) { //合法时间
		$tilltime = $data['tillday'];
	} else {
		echo return_json(array("code" => 0, "tip" => "到期时间超过上限"));
		exit;
	}
}
//提取次数
if ($limit_way_times == 2) { //自定义值
	if ($data['times'] <= $limit_num_times) { //合法提取次数
		$times = $data['times'];
	} else {
		echo return_json(array("code" => 0, "tip" => "提取次数超过上限"));
		exit;
	}
}
if (strlen($data['text']) > $textsize) {
	echo return_json(array("code" => 0, "tip" => "文本超过上限"));
	exit;
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
$preview = mb_substr($data["text"], 0, 10);
if (strlen($data["text"]) > 10) {
	$preview .= "…";
}
if ($textmethod == "off") {
	$my_stmt = $db->prepare("INSERT INTO `data` (`id`, `gkey`, `type`, `method`, `data`, `tillday`, `times`,`preview`,`uid`) VALUES (NULL, ?, '2','1',?, ?, ?, ?, ?)");
	$my_stmt->bind_param("sssisi", $key, $data['text'], $tilltime, $times, $preview, $uid);
	$my_stmt->execute();
	$my_stmt->close();
	echo return_json(array("code" => "200", "tip" => "文本保存成功", "key" => $key, "tillday" => $tilltime, "times" => $times, "qrcode" =>  $domain . "?key=" . $key));
	exit;
} elseif ($textmethod == "on");
$dir = $_SERVER['DOCUMENT_ROOT'] . "/upload/text/" . $date;
if (!is_dir($dir)) {
	mkdir($dir, 0777, true);
}
$file_path = $dir . random(16) . ".txt";
file_put_contents($file_path, $data['text']);
$my_stmt=$db->prepare("INSERT INTO `data` (`id`, `gkey`, `type`, `method`, `data`, `tillday`, `times`, `preview`,`uid`) VALUES (NULL, ?, '2','2',?, ?, ?, ?, ?)");
$my_stmt->bind_param("sssisi", $key, $file_path, $tilltime, $times, $preview, $uid);
$my_stmt->execute();
$my_stmt->close();
echo return_json(array("code" => "200", "tip" => "文本保存成功", "key" => $key, "tillday" => $tilltime, "times" => $times, "qrcode" => $domain . "?key=" . $key));
exit;
