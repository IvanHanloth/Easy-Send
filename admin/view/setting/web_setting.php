<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body class="pear-container">
    <div class="pear-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>基础设置</legend>
        </fieldset>

        <form class="layui-form" action="" lay-filter="web_setting">
            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" name="webname" lay-verify="required" autocomplete="off" placeholder="请输入网站名称" class="layui-input" lay-filter="webname">
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
                    <select name="theme">
                        <?php
                        $theme_dir = scandir(dirname(__FILE__) . "/../../../theme/");
                        foreach ($theme_dir as $dirname) {
                            if ($dirname == "." or $dirname == "..") {
                                continue;
                            }
                            echo "<option value='{$dirname}'>{$dirname}</option>";
                        }
                        ?></select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提取码类型</label>
                <div class="layui-input-block">
                    <input type="radio" name="verify_type" value="mix" title="数字字母混合">
                    <input type="radio" name="verify_type" value="number" title="纯数字">
                    <input type="radio" name="verify_type" value="text" title="纯字母">
                    <input type="radio" name="verify_type" value="capital" title="纯大写">
                    <input type="radio" name="verify_type" value="lower" title="纯小写">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提取码长度</label>
                <div class="layui-input-block">
                    <input type="number" name="verify_num" lay-verify="required" autocomplete="off" placeholder="请输入提取码长度" class="layui-input" lay-filter="verify_num">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否启用整页上传</label>
                <div class="layui-input-block">
                    <input type="radio" name="whole_upload" value="on" title="启用">
                    <input type="radio" name="whole_upload" value="off" title="关闭">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否启用扫码功能</label>
                <div class="layui-input-block">
                    <input type="radio" name="if_scan" value="on" title="启用">
                    <input type="radio" name="if_scan" value="off" title="关闭">
                </div>
            </div>
            <blockquote class="layui-elem-quote layui-quote-nm">扫码功能说明：<br>扫码功能需要网站使用https协议访问，否则无法调用摄像头进行扫码<br>扫码功能地址：网址/scan 部分主题可能不会提供扫码功能入口</blockquote>
            <div class="layui-form-item">
                <label class="layui-form-label">是否启用网站灰度</label>
                <div class="layui-input-block">
                    <input type="radio" name="if_gray" value="on" title="启用">
                    <input type="radio" name="if_gray" value="off" title="关闭">
                </div>
            </div>
            <blockquote class="layui-elem-quote layui-quote-nm">网站灰度功能用于在大型悼念活动中将网站主页设为灰色以示哀悼。<br>此功能可能会延长网站加载速度</blockquote>
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
                    <textarea placeholder="请输入网站尾部代码" class="layui-textarea" name="footer" lay-filter="footer"></textarea>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站首页公告</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入网站首页弹出公告，支持html代码（不需要公告请留空）" class="layui-textarea" name="announcement" lay-filter="announcement"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="web_setting_save">保存设置</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        layui.use(["form","layer","jquery"],function() {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.jquery;
            $.getJSON("/admin/api/setting/web.php?action=get", function(res) {
                form.val('web_setting', res)
            })
            //监听提交
            form.on('submit(web_setting_save)', function(data) {
                $.ajax({
                    type: "POST",
                    url: '/admin/api/setting/web.php?action=save',
                    dataType: 'json',
                    async: false,
                    data: {
                        "data": JSON.stringify(data.field)
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

        });
    </script>

</body>

</html>