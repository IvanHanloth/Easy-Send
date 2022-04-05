/*
By Ivan Hanloth
本文件为翰络云文件上传文件
2022/4/3
*/
layui.use(function() {
    var $ = layui.jquery,
    upload = layui.upload,
    element = layui.element,
    layer = layui.layer;
    //常规使用 - 普通图片上传
    upload.render({
        elem: '#upload',
        auto: false,
        accept: 'file',
        bindAction: '#uploadAction',
        size: 102400000,
        url: '/upload_file.php' //此处用的是第三方的 http 请求演示，实际使用时改成您自己的上传接口即可。
        ,
        choose: function(obj) {

            var files = this.files = obj.pushFile();

            obj.preview(function(index, file, result) {
                if (file.name.length > 10) {
                    var filename = file.name.substring(0, 10) + " ...";
                } else {
                    var filename = file.name;
                }
                $("#localinfo").html('文件名称：' + filename + '&nbsp;&nbsp;文件大小：' + (file.size / 1048517).toFixed(1) + 'Mb');
            });
            layui.$('#uploadinfo').removeClass('layui-hide');
            layui.$('#uploadprogress').removeClass('layui-hide');
            $('#key').html('');
        },
        before: function(obj) {
            element.progress('progress', '0%'); //进度条复位
            layer.msg('上传中', {
                icon: 16,
                time: 0
            });
            layui.$('#uploadprogress').removeClass('layui-hide');
            $('#uploadAction').addClass('layui-hide');
            $('#key').html('');
        },
        done: function(res, index, upload) {
            //假设code=0代表上传成功
            if (res.code == 200) {
                $('#tip').html('');
                $('#upload').addClass('layui-hide');
                $('#uploadAction').addClass('layui-hide');
                $("#fileinfo").html('<span>提取码:</span><span style="color: #FF5722;">' + res.key + '</span><br><span>剩余查看次数:</span><span style="color: #FF5722;">' + res.times + '</span><br><span>到期时间:</span><span style="color: #FF5722;">' + res.tillday + '</span>')
                layer.msg('上传完毕', {icon: 1});
            }
            //上传成功的一些操作
            //…… //置空上传失败的状态
        },
        error: function() {
            //演示失败状态，并实现重传
            var tip = $('#tip');
            tip.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs reload">重试</a>');
            tip.find('.reload').on('click',
            function() {
                uploadInst.upload();
            });
        }
        //进度条
        ,
        progress: function(n, elem, e) {
            element.progress('progress', n + '%'); //可配合 layui 进度条元素使用
        }
    });
})