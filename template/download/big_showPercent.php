<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!==false){
	header('Content-type:text/html;charset=utf-8');
	include dirname(__FILE__).'/../../public/page/jump.php';
	exit;
};
include dirname(__FILE__).'/../../info.php';
$key=$_REQUEST["key"];
$dbcount=mysqli_query($db,"SELECT count(*) FROM `data` WHERE binary `gkey` = '{$key}' AND `type`=1 AND `times`>0");
$dbcount=mysqli_fetch_row($dbcount);
if($dbcount[0]==0) {
	echo "不存在此文件或文件已过期";
	exit;
} else {
	$dbinfo=mysqli_query($db,"SELECT * FROM `data` WHERE binary `gkey` = '{$key}'");
	$dbinfo=mysqli_fetch_assoc($dbinfo);
	$times=$dbinfo["times"]-1;
	$tillday=$dbinfo["tillday"];
	if($times<0) {
    	echo "不存在此文件或文件已过期";
    	exit;
	} else {
	    $url=$dbinfo["data"];
	    $name=$dbinfo["origin"];
	    if($times<=0){
	        $info='<span>剩余下载次数:</span><span style="color: #FF5722;">'.$times.'</span><br>文件将在<span style="color: #FF5722;">30分钟</span>后删除，请及时保存';
	    }else{
	        $info='<span>剩余下载次数:</span><span style="color: #FF5722;">'.$times.'</span><br><span>到期时间:</span><span style="color: #FF5722;">'.$tillday.'</span>';
	    }
		if($times>0) {
			mysqli_query($db,"UPDATE `data` SET `times` = '{$times}' WHERE binary `gkey` = '{$key}'");
		} else {
				$now=time();
				$deletetime=$now + 1800;
				mysqli_query($db,"UPDATE `data` SET `tillday` = '{$deletetime}',`times` = '{$times}' WHERE binary `gkey` = '{$key}'");
		};
	};
};
?>
<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			文件下载页面
		</title>
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="stylesheet" type="text/css" href="/public/layui/css/layui.css">
		<meta name="full-screen" content="yes">
		<!--UC强制全屏-->
		<meta name="browsermode" content="application">
		<!--UC应用模式-->
		<meta name="x5-fullscreen" content="true">
		<!--QQ强制全屏-->
		<meta name="x5-page-mode" content="app">
		<!--QQ应用模式-->
		<style>
			html,body,table{ margin:0; height:100%; text-align: center; } table{ width:100%;
			} .box{ padding:0px 5%; }
		</style>
	</head>
	<body>
		<table>
			<td>
				<div class="box">
					正在为您下载……<br>
					<?php echo $info?>
					<div class="layui-progress layui-progress-big" lay-filter="download" lay-showPercent="true">
						<div class="layui-progress-bar <?php echo $theme_config["main_css"]?>" lay-percent="0%">
						</div>
					</div>
					<div class="layui-btn-container" style="margin:5px">
						<button type="button" class="layui-btn layui-btn-sm layui-btn-radius <?php echo $theme_main_css?>"
						id="cancel">
							取消下载
						</button>
						<button type="button" class="layui-btn layui-btn-sm layui-btn-radius layui-btn-warm layui-hide"
						id="reload">
							重新下载
						</button>
					</div>
					<div id="tip" style="text-align:center;margin:5px">
					</div>
					<div id="msg" style="text-align:center;margin:5px">
					</div>
				</div>
			</td>
		</table>
		<footer>
            <script src="/public/public/js/jquery2.2.4.min.js">
            </script>
            <script src="/public/layui/layui.js">
            </script>
			<script src="/public/template/download/big_showPercent.js">
			</script>
			<script>
				download( <?php echo "'".$url."','".$name."'" ?>)
			</script>
		</footer>
	</body>

</html>
