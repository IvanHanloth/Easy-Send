<?php include_once dirname(__FILE__)."/./header.php"?>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>上传设置</legend>
        </fieldset>

        <form class="layui-form" action="" lay-filter="upload_setting">
            <div class="layui-form-item">
                <label class="layui-form-label">提取次数(次)</label>
                <div class="layui-input-block">
                    <input type="number" name="times" lay-verify="required" autocomplete="off" placeholder="请输入提取次数上限" class="layui-input">
                </div>
            </div>            
            <div class="layui-form-item">
                <label class="layui-form-label">过期时长(秒)</label>
                <div class="layui-input-block">
                    <input type="number" name="settime" lay-verify="required" autocomplete="off" placeholder="请输入数据过期时长" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文件限制(B)</label>
                <div class="layui-input-block">
                    <input type="number" name="uploadsize" lay-verify="required" autocomplete="off" placeholder="请输入文件上传限制" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文本限制(字符)</label>
                <div class="layui-input-block">
                    <input type="number" name="textsize" lay-verify="required" autocomplete="off" placeholder="请输入文本上传限制" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文本以文件形式存储</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="textmethod" lay-skin="switch" lay-text="ON|OFF">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="upload_setting_save">保存设置</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(function () {
        var form = layui.form
            , layer = layui.layer;
            $.getJSON("/admin/api/upload_setting_get.php",function(res){
                form.val('upload_setting',res)
            })
        //监听提交
        form.on('submit(upload_setting_save)', function (data) {
            $.ajax({
    			type: "POST",
    			url: '/admin/api/upload_setting_save.php',
    			dataType: 'json',
    			async: false,
    			data:{"data":JSON.stringify(data.field)},
    			success:function(res){
    			    if(res.code==200){
    			        icon=1
    			    }else{
    			        icon=2
    			    }
    			    layer.msg(res.tip,{
    			        icon:icon,
    			        time:2000,
    			        shade:0.3
    			    })
    			},
    			error:function(res){
    			    layer.msg(res.tip,{
    			        icon:icon,
    			        time:2000,
    			        shade:0.3
    			    })
    			}
            })
            return false;
        });

    });
</script>

</body>
</html>