<!Doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="<?php echo $keywords?>">
    <meta name="description" content="<?php echo $description?>">
    <link rel="stylesheet" type="text/css" href="/public/layui/css/layui.css">
    <script src="/public/public/js/jquery2.2.4.min.js"></script>
    <script src="/public/layui/layui.js"></script>
    <title>Download Client For Your Device</title>
    <link rel="stylesheet" type="text/css" href="/theme/default/static/css/app.css">
</head>
<?php $mob=is_mobile() ?>
<body class="flex-center">
        <div id="welcome">
        <div class="layui-carousel" id="welcome-carousel">
            <div carousel-item>
                <div>
                    <table>
                        <td>
                            <strong>
                                <h1>Download Client For Your Device</h1>
                            </strong>
                            <br>
                            <h3>欢迎下载客户端，点击下方按钮即可选择您需要的版本</h3>
                            <?php if($mob){ echo $mobile_description ?><br><br>
                                <button type="button" class="layui-btn layui-btn-radius layui-btn-primary layui-btn-lg" id="download_android"><span class="layui-icon">&#xe684;</span>&nbsp;Android端</button><br><br>
                                <button type="button" class="layui-btn layui-btn-radius layui-btn-primary layui-btn-lg" id="download_apple">&nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-icon">&#xe680;</span>&nbsp;IOS端&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            
                            <?php }else{ echo $PC_description?>
                            <br><br>
                                <button type="button" class="layui-btn layui-btn-radius layui-btn-primary layui-btn-lg" id="download_windows"><span class="layui-icon">&#xe67f;</span>&nbsp;Windows端</button><br><br>
                                <button type="button" class="layui-btn layui-btn-radius layui-btn-primary layui-btn-lg" id="download_mac">&nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-icon">&#xe680;</span>&nbsp;Mac端&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                <?php }?>
                        </td>
                    </table>
                </div>
                
                <div>
                    <table>
                        <td>
                            <strong>
                                <h1>Thank You For Downloading</h1>
                            </strong>
                            <br>
                            <h3>感谢您的下载，下载将在几分钟内开始，如果浏览器没有自动开始，您可以手动点击下方按钮进行下载</h3><br><br>
                            <a href="" target="_blank" id="download_url">
                                <button type="button" class="layui-btn layui-btn-radius layui-btn-primary layui-btn-lg" >手动下载</button></a>
                        </td>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        layui.use(function () {

	var carousel = layui.carousel,

		layer = layui.layer,
		form = layui.form;
	carousel.render({
		elem: '#welcome-carousel',
		autoplay: false,
		arrow: 'hover',
		indicator: 'none',
		full: true,
		anim:"updown"
	});
	
    $("#download_windows").click(function(){
        download_url="<?php echo $PC_windows_url?>"
        if(download_url==""){
            layer.tips('还没有上线哦，请耐心等待', '#download_windows', {
              tips: 1
            });
        }else{
            window.open(download_url)
            $("#download_url").attr("href",download_url)
            $("[lay-type='add']").click()   
        }
    })
    $("#download_mac").click(function(){
        download_url="<?php echo $PC_mac_url?>"
        if(download_url==""){
            layer.tips('还没有上线哦，请耐心等待', '#download_mac', {
              tips: 3
            });
        }else{
            window.open(download_url)
            $("#download_url").attr("href",download_url)
            $("[lay-type='add']").click()   
        }
    })
    $("#download_android").click(function(){
        download_url="<?php echo $mobile_android_url?>"
        if(download_url==""){
            layer.tips('还没有上线哦，请耐心等待', '#download_android', {
              tips: 1
            });
        }else{
            window.open(download_url)
            $("#download_url").attr("href",download_url)
            $("[lay-type='add']").click()   
        }
    })
    $("#download_apple").click(function(){
        download_url="<?php echo $mobile_apple_url?>"
        if(download_url==""){
            layer.tips('还没有上线哦，请耐心等待', '#download_apple', {
              tips: 3
            });
        }else{
            window.open(download_url)
            $("#download_url").attr("href",download_url)
            $("[lay-type='add']").click()   
        }
    })
})
    </script>
    </body>
    </html>