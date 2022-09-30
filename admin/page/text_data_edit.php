<?php include_once dirname(__FILE__)."/./header.php"?>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>文本信息修改</legend>
        </fieldset>

        <form class="layui-form" action="" lay-filter="file_data">
            <div class="layui-form-item">
                <label class="layui-form-label">修改提取码</label>
                <div class="layui-input-block">
                    <input type="text" name="gkey" autocomplete="off" placeholder="请输入新的提取码(不修改请留空)" class="layui-input" lay-verify="gkey">
                </div>
            </div>            
            <div class="layui-form-item">
                <label class="layui-form-label">文本内容</label>
                <div class="layui-input-block">
                    <textarea name="data" lay-verify="required" autocomplete="off" placeholder="请输入文本内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">剩余次数</label>
                <div class="layui-input-block">
                    <input type="number" name="times" lay-verify="required" autocomplete="off" placeholder="请输入文件上传限制" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">到期时间</label>
                <div class="layui-input-block">
                    <input type="text" name="tillday" lay-verify="required" autocomplete="off" id="tillday" placeholder="yyyy-MM-dd HH:mm:ss" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="file_data">立即提交</button>
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
            , layer = layui.layer
            , laydate = layui.laydate;
            $.getJSON("/admin/api/text_data_edit_get.php?id=<?php echo $_REQUEST['id']?>",function(res){
                form.val('file_data',res)
            })
            laydate.render({
                elem:"#tillday",
                type:"datetime"
            })

	form.verify({
		gkey: function (value) {
			if (value.length !=4 && value.length!=0) {
				return '提取码为4位';
			}
		}
	});
        form.on('submit(file_data)', function (data) {
            $.ajax({
    			type: "POST",
    			url: '/admin/api/text_data_edit_save.php?id=<?php echo $_REQUEST['id']?>',
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