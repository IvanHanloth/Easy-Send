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
	exit;
} else {
	$dbinfo=mysqli_query($db,"SELECT * FROM `data` WHERE binary `gkey` = '{$key}'");
	$dbinfo=mysqli_fetch_assoc($dbinfo);
	$times=$dbinfo["times"]-1;//一般而言，次数都要-1
	if($dbinfo["type"]==1 and $dbinfo["cloud_way"]=="") {//1-文件，2-文本
		$times=$dbinfo["times"];//向旧版数据适配
	}
	if($dbinfo["type"]==1 and $dbinfo["cloud_way"]=="server") {//1-文件，2-文本
		$times=$dbinfo["times"];//server存储，在下载页面-1
	}
	$tillday=$dbinfo["tillday"];
	if($times<0) {
		echo return_json(array("code"=>"100","tip"=>"不存在此提取码或提取码已过期"));
		exit;
	} else {
		if($dbinfo["method"]==2) {
			$rdata=file_get_contents($dbinfo["data"]);
		} else {
		    if($dbinfo["type"]==2){
		        $rdata=$dbinfo['data'];
		    }else{
    		    if($dbinfo["cloud_way"]=="" or $dbinfo["cloud_way"]=="server"){
    			    $rdata=$domain."download/?key=".$dbinfo["gkey"];
    		    }elseif($dbinfo["cloud_way"]=="qiniu"){
        		    include dirname(__FILE__)."/./qiniu.php";
                    $baseUrl = $qiniu_domain.$dbinfo["data"];
                    $rdata=$auth->privateDownloadUrl($baseUrl);
    		    }
		    }
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
			}
		}
	}
}
?>