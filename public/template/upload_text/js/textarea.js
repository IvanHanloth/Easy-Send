/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
function TextContinue() {
    $("#text-info").addClass("layui-hide");
    $('#text').removeClass('layui-hide');
    $('#text-btn').removeClass('layui-hide');
    $("#text-qrcode").attr("src", "/public/template/public/img/placeholder.svg")
    $('#text-textarea').val('');
    if($("#text_times_selector_box").attr("data-way")==2){
        $("#text_times_selector_box").removeClass("layui-hide");
    }    
    if($("#text_tillday_selector_box").attr("data-way")==2){
        $("#text_tillday_selector_box").removeClass("layui-hide");
    }
}
layui.use(function() {
    var form = layui.form,
        $ = layui.jquery,
        element = layui.element,
        upload = layui.upload,
        layer = layui.layer;
    $.getJSON("/public/api/set_info.php", function(result) {
        var textsize = result.textsize,
            limit_num_tillday=result.limit_num_tillday,
            limit_num_times=result.limit_num_times,
            limit_way_times=result.limit_way_times,
            limit_way_tillday=result.limit_way_tillday;
            $("#text_times_selector_box").attr("data-way",limit_way_times);//设置长期存储
            $("#text_tillday_selector_box").attr("data-way",limit_way_tillday);//设置长期存储
            if(limit_way_times==2){//最大值
                $("#text_times_selector_box").removeClass("layui-hide");
                $("#text_times_selector").attr("placeholder",$("#text_times_selector").attr("placeholder")+"，最大"+limit_num_times+'次');
            }
            if(limit_way_tillday==2){//最大值
                $("#text_tillday_selector_box").removeClass("layui-hide");
                $("#text_tillday_selector").attr("placeholder",$("#text_tillday_selector").attr("placeholder")+"，最长"+limit_num_times+'天');
            }
        /*
        保存文本
        */
        form.verify({
            text: function(value) {
                if (value.length > textsize) {
                    return '文本不能超过' + textsize + '字符';
                }
            }
        });
        //监听提交
        form.on('submit(save)', function(data) {
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
                beforeSend: function(XMLHttpRequest) {
                    if(limit_way_times==2){//最大值
                        if($("#text_times_selector").val()==""){
                            layer.msg("未填写提取次数",{icon:2,time:2000})
                            return false;
                        }
                        if($("#text_times_selector").val()>limit_num_times){
                            layer.msg("提取次数超过上限",{icon:2,time:2000})
                            return false;
                        }
                        if($("#text_times_selector").val()<1){
                            layer.msg("提取次数超过下限",{icon:2,time:2000})
                            return false;
                        }
                    }
                    if(limit_way_tillday==2){
                        if($("#text_tillday_selector").val()==""){
                            layer.msg("未填写到期时间",{icon:2,time:2000})
                            return false;
                        }
                        var tilltime=Date.parse(new Date($("#text_tillday_selector").val()));
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
                    return true;
                },
                //服务器处理成功后传送回来的json格式的数据
                success: function(res) {
                    if (res.code == 200) {
                        $('#text').addClass('layui-hide');
                        $('#text-btn').addClass('layui-hide');
                        $("#text-info").removeClass("layui-hide");
                        $("#text-qrcode").attr("src", res.qrcode);
                        $("#text-leave-times").html(res.times)
                        $("#text-leave-tillday").html(res.tillday)
                        $("#text-code").html(res.key);
                        $("#text-code").attr("data-clipboard-text",res.key);
                        $('#text-btn').addClass('layui-hide');
                        $("#text_times_selector_box").addClass("layui-hide");
                        $("#text_tillday_selector_box").addClass("layui-hide");
                        layer.msg('上传完毕', {
                            icon: 1
                        });return true;
                    }else{
                        layer.msg(res.tip, {
                            icon: 2
                        });
                        return false;
                    }
                },
                error: function() {
                    layer.msg('出现异常，请重试', {
                        icon: 2
                    });
                }
            });
            return false;
        });
    });
});