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

include dirname(__FILE__)."/../../common.php";
$r=$_REQUEST["key"];
$key=json_decode($r,true);
$key=$key["key"];
$dbcount=mysqli_query($db,"SELECT count(*) FROM `data` WHERE binary `gkey` = '{$key}'");
$dbcount=mysqli_fetch_row($dbcount);
if($dbcount[0]==0) {
	echo return_json(array("code"=>"100","tip"=>"不存在此提取码或提取码已过期"));
} else {
	$dbinfo=mysqli_query($db,"SELECT * FROM `data` WHERE binary `gkey` = '{$key}'");
	$dbinfo=mysqli_fetch_assoc($dbinfo);
    $times=$dbinfo["times"]-1;
	if($dbinfo["type"]==1){
    	$times=$dbinfo["times"];
	}
	$tillday=$dbinfo["tillday"];
	if($times<0) {
		echo return_json(array("code"=>"100","tip"=>"不存在此提取码或提取码已过期"));
	} else {
	    if($dbinfo["method"]==2){
	        $rdata=file_get_contents($dbinfo["data"]);
	    }else{
	        $rdata=$domain."download/?key=".$dbinfo["gkey"];
	    }
		echo return_json(array("code"=>"200","times"=>$times,"type"=>$dbinfo["type"],"data"=>$rdata,"origin"=>$dbinfo["origin"],"tillday"=>$tillday));
		if($times>0) {
			mysqli_query($db,"UPDATE `data` SET `times` = '{$times}' WHERE binary `gkey` = '{$key}'");
			exit;
		} else {
			if($dbinfo["type"]==1 or $dbinfo["method"]==2) {
				$now=time();
				$deletetime=date('Y-m-d H:i:s', $now + 1800);
				mysqli_query($db,"UPDATE `data` SET `tillday` = '{$deletetime}',`times` = '{$times}' WHERE binary `gkey` = '{$key}'");
			} elseif($dbinfo["type"]==2) {
				mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE binary `gkey` = '{$key}'");
			};
		};
	};
};
?>
