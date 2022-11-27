<?php include_once dirname(__FILE__)."/./header.php"?>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>用户信息修改</legend>
        </fieldset>

        <form class="layui-form" action="" lay-filter="user_data">         
            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-block">
                    <input name="account" lay-verify="required" autocomplete="off" placeholder="请输入账号" class="layui-input" type="text">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">修改密码</label>
                <div class="layui-input-block">
                    <input type="text" name="password" autocomplete="off" placeholder="请输入新的密码(不修改请留空)" class="layui-input">
                </div>
            </div>              
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input name="mail" lay-verify="required" autocomplete="off" placeholder="请输入账号" class="layui-input" type="text">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="user_data">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'laydate'], function () {
        var form = layui.form
            , layer = layui.layer;
            $.getJSON("/admin/api/user_data_edit_get.php?uid=<?php echo $_REQUEST['uid']?>",function(res){
                form.val('user_data',res)
            })
        form.on('submit(user_data)', function (data) {
            $.ajax({
    			type: "POST",
    			url: '/admin/api/user_data_edit_save.php?uid=<?php echo $_REQUEST['uid']?>',
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
    			        icon:2,
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