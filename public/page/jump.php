<?php
$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($useragent, 'iphone')!==false || strpos($useragent, 'ipod')!==false){
	$alert = '<img src="//puep.qpic.cn/coral/Q3auHgzwzM4fgQ41VTF2rLrNvRzmibibqrjTFj5g2kzGyoQj3ViartAEQ/0" class="icon-safari" /> <span id="openm">Safari打开</span>';
}elseif(strpos($useragent, 'micromessenger')!==false){
	$alert = '<img src="//puep.qpic.cn/coral/Q3auHgzwzM4fgQ41VTF2rLbNVmztN9ia6GPRJ0IFicucFTr4Pp8xzibsw/0" class="icon-safari" /> <span id="openm">浏览器打开</span>';
}else{
	$alert = '<img src="//puep.qpic.cn/coral/Q3auHgzwzM4fgQ41VTF2rOCTm6gtUeQKX7m84xg47iaVosibGckrP0JQ/0" class="icon-safari" /> <span id="openm">浏览器打开</span>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>请使用浏览器下载</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta content="false" name="twcClient" id="twcClient"/>
    <meta name="aplus-touch" content="1"/>
    <style>
body,html{width:100%;height:100%}
*{margin:0;padding:0}
body{background-color:#fff}
.top-bar-guidance{font-size:15px;color:#fff;height:70%;line-height:1.8;padding-left:20px;padding-top:20px;background:url(//gw.alicdn.com/tfs/TB1eSZaNFXXXXb.XXXXXXXXXXXX-750-234.png) center top/contain no-repeat}
.top-bar-guidance .icon-safari{width:25px;height:25px;vertical-align:middle;margin:0 .2em}
.app-download-tip{margin:0 auto;width:290px;text-align:center;font-size:15px;color:#2466f4;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAcAQMAAACak0ePAAAABlBMVEUAAAAdYfh+GakkAAAAAXRSTlMAQObYZgAAAA5JREFUCNdjwA8acEkAAAy4AIE4hQq/AAAAAElFTkSuQmCC) left center/auto 15px repeat-x}
.app-download-tip .guidance-desc{background-color:#fff;padding:0 5px}
.app-download-btn{display:block;width:214px;height:40px;line-height:40px;margin:18px auto 0 auto;text-align:center;font-size:18px;color:#2466f4;border-radius:20px;border:.5px #2466f4 solid;text-decoration:none}
    </style>
</head>
<body>
<div class="top-bar-guidance">
    <p>您的浏览器不支持下载文件<br>点击右上角<?php echo $alert?></p>
    <p>可以继续下载哦~</p>
</div>
<div class="app-download-tip">
    <span class="guidance-desc">您也可以复制下载地址，到其它浏览器打开</span>
</div>
<a class="app-download-btn" id="J_BtnDowanloadApp">点此继续下载</a>
<a style="display: none;" href="" id="vurl" rel="noreferrer"></a>

<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script>
function openu(u){
document.getElementById("vurl").href= u;
document.getElementById("vurl").click();
}
var url = window.location.href;
	document.querySelector('body').addEventListener('touchmove', function (event) {
		event.preventDefault();
	});
	if(navigator.userAgent.indexOf("QQ/") > -1){
		openu("ucbrowser://"+url);
		openu("mttbrowser://url="+url);
		openu("baiduboxapp://browse?url="+url);
		openu("googlechrome://browse?url="+url);
		$("html").on("click",function(){
			openu("ucbrowser://"+url);
			openu("mttbrowser://url="+url);
			openu("baiduboxapp://browse?url="+url);
			openu("googlechrome://browse?url="+url);
		});
	}
</script>
</body>
</html>