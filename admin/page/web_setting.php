<?php include_once dirname(__FILE__)."/./header.php"?>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>基础设置</legend>
        </fieldset>

        <form class="layui-form" action="" lay-filter="web_setting">
            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" name="webname" lay-verify="required" autocomplete="off" placeholder="请输入网站名称" class="layui-input"lay-filter="webname">
                </div>
            </div> 
            
            <div class="layui-form-item">
                <label class="layui-form-label">网站logo地址</label>
                <div class="layui-input-block">
                    <input type="text" name="logo" autocomplete="off" placeholder="请输入网站logo地址" class="layui-input" lay-filter="keywords">
                </div>
            </div>
            
            <div class="layui-form-item">
                <label class="layui-form-label">主题名称</label>
                <div class="layui-input-block">
                    <input type="text" name="theme" lay-verify="required" autocomplete="off" placeholder="请输入主题名称" class="layui-input" lay-filter="theme">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">二维码接口</label>
                <div class="layui-input-block">
                    <input type="text" name="qrcode" lay-verify="required" autocomplete="off" placeholder="请输入二维码接口（直接返回图片地址）" class="layui-input" lay-filter="qrcode">
                </div>
            </div>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 40px;">
            <legend>SEO设置</legend>
        </fieldset>
            <div class="layui-form-item">
                <label class="layui-form-label">网站关键词（英文,分隔）</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" autocomplete="off" placeholder="请输入网站关键词（英文,分隔）" class="layui-input" lay-filter="keywords">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站描述</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入网站描述" class="layui-textarea" name="description" lay-filter="description"></textarea>
                </div>
            </div>
            
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 40px;">
            <legend>代码设置</legend>
        </fieldset>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站头部（head标签之间）</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入网站头部代码" class="layui-textarea" name="head" lay-filter="head"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站头部（head标签之后）</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入网站头部代码" class="layui-textarea" name="header" lay-filter="header"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站尾部</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入网站尾部代码" class="layui-textarea" name="footer"lay-filter="footer"></textarea>
                </div>
            </div>
            
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站首页公告</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入网站首页弹出公告，支持html代码，请不要携带英文双引号（不需要公告请留空）" class="layui-textarea" name="announcement" lay-filter="announcement"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="web_setting_save">保存设置</button>
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
            $.getJSON("/admin/api/web_setting_get.php",function(res){
                form.val('web_setting',res)
            })
        //监听提交
        form.on('submit(web_setting_save)', function (data) {
            $.ajax({
    			type: "POST",
    			url: '/admin/api/web_setting_save.php',
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