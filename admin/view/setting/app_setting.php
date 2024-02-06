<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body>
    <div class="pear-container">
        <div class="pear-main">
            <blockquote class="layui-elem-quote">
                版本（整数型）：用于比较版本实现自动更新，要实现自动推送，则该字段应该大于手机端内封装的version_num（推荐直接使用封装完成的IvanHanloth/Easy-Send-App-Mobile（或-PC）中提供的version_num），一般格式为100<br>
                版本号：用于在用户更新时显示，一般格式为V1.0.0<br>
                直连：直接连接到安装文件（如.apk/.exe等文件）的链接<br>
                版本描述与应用描述：版本描述显示在更新弹窗中，应用描述显示在下载页中（开发中）
            </blockquote>
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>手机端设置</legend>
            </fieldset>

            <form class="layui-form" action="" lay-filter="mobile_info">
                <div class="layui-form-item">
                    <label class="layui-form-label">版本（整数型）</label>
                    <div class="layui-input-block">
                        <input type="number" name="version_num" autocomplete="off" placeholder="请输入手机端版本（整数型）" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">版本号</label>
                    <div class="layui-input-block">
                        <input type="text" name="version" autocomplete="off" placeholder="请输入手机端版本号" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">版本描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入手机端版本描述" class="layui-textarea" name="update_description"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">安卓直链</label>
                    <div class="layui-input-block">
                        <input type="text" name="android_url" autocomplete="off" placeholder="请输入安卓端直链" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">苹果直链</label>
                    <div class="layui-input-block">
                        <input type="text" name="apple_url" autocomplete="off" placeholder="请输入苹果端直链" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">应用描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入手机端应用描述" class="layui-textarea" name="description"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="mobile_setting_save">保存设置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="pear-container">
        <div class="pear-main">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>电脑端设置</legend>
            </fieldset>

            <form class="layui-form" action="" lay-filter="PC_info">
                <div class="layui-form-item">
                    <label class="layui-form-label">版本（整数型）</label>
                    <div class="layui-input-block">
                        <input type="number" name="version_num" autocomplete="off" placeholder="请输入电脑端版本（整数型）" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">版本号</label>
                    <div class="layui-input-block">
                        <input type="text" name="version" autocomplete="off" placeholder="请输入电脑端版本号" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">版本描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入电脑端版本描述" class="layui-textarea" name="description" lay-filter="description"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">Windows直链</label>
                    <div class="layui-input-block">
                        <input type="text" name="windows_url" autocomplete="off" placeholder="请输入Windows端直链" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">Mac直链</label>
                    <div class="layui-input-block">
                        <input type="text" name="mac_url" autocomplete="off" placeholder="请输入Mac端直链" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">应用描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入电脑端应用描述" class="layui-textarea" name="description"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="PC_setting_save">保存设置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        layui.use(function() {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.jquery;
            $.getJSON("/admin/api/setting/app.php?action=get", function(res) {
                form.val('mobile_info', res.mobile)
                form.val('PC_info', res.PC)
            })
            //监听提交
            form.on('submit(mobile_setting_save)', function(data) {
                $.ajax({
                    type: "POST",
                    url: '/admin/api/setting/app.php?action=save',
                    dataType: 'json',
                    async: false,
                    data: {
                        "data": JSON.stringify(data.field),
                        "type": "mobile"
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
                        layer.msg("程序运行出错", {
                            icon: 2,
                            time: 2000,
                            shade: 0.3
                        })
                    }
                })
                return false;
            });
            form.on('submit(PC_setting_save)', function(data) {
                $.ajax({
                    type: "POST",
                    url: '/admin/api/setting/app.php?action=save',
                    dataType: 'json',
                    async: false,
                    data: {
                        "data": JSON.stringify(data.field),
                        "type": "PC"
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
                            icon: icon,
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