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

/**
 * 获取 blob
 * @param  {String} url 目标文件地址
 * @return {cb} 
 */
function getBlob(url,cb) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.responseType = 'blob';
        xhr.onload = function() {
                if (xhr.status === 200) {
                    cb(xhr.response);
                }
        };
        xhr.send();
}

/**
 * 保存
 * @param  {Blob} blob     
 * @param  {String} filename 想要保存的文件名称
 */
function saveAs(blob, filename) {
    if (window.navigator.msSaveOrOpenBlob) {
            navigator.msSaveBlob(blob, filename);
    } else {
            var link = document.createElement('a');
            var body = document.querySelector('body');

            link.href = window.URL.createObjectURL(blob);
            link.download = filename;

            // fix Firefox
            link.style.display = 'none';
            body.appendChild(link);
            
            link.click();
            body.removeChild(link);

            window.URL.revokeObjectURL(link.href);
    };
}

/**
 * 下载
 * @param  {String} url 目标文件地址
 * @param  {String} filename 想要保存的文件名称
 */
function download(url, filename) {
    getBlob(url, function(blob) {
        saveAs(blob, filename);
    });
    layer.closeAll()
};

function download_result(){
        if($("#result-download").attr("origin")=="" || $("#result-url").val()==""){
            layer.msg("文件下载出错",{icon: 5});
        }else{
            download($("#result-url").val(),$("#result-download").attr("origin"));
            layer.msg("正在发起下载……",{icon: 1,shade:0.3,time:3000});
        }
    }