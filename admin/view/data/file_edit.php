<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body class="pear-container">
        <div class="pear-main">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>文件信息修改</legend>
            </fieldset>

            <form class="layui-form" action="" lay-filter="form">
                <div class="layui-form-item">
                    <label class="layui-form-label">修改提取码</label>
                    <div class="layui-input-block">
                        <input type="text" name="gkey" autocomplete="off" placeholder="请输入新的提取码(不修改请留空)" class="layui-input" lay-verify="gkey">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">文件名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="origin" lay-verify="required" autocomplete="off" placeholder="请输入文件名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">剩余次数</label>
                    <div class="layui-input-block">
                        <input type="number" name="times" lay-verify="required" autocomplete="off" placeholder="请输入文件下载次数限制" class="layui-input">
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
                        <button class="pear-btn" lay-submit="" lay-filter="btn">立即提交</button>
                    </div>
                </div>
            </form>
        </div>

<script>
    layui.use(['form', 'laydate', 'jquery', 'layer'], function() {
        var form = layui.form,
            layer = layui.layer,
            laydate = layui.laydate,
            $ = layui.jquery;
        $.getJSON("/admin/api/data/file.php?action=edit&type=get&id=<?php echo $_REQUEST['id'] ?>", function(res) {
            form.val('form', res)
        })
        laydate.render({
            elem: "#tillday",
            type: "datetime"
        })

        form.verify({
            gkey: function(value) {
                if (value.length != <?php echo $verify_num ?> && value.length != 0) {
                    return '提取码为<?php echo $verify_num ?>位';
                }
            }
        });
        form.on('submit(btn)', function(data) {
            $.ajax({
                type: "POST",
                url: '/admin/api/data/file.php?action=edit&type=save&id=<?php echo $_REQUEST['id'] ?>',
                dataType: 'json',
                async: false,
                data: {
                    data: JSON.stringify(data.field)
                },
                success: function(res) {
                    if (res.code == 200) {
                        icon = 1
                    } else {
                        icon = 2
                    }
                    layer.msg(res.tip, {
                        icon: icon,
                        time: 2000,
                        shade: 0.3
                    })
                },
                error: function(res) {
                    layer.msg(res.tip, {
                        icon: 2,
                        time: 2000,
                        shade: 0.3
                    })
                }
            })
            return false;
        });

    });
</script>
</body>

</html>