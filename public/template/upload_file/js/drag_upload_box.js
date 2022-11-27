/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
function FileContinue() {
	$('#upload').removeClass('layui-hide');
	$('#upload-Action').removeClass('layui-hide');
	$('#reload-tip').addClass('layui-hide');
	$('#upload-info').addClass('layui-hide');
	$('#upload-progress').addClass('layui-hide');
	$("#local-info").addClass('layui-hide');
	$('#file-info').addClass("layui-hide");
	$("#file-qrcode").attr("src","/public/template/public/img/placeholder.svg")
	layui.use(function () {
		uploader.reload()
	})
}
layui.use(function () {
	var form = layui.form,
		$ = layui.jquery,
		element = layui.element,
		upload = layui.upload,
		layer = layui.layer;
	$.getJSON("/public/api/set_info.php", function (result) { //获取文件上传大小等
		var uploadsize = result.filesize
		$("#upload-size-info").html("<p>文件最大" + uploadsize / (1024 * 1024) + "MB</p>");
		/*
		上传文件
		*/
		var uploader = upload.render({
			elem: '#upload',
			auto: false,
			accept: 'file',
			bindAction: '#upload-Action',
			size: uploadsize / 1024,
			url: '/public/api/upload_file.php',
			choose: function (obj) {
				element.progress('progress', '0%'); //进度条复位
				var files = this.files = obj.pushFile();
				obj.preview(function (index, file, result) {
					if(file.name.length > 10) {
						var filename = file.name.substring(0, 10) + " ...";
					} else {
						var filename = file.name;
					}
					$("#local-info").html('文件名称：' + filename + '&nbsp;&nbsp;文件大小：' + (file.size / 1048517).toFixed(1) + 'Mb');
				});
				$('#upload-info').removeClass('layui-hide');
				$('#upload-progress').removeClass('layui-hide');
				$("#local-info").removeClass('layui-hide');
			},
			before: function (obj) {
				element.progress('progress', '0%'); //进度条复位
				layer.msg('上传中', {
					icon: 16,
					time: 0
				});
				layui.$('#upload-progress').removeClass('layui-hide');
				$('#upload-Action').addClass('layui-hide');
				$('#key').html('');
			},
			done: function (res, index, upload) {
				//假设code=0代表上传成功
				if(res.code == 200) {
					$('#upload').addClass('layui-hide');
					$('#upload-Action').addClass('layui-hide');
					$('#reload-tip').addClass('layui-hide');
					$("#file-info").removeClass("layui-hide");
					$("#file-qrcode").attr("src", res.qrcode);
					$("#file-leave-times").html(res.times)
					$("#file-leave-tillday").html(res.tillday)
					$("#file-code").html(res.key);
					layer.msg('上传完毕', {
						icon: 1
					});
				}
				//上传成功的一些操作
				//…… //置空上传失败的状态
			},
			error: function () {
				layer.msg('出现异常，请重试', {
					icon: 2
				});
				$('#reload-tip').removeClass('layui-hide');
				$('#reload-tip').find('#reload').on('click', function () {
					uploader.upload();
				});
			},
			progress: function (n, elem, e) {
				element.progress('progress', n + '%'); //可配合 layui 进度条元素使用
			}
		});
	})
})
