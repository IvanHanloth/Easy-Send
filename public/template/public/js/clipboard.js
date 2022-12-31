layui.use(function(){
    var layer=layui.layer;
    var clipboard=new ClipboardJS('.code');
    clipboard.on('success', function (e) {
         layer.msg("提取码复制成功",{time:1500})
    });
    clipboard.on('error', function (e) {
         layer.msg("提取码复制失败，请手动复制",{time:1500})
    });
});