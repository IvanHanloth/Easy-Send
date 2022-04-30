/*
By Ivan Hanloth
本文件为易传函数js文件
2022/4/23
*/
//文件继续上传
function FileContinue () {
	$('#upload')
		.removeClass('layui-hide');
	$('#upload-Action')
		.removeClass('layui-hide');
	$('#reload-tip')
		.removeClass('layui-hide');
	$('#upload-info')
		.addClass('layui-hide');
	$('#upload-progress')
		.addClass('layui-hide');
	$("#local-info")
		.addClass('layui-hide');
	$('#file-info')
		.html('');
}


//文本继续上传

function TextContinue () {
	$("#text-info")
		.html('');
	$('#text')
		.removeClass('layui-hide');
	$('#text-btn')
		.removeClass('layui-hide');
	$('#text-textarea')
		.val('');
}

//继续提取
function GetContinue () {
    $("#get-input")
        .val("");
	$("#input")
		.removeClass("layui-hide");
	$("#result")
		.addClass("layui-hide");
	$("#result-download-btn")
		.addClass("layui-hide");
	$("#result-file")
		.addClass("layui-hide");
	$("#result-info")
		.html('');
	$("#result-text")
		.addClass("layui-hide");
}