/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
class TextUpload {
    constructor() {
        this.textsize = 0;
        this.limit_num_tillday = 0;
        this.limit_num_times = 0;
        this.limit_way_times = 0;
        this.limit_way_tillday = 0;
        this.init();
    }
    init() {
        $.getJSON("/public/api/set_info.php", (result) => { //获取文件上传大小等
            this.textsize = result.textsize,
                this.limit_num_tillday = result.limit_num_tillday,
                this.limit_num_times = result.limit_num_times,
                this.limit_way_times = result.limit_way_times,
                this.limit_way_tillday = result.limit_way_tillday;
            if (this.limit_way_times == 2) {//最大值
                $("#text_times_selector_box").removeClass("layui-hide");
                $("#text_times_selector").attr("placeholder", $("#text_times_selector").attr("placeholder") + `，最大${this.limit_num_times}次`);
            }
            if (this.limit_way_tillday == 2) {//最大值
                $("#text_tillday_selector_box").removeClass("layui-hide");
                $("#text_tillday_selector").attr("placeholder", $("#text_tillday_selector").attr("placeholder") + `，最长${this.limit_num_times}天`);
            }
        })
    }
    check() {
        layer = layui.layer;
        if (this.limit_way_times == 2) {//最大值
            if ($("#text_times_selector").val() == "") {
                layer.msg("未填写提取次数", { icon: 2, time: 2000 })
                return false;
            }
            if ($("#text_times_selector").val() > this.limit_num_times) {
                layer.msg("提取次数超过上限", { icon: 2, time: 2000 })
                return false;
            }
            if ($("#text_times_selector").val() < 1) {
                layer.msg("提取次数超过下限", { icon: 2, time: 2000 })
                return false;
            }
        }
        if (this.limit_way_tillday == 2) {
            if ($("#text_tillday_selector").val() == "") {
                layer.msg("未填写到期时间", { icon: 2, time: 2000 })
                return false;
            }
            var tilltime = Date.parse(new Date($("#text_tillday_selector").val()));
            tillday = tilltime / 1000;
            var nowtime = Date.parse(new Date());
            now = nowtime / 1000;
            if (tillday < now) {
                layer.msg("到期时间超过下限", { icon: 2, time: 2000 })
                return false;
            }
            if (tillday > now + limit_num_tillday * 24 * 60 * 60) {
                layer.msg("到期时间超过上限", { icon: 2, time: 2000 })
                return false;
            }
        }

        if (this.text == "") {
            layui.layer.msg('文本内容为空', { icon: 2, time: 2000 })
            return false;
        }
        if (this.text.length > this.textsize) {
            layui.layer.msg('文本长度超过限制', { icon: 2, time: 2000 })
            return false;
        }
    }
    reset() {
        $("#text-info").addClass("layui-hide");
        $('#text').removeClass('layui-hide');
        $('#text-btn').removeClass('layui-hide');
        $("#text-qrcode").html('');
        $('#text-textarea').val('');
        if (this.limit_way_times == 2) {
            $("#text_times_selector_box").removeClass("layui-hide");
        }
        if (this.limit_way_tillday == 2) {
            $("#text_tillday_selector_box").removeClass("layui-hide");
        }
        this.text = "";
    }
    upload(text, tillday, times) {
        this.text = text;
        this.tillday = tillday;
        this.times = times;
        if (this.check() == false) {
            return false;
        }
        layui.layer.msg('上传中', {
            icon: 16,
            time: 0
        });
        $('#text-code').html('');
        $.ajax({
            type: "POST",
            url: '/public/api/save_text.php',
            dataType: 'json',
            async: false,
            data: {
                'data': JSON.stringify({
                    'text': this.text,
                    'tillday': this.tillday,
                    'times': this.times
                })
            },
            //服务器处理成功后传送回来的json格式的数据
            success: (res)=> {
                layui.layer.closeAll();
                if (res.code == 200) {
                    this.showResult(res.qrcode, res.times, res.tillday, res.key)
                    layer.msg('上传完毕', {
                        icon: 1
                    });
                    return true;
                } else {
                    layer.msg(res.tip, {
                        icon: 2
                    });
                    return false;
                }
            },
            error:  () =>{
                layui.layer.closeAll();
                layer.msg('出现异常，请重试', {
                    icon: 2
                });
            }
        });
    }
    setValue(text){
        this.text=text;
        $("#text-textarea").val(text);
    }
    showResult(qrcode, times, tillday, key) {
        $('#text').addClass('layui-hide');
        $('#text-btn').addClass('layui-hide');
        $("#text-info").removeClass("layui-hide");
        $("#text-qrcode").qrcode({
            text:qrcode,
            width: 120,
            height: 120,
        });
        $("#text-leave-times").html(times)
        $("#text-leave-tillday").html(tillday)
        $("#text-code").html(key);
        $("#text-code").attr("data-clipboard-text", key);
        $('#text-btn').addClass('layui-hide');
        $("#text_times_selector_box").addClass("layui-hide");
        $("#text_tillday_selector_box").addClass("layui-hide");
    }

}
var textUpload = new TextUpload();
layui.use(function () {
    $("#text-continue").click(function () {
        textUpload.reset();
    })
    $("#text-upload").click(function () {
        textUpload.upload($('#text-textarea').val(), $('#text_tillday_selector').val(), $('#text_times_selector').val());
    })
});