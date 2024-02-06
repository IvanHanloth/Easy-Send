<?php
session_start();
include dirname(__FILE__) . "/../common.php";
if ($_SESSION["admin"] == $admintoken) {
	echo "<script>window.location.href='/admin'</script>";
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>登录</title>
	<link rel="stylesheet" href="./component/pear/css/pear.css" />
	<link rel="stylesheet" href="./admin/css/other/login.css" />
	<link rel="stylesheet" href="./admin/css/variables.css" />
	<script>
		if (window.self != window.top) {
			top.location.reload();
		}
	</script>
</head>

<body>
	<div class="login-page" style="background-image: url(./admin/images/background.svg)">
		<div class="layui-row">
			<div class="layui-col-sm6 login-bg layui-hide-xs">
				<img class="login-bg-img" src="./admin/images/banner.png" alt="" />
			</div>
			<div class="layui-col-sm6 layui-col-xs12 login-form">
				<div class="layui-form">
					<div class="form-center">
						<div class="form-center-box">
							<div class="top-log-title">
								<img class="top-log" src="/favicon.ico" alt="" />
								<span>后台管理</span>
							</div>
							<div class="top-desc">
								简单易用的跨平台文件文本传输平台
							</div>
							<div style="margin-top: 30px;">
								<div class="layui-form-item">
									<div class="layui-input-wrap">
										<div class="layui-input-prefix">
											<i class="layui-icon layui-icon-username"></i>
										</div>
										<input lay-verify="required" placeholder="账户" autocomplete="off" class="layui-input" name="account">
									</div>
								</div>
								<div class="layui-form-item">
									<div class="layui-input-wrap">
										<div class="layui-input-prefix">
											<i class="layui-icon layui-icon-password"></i>
										</div>
										<input type="password" name="password" value="" lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input" lay-affix="eye">
									</div>
								</div>
								<div class="tab-log-verification">
									<div class="verification-text">
										<div class="layui-input-wrap">
											<div class="layui-input-prefix">
												<i class="layui-icon layui-icon-auz"></i>
											</div>
											<input lay-verify="required" placeholder="验证码" autocomplete="off" class="layui-input" name="captcha" id="captcha-input">
										</div>
									</div>
									<img src="/admin/api/account/captcha.php" alt="点击切换" class="verification-img" id="captcha" />
								</div>
								<br>
								<div class="login-btn">
									<button type="button" lay-submit lay-filter="login" class="layui-btn login">登 录</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 资 源 引 入 -->
	<script src="./component/layui/layui.js"></script>
	<script src="./component/pear/pear.js"></script>
	<script>
		layui.use(['form', 'button', 'popup', 'jquery'], function() {
			var form = layui.form;
			var button = layui.button;
			var popup = layui.popup;
			var $ = layui.jquery;

			// 登 录 提 交
			form.on('submit(login)', function(data) {
				var buttonload="";
				$.ajax({
					url: "/admin/api/account/login.php",
					type: "POST",
					data: data.field,
					beforeSend: function() {
						buttonload=button.load({
							elem: '.login'
						})
					},
					success: function(res) {
						buttonload.stop();
						if (res.code == 200) {
							popup.success(res.tip, function() {
								location.href = "/admin";
							})
						} else {
							$("#captcha-input").val("");
							$("#captcha").attr("src", "/admin/api/account/captcha.php?" + Math.random());
							popup.failure(res.tip);
						}
					},
					error: function() {
						buttonload.stop();
						popup.failure("网络错误");
					}
				})

				return false;
			});
			$("#captcha").click(function() {
				$(this).attr("src", "/admin/api/account/captcha.php?" + Math.random());
			})
		})
	</script>
</body>

</html>