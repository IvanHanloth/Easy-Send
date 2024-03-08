/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/

class FileUpload {
    constructor() {
        this.uploadsize = 0;
        this.cloud_way = "";
        this.limit_num_tillday = 0;
        this.limit_num_times = 0;
        this.limit_way_times = 0;
        this.limit_way_tillday = 0;
        this.file=""
        this.init();
    }
    init() {
        $.getJSON("/public/api/set_info.php", (result)=>{ //获取文件上传大小等
            this.uploadsize = result.filesize;
            this.cloud_way = result.cloud_way;
            this.limit_num_tillday = result.limit_num_tillday;
            this.limit_num_times = result.limit_num_times;
            this.limit_way_times = result.limit_way_times;
            this.limit_way_tillday = result.limit_way_tillday;
            if (this.limit_way_times == 2) {//最大值
                $("#file_times_selector_box").removeClass("layui-hide");
                $("#file_times_selector").attr("placeholder", $("#file_times_selector").attr("placeholder") + `，最大${this.limit_num_times}次`);
            }
            if (this.limit_way_tillday == 2) {//最大值
                $("#file_tillday_selector_box").removeClass("layui-hide");
                $("#file_tillday_selector").attr("placeholder", $("#file_tillday_selector").attr("placeholder") + `，最长${this.limit_num_times}天`);
            }
            $("#upload-size-info").html("<p>文件最大" + this.uploadsize / (1024 * 1024) + "MB</p>");
        })
    }
    check() {
        layer = layui.layer;
        if (this.limit_way_times == 2) {//最大值
            if ($("#file_times_selector").val() == "") {
                layer.msg("未填写提取次数", { icon: 2, time: 2000 })
                return false;
            }
            if ($("#file_times_selector").val() > this.limit_num_times) {
                layer.msg("提取次数超过上限", { icon: 2, time: 2000 })
                return false;
            }
            if ($("#file_times_selector").val() < 1) {
                layer.msg("提取次数超过下限", { icon: 2, time: 2000 })
                return false;
            }
        }
        if (this.limit_way_tillday == 2) {
            if ($("#file_tillday_selector").val() == "") {
                layer.msg("未填写到期时间", { icon: 2, time: 2000 })
                return false;
            }
            var tilltime = Date.parse(new Date($("#file_tillday_selector").val()));
            var tillday = tilltime / 1000;
            var nowtime = Date.parse(new Date());
            var now = nowtime / 1000;
            if (tillday < now) {
                layer.msg("到期时间超过下限", { icon: 2, time: 2000 })
                return false;
            }
            if (tillday > now + this.limit_num_tillday * 24 * 60 * 60) {
                layer.msg("到期时间超过上限", { icon: 2, time: 2000 })
                return false;
            }
        }
        
        if(this.file==""){
            layui.layer.msg('未选择文件', {icon: 2, time: 2000})
            return false;
        }
        if(this.file.size>this.uploadsize){
            layui.layer.msg('文件大小超过限制', {icon: 2, time: 2000})
            return false;
        }
    }
    reset() {
        layui.element.progress('file-progress', '0%'); //进度条复位
        $('#upload').removeClass('layui-hide');
        $('#upload-Action').removeClass('layui-hide');
        $('#reload-tip').addClass('layui-hide');
        $("#file-qrcode").html('');
        $('#upload-info').addClass('layui-hide');
        $('#upload-progress').addClass('layui-hide');
        $("#local-info").addClass('layui-hide');
        $('#file-info').addClass("layui-hide");
        if (this.limit_way_times == 2) {
            $("#file_times_selector_box").removeClass("layui-hide");
        }
        if (this.limit_way_tillday == 2) {
            $("#file_tillday_selector_box").removeClass("layui-hide");
        }
        this.file="";
    }
    upload() {
        if(this.check()==false){
            return false;
        }
        layui.layer.msg('上传中', {
            icon: 16,
            time: 0
        });        
        $('#upload-progress').removeClass('layui-hide');
        $('#upload-Action').addClass('layui-hide');
        $('#key').html('');
        if (this.cloud_way == "server") {
            var formdata=new FormData();
            formdata.append("tillday", $("#file_tillday_selector").val());
            formdata.append("times", $("#file_times_selector").val());
            formdata.append("file", this.file);
            $.ajax({
                url: "/public/api/upload_file.php",
                type: "post",
                data: formdata,
                contentType: false,
                processData: false,
                xhr: ()=> {
                    //获取xhr对象
                    var xhr = $.ajaxSettings.xhr();
                    //检查是否在上传文件
                    if (xhr.upload) {
                        //绑定progress事件的回调函数
                        var progressHandle = (event)=> {
                            var percent = 0;
                            //上传进度
                            if (event.lengthComputable) {
                                percent = (event.loaded / event.total * 100).toFixed(2) + "%";
                                layui.element.progress('file-progress', percent);
                            }
                        };
                        xhr.upload.addEventListener('progress', progressHandle, false);
                    }
                    //xhr对象返回给jQuery使用
                    return xhr; 
                },
                success: (res) =>{
                    if (res.code == 200) {
                        this.showResult(res.qrcode, res.times, res.tillday, res.key);
                        layui.layer.msg('上传完毕', {
                            icon: 1
                        });
                        return true;
                    } else {
                        layui.layer.msg(res.tip, {
                            icon: 2
                        });
                        $('#reload-tip').removeClass('layui-hide');
                        $('#reload-tip').find('#reload').on('click', ()=> {
                            this.upload();
                        });
                        return false;
                    }
                },
                error: ()=> {
                    layui.layer.msg('出现异常，请重试', {
                        icon: 2
                    });
                    $('#reload-tip').removeClass('layui-hide');
                    $('#reload-tip').find('#reload').on('click', ()=> {
                        this.upload();
                    });
                }
            })
        }else if(this.cloud_way =="qiniu"){
            $.getJSON("/public/api/qiniu.php?action=upload", (result)=> {
                var uploadname = result.rand + "_" + this.file.name;                    
                var observable = qiniu.upload(this.file, uploadname, result.token, {
                    fname: uploadname,
                    customVars: {
                        'x:action': 'callback',
                        "x:tillday": $("#file_tillday_selector").val(),
                        "x:times": $("#file_times_selector").val()

                    }
                })
                let trueThis = this;
                var uploadconfig = {
                    next(obj) { //过程
                        var percent = obj.total.percent + "%";
                        layui.element.progress('file-progress', percent);
                    },
                    error(err) { //错误
                        layui.layer.closeAll();
                        layui.layer.msg('出现异常，请重试', {
                            icon: 2
                        });
                        $('#reload-tip').removeClass('layui-hide');
                        $('#reload-tip').find('#reload').on('click', function () {
                            observable.subscribe(uploadconfig);
                        });
                    },
                    complete(res) { //成功
                        layui.layer.closeAll();
                        if (res.code == 200) {
                            trueThis.showResult(res.qrcode, res.times, res.tillday, res.key);
                            layer.msg('上传完毕', {
                                icon: 1
                            });
                            return true;
                        } else {
                            layui.layer.msg(res.tip, {
                                icon: 2
                            });
                            $('#reload-tip').removeClass('layui-hide');
                            $('#reload-tip').find('#reload').on('click', function () {
                                observable.subscribe(uploadconfig);
                            });
                            return false;
                        }
                    }
                };
                var subscription = observable.subscribe(uploadconfig);

            })
        }
        
    }
    choose(file) {
        this.reset();
        if(file.size>this.uploadsize){
            layui.layer.msg('文件大小超过限制', {icon: 2, time: 2000})
            return false;
        }
        var filename = file.name;
        if (filename.length > 10) {
            filename = file.name.substring(0, 10) + " ...";
        }
        $("#local-info").html('文件名称：' + filename + '&nbsp;&nbsp;文件大小：' + (file.size / 1048517).toFixed(1) + 'Mb');
        $('#upload-info').removeClass('layui-hide');
        $('#upload-progress').removeClass('layui-hide');
        $("#local-info").removeClass('layui-hide');
        this.file=file;
    }
    showResult(qrcode, times, tillday, key) {
        $('#upload').addClass('layui-hide');
        $('#upload-Action').addClass('layui-hide');
        $('#reload-tip').addClass('layui-hide');
        $("#file-info").removeClass("layui-hide");
        $("#file-qrcode").qrcode({
            text:qrcode,
            width: 120,
            height: 120,
        });
        $("#file-leave-times").html(times)
        $("#file-leave-tillday").html(tillday)
        $("#file-code").html(key);
        $("#file-code").attr("data-clipboard-text", key);
        $("#file_times_selector_box").addClass("layui-hide");
        $("#file_tillday_selector_box").addClass("layui-hide");
    }

}
var fileUpload = new FileUpload();
layui.use(()=> {
    $(".layui-upload-drag").on("dragover", function (e) {
        e.originalEvent.preventDefault();
        $(this).attr("lay-over", '')
    })
    $(".layui-upload-drag").on("dragleave", function (e) {
        e.originalEvent.preventDefault();
        $(this).removeAttr("lay-over");
    })
    $(".layui-upload-drag").on("drop", function (e) {
        e.originalEvent.preventDefault();
        $(this).removeAttr("lay-over");
        if (e.originalEvent.dataTransfer.files.length > 0) {
            fileUpload.choose(e.originalEvent.dataTransfer.files[0]);
        }
    })
    $("#upload").click(function () {
        input = document.createElement('input');
        input.type = 'file';
        input.accept = 'file';
        input.onchange = function (e) {
            fileUpload.choose(e.target.files[0]);
        }
        input.click();

    })
    $("#file-continue").click(function () {
        fileUpload.reset();
    })
    $("#upload-Action").click(function () {
        fileUpload.upload();
    })
})