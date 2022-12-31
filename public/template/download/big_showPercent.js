/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
seconds = 10

function timer() {
    if (seconds > 0) {
        seconds--;
        $("#msg").html("页面将在<b>" + seconds + "</b>秒后自动关闭！");
    } else {
        window.opener = null;
        window.open('', '_self');
        window.close();
    }
}

function windowclose() {
    setInterval("timer()", 1000);
}

function download(url, filename) {
    layui.use(["layer", "element"], function() {
        var layer = layui.layer,
            element = layui.element;

        function tip(content) {
            $("#tip").html(content)
        }
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'blob';
        xhr.onprogress = function(oEvent) {
            if (xhr.status === 200) {
                if (oEvent.lengthComputable) {
                    var percentComplete = oEvent.loaded / oEvent.total * 100;
                    element.progress('download', Math.floor(percentComplete) + "%");
                } else {
                    element.progress('download', "100%");
                }
            } else {
                tip("下载失败");
            }
        }
        xhr.onload = function() {
            if (xhr.status === 200) {
                if (window.navigator.msSaveOrOpenBlob) {
                    navigator.msSaveBlob(xhr.response, filename);
                } else {
                    var link = document.createElement('a');
                    var body = document.querySelector('body');
                    link.href = window.URL.createObjectURL(xhr.response);
                    link.download = filename;
                    // fix Firefox 
                    link.style.display = 'none';
                    body.appendChild(link);
                    link.click();
                    body.removeChild(link);
                    window.URL.revokeObjectURL(link.href);
                };
            }
            tip("传输完成");
            windowclose()
        }
        $("#cancel").click(function() {
            xhr.abort();
            element.progress("download", "0%");
            $("#cancel").addClass("layui-hide");
            $("#reload").removeClass("layui-hide");
        })
        $("#reload").click(function() {
            window.location.reload()
        })
        xhr.onerror = function() {
            tip("下载失败");
        }
        xhr.onabort = function(evt) {
            tip("用户取消了本次下载");
        }
        xhr.open('GET', url, true);
        xhr.send();
    })
}