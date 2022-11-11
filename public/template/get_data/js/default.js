
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/function GetContinue() {
	$("#get-input").val("");
	$("#input").removeClass("layui-hide");
	$("#result").addClass("layui-hide");
	$("#result-download-btn").addClass("layui-hide");
	$("#result-file").addClass("layui-hide");
	$("#result-info").addClass("layui-hide");
	$("#result-text").addClass("layui-hide");
}
layui.use(function () {
	var form = layui.form,
		$ = layui.jquery,
		element = layui.element,
		layer = layui.layer;
	$.getJSON("/public/api/set_info.php", function (result) { //获取文件上传大小等
		var uploadsize = result.filesize;
		/*
		获取数据
		*/
		//监听提交
		form.on('submit(getbtn)', function (data) {
			$.ajax({
				//定义提交的方式
				type: "POST",
				//定义要提交的URL
				url: '/public/api/get_data.php',
				//定义提交的数据类型
				dataType: 'json',
				async: false,
				//要传递的数据
				data: {
					'key': JSON.stringify(data.field)
				},
				//服务器处理成功后传送回来的json格式的数据
				success: function (res) {
					if(res.code == 200) { //返回存在该提取码
						$("#input").addClass("layui-hide");
						layer.msg("获取成功", {
							icon: 1
						});
						$("#result").removeClass("layui-hide");
						$("#result-info").removeClass("layui-hide");
						$("#get-leave-times").html(res.times);
						$("#get-leave-tillday").html(res.tillday);
						if(res.type == 1) { //为文件型
							$("#result-download-btn").removeClass("layui-hide");
							$("#result-file").removeClass("layui-hide");
							$("#result-url").attr("value", res.data);
							$("#result-download").attr("href", res.data);
						} else {
							if(res.type == 2) { //为文本型
								$("#result-text").removeClass("layui-hide");
								$("#result-value").val(res.data);
							}
						}
					} else { //返回不存在该提取码
						layer.msg(res.tip, {
							icon: 2
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
})
