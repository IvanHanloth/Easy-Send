<?php
include dirname(__FILE__).'/../../common.php';
$key=$_GET["key"];
$dbcount=mysqli_query($db,"SELECT count(*) FROM `data` WHERE binary `gkey` = '{$key}' AND `type`=1 AND `times`>0");
$dbcount=mysqli_fetch_row($dbcount);
header("content-type:text/json");
if($dbcount[0]==0) {
	echo return_json(array("code"=>"100","tip"=>"不存在此文件或文件已过期"));
	exit;
} else {
	$dbinfo=mysqli_query($db,"SELECT * FROM `data` WHERE binary `gkey` = '{$key}'");
	$dbinfo=mysqli_fetch_assoc($dbinfo);
	$times=$dbinfo["times"]-1;
	$tillday=$dbinfo["tillday"];
	if($times<0) {
    	echo return_json(array("code"=>"100","tip"=>"不存在此文件或文件已过期"));
    	exit;
	} else {
	    $path=$dbinfo["path"];
	    $name=$dbinfo["origin"];
		if($times>0) {
			mysqli_query($db,"UPDATE `data` SET `times` = '{$times}' WHERE binary `gkey` = '{$key}'");
		} else {
				$now=time();
				$deletetime=$now + 1800;
				mysqli_query($db,"UPDATE `data` SET `tillday` = '{$deletetime}',`times` = '{$times}' WHERE binary `gkey` = '{$key}'");
		};
		//获取文件大小
		$filesize=filesize($path);
		header("content-type:easy-send/download;content-length:{$filesize}");
		echo file_get_contents($path);
	};
};?>