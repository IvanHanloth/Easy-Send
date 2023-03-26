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
    $("#file-qrcode").attr("src", "/public/template/public/img/placeholder.svg");
    if($("#file_times_selector_box").attr("data-way")==2){
        $("#file_times_selector_box").removeClass("layui-hide");
    }    
    if($("#file_tillday_selector_box").attr("data-way")==2){
        $("#file_tillday_selector_box").removeClass("layui-hide");
    }
}
layui.use(function() {
    var form = layui.form,
        $ = layui.jquery,
        element = layui.element,
        upload = layui.upload,
        layer = layui.layer;
    $.getJSON("/public/api/set_info.php", function(result) { //获取文件上传大小等
        var uploadsize = result.filesize,
            cloud_way = result.cloud_way,
            limit_num_tillday=result.limit_num_tillday,
            limit_num_times=result.limit_num_times,
            limit_way_times=result.limit_way_times,
            limit_way_tillday=result.limit_way_tillday;
            $("#file_times_selector_box").attr("data-way",limit_way_times);//设置长期存储
            $("#file_tillday_selector_box").attr("data-way",limit_way_tillday);//设置长期存储
            if(limit_way_times==2){//最大值
                $("#file_times_selector_box").removeClass("layui-hide");
                $("#file_times_selector").attr("placeholder",$("#file_times_selector").attr("placeholder")+"，最大"+limit_num_times+'次');
            }
            if(limit_way_tillday==2){//最大值
                $("#file_tillday_selector_box").removeClass("layui-hide");
                $("#file_tillday_selector").attr("placeholder",$("#file_tillday_selector").attr("placeholder")+"，最长"+limit_num_times+'天');
            }
        $("#upload-size-info").html("<p>文件最大" + uploadsize / (1024 * 1024) + "MB</p>");
        if (cloud_way == "server") {
            upload.render({
                elem: '#upload',
                auto: false,
                accept: 'file',
                bindAction: '#upload-Action',
                size: uploadsize / 1024,
                data:{
                    "tillday":function(){
                        return $("#file_tillday_selector").val()
                    },
                    "times":function(){
                        return $("#file_times_selector").val()
                    }
                },
                url: '/public/api/upload_file.php',
                choose: function(obj) {
                    element.progress('progress', '0%'); //进度条复位
                    var files = this.files = obj.pushFile();
                    obj.preview(function(index, file, result) {
                        if (file.name.length > 10) {
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
                before: function(obj) {
                    if(limit_way_times==2){//最大值
                        if($("#file_times_selector").val()==""){
                            layer.msg("未填写提取次数",{icon:2,time:2000})
                            return false;
                        }
                        if($("#file_times_selector").val()>limit_num_times){
                            layer.msg("提取次数超过上限",{icon:2,time:2000})
                            return false;
                        }
                        if($("#file_times_selector").val()<1){
                            layer.msg("提取次数超过下限",{icon:2,time:2000})
                            return false;
                        }
                    }
                    if(limit_way_tillday==2){
                        if($("#file_tillday_selector").val()==""){
                            layer.msg("未填写到期时间",{icon:2,time:2000})
                            return false;
                        }
                        var tilltime=Date.parse(new Date($("#file_tillday_selector").val()));
                        tillday=tilltime/1000;
                        var nowtime=Date.parse(new Date());
                        now=nowtime/1000;
                        if(tillday<now){
                            layer.msg("到期时间超过下限",{icon:2,time:2000})
                            return false;
                        }
                        if(tillday>now+limit_num_tillday*24*60*60){
                            layer.msg("到期时间超过上限",{icon:2,time:2000})
                            return false;
                        }
                    }
                    element.progress('progress', '0%'); //进度条复位
                    layer.msg('上传中', {
                        icon: 16,
                        time: 0
                    });
                    layui.$('#upload-progress').removeClass('layui-hide');
                    $('#upload-Action').addClass('layui-hide');
                    $('#key').html('');
                },
                done: function(res, index, upload) {
                    if (res.code == 200) {
                        $('#upload').addClass('layui-hide');
                        $('#upload-Action').addClass('layui-hide');
                        $('#reload-tip').addClass('layui-hide');
                        $("#file-info").removeClass("layui-hide");
                        $("#file-qrcode").attr("src", res.qrcode);
                        $("#file-leave-times").html(res.times)
                        $("#file-leave-tillday").html(res.tillday)
                        $("#file-code").html(res.key);
                        $("#file-code").attr("data-clipboard-text",res.key);
                        $("#file_times_selector_box").addClass("layui-hide");
                        $("#file_tillday_selector_box").addClass("layui-hide");
                        layer.msg('上传完毕', {
                            icon: 1
                        });
                        return true;
                    }else{
                        layer.msg(res.tip, {
                            icon: 2
                        });
                        $('#reload-tip').removeClass('layui-hide');
                        $('#reload-tip').find('#reload').on('click', function() {
                            uploader.upload();
                        });
                        return false;
                    }
                },
                error: function() {
                    layer.msg('出现异常，请重试', {
                        icon: 2
                    });
                    $('#reload-tip').removeClass('layui-hide');
                    $('#reload-tip').find('#reload').on('click', function() {
                        uploader.upload();
                    });
                },
                progress: function(n, elem, e) {
                    element.progress('progress', n + '%'); //可配合 layui 进度条元素使用
                }
            });
        } else if (cloud_way == "qiniu") {
            import("https://cdnjs.cloudflare.com/ajax/libs/qiniu-js/3.4.1/qiniu.min.js");
            upload.render({
                elem: '#upload',
                auto: false,
                accept: 'file',
                bindAction: '#upload-Action-cheat',
                size: uploadsize / 1024,
                url: '/public/api/upload_file.php',
                choose: function(obj) {
                    element.progress('progress', '0%'); //进度条复位
                    var files = this.files = obj.pushFile();
                    obj.preview(function(index, file, result) {
                        $("#upload").attr("data-file", file.name);
                        if (file.name.length > 10) {
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
                done: function(res, index, upload) {}
            });
            $("#upload-Action").click(function() {
                $.getJSON("/public/api/qiniu.php?action=upload", function(result) {
                    var uploadname = result.rand + "_" + $("#upload").attr("data-file");
                    element.progress('progress', '0%'); //进度条复位

                    if(limit_way_times==2){//最大值
                        if($("#file_times_selector").val()==""){
                            layer.msg("未填写提取次数",{icon:2,time:2000})
                            return false;
                        }
                        if($("#file_times_selector").val()>limit_num_times){
                            layer.msg("提取次数超过上限",{icon:2,time:2000})
                            return false;
                        }
                        if($("#file_times_selector").val()<1){
                            layer.msg("提取次数超过下限",{icon:2,time:2000})
                            return false;
                        }
                    }
                    if(limit_way_tillday==2){
                        if($("#file_tillday_selector").val()==""){
                            layer.msg("未填写到期时间",{icon:2,time:2000})
                            return false;
                        }
                        var tilltime=Date.parse(new Date($("#file_tillday_selector").val()));
                        tillday=tilltime/1000;
                        var nowtime=Date.parse(new Date());
                        now=nowtime/1000;
                        if(tillday<now){
                            layer.msg("到期时间超过下限",{icon:2,time:2000})
                            return false;
                        }
                        if(tillday>now+limit_num_tillday*24*60*60){
                            layer.msg("到期时间超过上限",{icon:2,time:2000})
                            return false;
                        }
                    }
                    element.progress('progress', '0%'); //进度条复位
                    layer.msg('上传中', {
                        icon: 16,
                        time: 0
                    });
                    layui.$('#upload-progress').removeClass('layui-hide');
                    $('#upload-Action').addClass('layui-hide');
                    $('#key').html('');
                    file = $(".layui-upload-file[accept][name='file']").get(0).files[0];
                    var observable = qiniu.upload(file, uploadname, result.token, {
                        fname: uploadname,
                        customVars: {
                            'x:action': 'callback',
                            "x:tillday":$("#file_tillday_selector").val()
                            ,
                            "x:times":$("#file_times_selector").val()
                            
                        }
                    })
                    var uploadconfig = {
                        next(obj) { //过程
                            var percent = obj.total.percent + "%";
                            element.progress('progress', percent);
                        },
                        error(err) { //错误
                            layer.closeAll();
                            layer.msg('出现异常，请重试', {
                                icon: 2
                            });
                            $('#reload-tip').removeClass('layui-hide');
                            $('#reload-tip').find('#reload').on('click', function() {
                                observable.subscribe(uploadconfig);
                            });
                        },
                        complete(res) { //成功
                            layer.closeAll();
                            if (res.code == 200) {
                                $('#upload').addClass('layui-hide');
                                $('#upload-Action').addClass('layui-hide');
                                $('#reload-tip').addClass('layui-hide');
                                $("#file-info").removeClass("layui-hide");
                                $("#file-qrcode").attr("src", res.qrcode);
                                $("#file-leave-times").html(res.times)
                                $("#file-leave-tillday").html(res.tillday)
                                $("#file-code").html(res.key);
                                $("#file-code").attr("data-clipboard-text",res.key);
                                $("#file_times_selector_box").addClass("layui-hide");
                                $("#file_tillday_selector_box").addClass("layui-hide");
                                layer.msg('上传完毕', {
                                    icon: 1
                                });
                                return true;
                            }else{
                                layer.msg(res.tip, {
                                    icon: 2
                                });
                                $('#reload-tip').removeClass('layui-hide');
                                $('#reload-tip').find('#reload').on('click', function() {
                                    uploader.upload();
                                });
                                return false;
                            }
                        }
                    };
                    var subscription = observable.subscribe(uploadconfig);
                })
            })
        }
    })
})