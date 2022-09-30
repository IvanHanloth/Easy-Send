function TextContinue() {
	$("#text-info").addClass("layui-hide");
	$('#text').removeClass('layui-hide');
	$('#text-btn').removeClass('layui-hide');
	$("#text-qrcode").attr("src","/public/template/public/img/placeholder.svg")
	$('#text-textarea').val('');
}
layui.use(function () {
	var form = layui.form,
		$ = layui.jquery,
		element = layui.element,
		upload = layui.upload,
		layer = layui.layer;
	$.getJSON("/public/api/set_info.php", function (result) { //获取文件上传大小等
		var textsize = result.textsize
		/*
		保存文本
		*/
		form.verify({
			text: function (value) {
				if(value.length > textsize) {
					return '文本不能超过' + textsize + '字符';
				}
			}
		});
		//监听提交
		form.on('submit(save)', function (data) {
			$.ajax({
				//定义提交的方式
				type: "POST",
				//定义要提交的URL
				url: '/public/api/save_text.php',
				//定义提交的数据类型
				dataType: 'json',
				async: false,
				//要传递的数据
				data: {
					'data': JSON.stringify(data.field)
				},
				//服务器处理成功后传送回来的json格式的数据
				success: function (res) {
					if(res.code == 200) {
						$('#text').addClass('layui-hide');
						$('#text-btn').addClass('layui-hide');
						$("#text-info").removeClass("layui-hide");
						$("#text-qrcode").attr("src", res.qrcode);
						$("#text-leave-times").html(res.times)
						$("#text-leave-tillday").html(res.tillday)
						$("#text-code").html(res.key);
						$('#text-btn').addClass('layui-hide');
						layer.msg('上传完毕', {
							icon: 1
						});
					}
				},
				error: function () {
					layer.msg('出现异常，请重试', {
						icon: 2
					});
				}
			});
			return false;
		});
	});
});
