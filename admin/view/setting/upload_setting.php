<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body class="pear-container">
    <div class="pear-main">
        <blockquote class="layui-elem-quote layui-quote-nm">
            如果不知道如何配置，请查看<a href="http://doc.hanloth.cn/docs/easy-send-docs-help/" target="_blank">说明文档（http://doc.hanloth.cn/docs/easy-send-docs-help/）</a>或<a href="http://doc.o5g.top/docs/easy-send-docs-help/" target="_blank">说明文档（http://doc.o5g.top/docs/easy-send-docs-help/）</a></blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>基础设置</legend>
        </fieldset>

        <form class="layui-form" action="" lay-filter="upload_setting">
            <div class="layui-form-item">
                <label class="layui-form-label">提取次数限制方式</label>
                <div class="layui-input-block">
                    <select name="limit_way_times" lay-filter="limit_way_times">
                        <option value='1'>固定值</option>
                        <option value='2'>最大值</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item  layui-hide" id="limit_times_1">
                <label class="layui-form-label">提取次数(次)</label>
                <div class="layui-input-block">
                    <input type="number" name="times" lay-verify="required" autocomplete="off" placeholder="请输入提取次数" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item  layui-hide" id="limit_times_2">
                <label class="layui-form-label">提取次数最大值(次)</label>
                <div class="layui-input-block">
                    <input type="number" name="limit_num_times" lay-verify="required" autocomplete="off" placeholder="请输入提取次数最大值" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">到期时间限制方式</label>
                <div class="layui-input-block">
                    <select name="limit_way_tillday" lay-filter="limit_way_tillday">
                        <option value='1'>固定值</option>
                        <option value='2'>最大值</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item  layui-hide" id="limit_tillday_1">
                <label class="layui-form-label">过期时长(天)</label>
                <div class="layui-input-block">
                    <input type="number" name="settime" lay-verify="required" autocomplete="off" placeholder="请输入数据过期时长" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item  layui-hide" id="limit_tillday_2">
                <label class="layui-form-label">过期时长最大值(天)</label>
                <div class="layui-input-block">
                    <input type="number" name="limit_num_tillday" lay-verify="required" autocomplete="off" placeholder="请输入数据过期时长最大值" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文件限制(B)</label>
                <div class="layui-input-block">
                    <input type="number" name="uploadsize" lay-verify="required" autocomplete="off" placeholder="请输入文件上传限制" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文本限制</label>
                <div class="layui-input-block">
                    <input type="number" name="textsize" lay-verify="required" autocomplete="off" placeholder="请输入文本上传限制" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文本存储形式</label>
                <div class="layui-input-block">
                    <input type="radio" name="textmethod" value="on" title="文件（推荐）">
                    <input type="radio" name="textmethod" value="off" title="数据库">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="upload_setting_save">保存设置</button>
                </div>
            </div>
        </form>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>第三方设置</legend>
        </fieldset>
        <form class="layui-form" action="" lay-filter="cloud_setting">
            <div class="layui-form-item">
                <label class="layui-form-label">存储方式</label>
                <div class="layui-input-block">
                    <select name="cloud_way">
                        <option value='server'>服务器</option>
                        <option value='qiniu'>七牛云</option>
                    </select>
                </div>
            </div>
            <?php if ($cloud_way == "qiniu") { ?>

                <div class="layui-form-item">
                    <label class="layui-form-label">Access Key</label>
                    <div class="layui-input-block">
                        <input type="text" name="qiniu_Access_Key" autocomplete="off" placeholder="请输入七牛云Access Key" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">Secret Key</label>
                    <div class="layui-input-block">
                        <input type="text" name="qiniu_Secret_Key" autocomplete="off" placeholder="请输入七牛云Secret Key" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">空间名</label>
                    <div class="layui-input-block">
                        <input type="text" name="qiniu_bucket" autocomplete="off" placeholder="请输入七牛云空间名" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">空间绑定域名</label>
                    <div class="layui-input-block">
                        <input type="url" name="qiniu_domain" autocomplete="off" placeholder="请输入七牛云空间绑定域名（包含http://或https://以及结尾/）" class="layui-input">
                    </div>
                </div>
                <blockquote class="layui-elem-quote layui-quote-nm">
                    如果不知道如何配置，请查看<a href="http://doc.hanloth.cn/docs/easy-send-docs-help/easy-send-docs-help-1ed6chk82usio" target="_blank">说明文档（http://doc.hanloth.cn/docs/easy-send-docs-help/）</a>或<a href="http://doc.o5g.top/docs/easy-send-docs-help/easy-send-docs-help-1ed6chk82usio" target="_blank">说明文档（http://doc.o5g.top/docs/easy-send-docs-help/）</a></blockquote>
            <?php } ?>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="cloud_setting_save">保存设置</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        layui.use(function() {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.jquery;
            $.getJSON("/admin/api/setting/upload.php?action=get", function(data) {
                form.val('upload_setting', data)
                if (data.limit_way_tillday == 1) {
                    $("#limit_tillday_1").removeClass("layui-hide");
                } else if (data.limit_way_tillday == 2) {
                    $("#limit_tillday_2").removeClass("layui-hide");
                }
                if (data.limit_way_times == 1) {
                    $("#limit_times_1").removeClass("layui-hide");
                } else if (data.limit_way_times == 2) {
                    $("#limit_times_2").removeClass("layui-hide");
                }
            })
            $.getJSON("/admin/api/setting/cloud.php?action=get", function(res) {
                form.val('cloud_setting', res)
            })

            form.on('select(limit_way_tillday)', function(data) {
                if (data.value == 1) {
                    $("#limit_tillday_1").removeClass("layui-hide");
                    $("#limit_tillday_2").addClass("layui-hide");
                } else if (data.value == 2) {
                    $("#limit_tillday_1").addClass("layui-hide");
                    $("#limit_tillday_2").removeClass("layui-hide");
                }
            });
            form.on('select(limit_way_times)', function(data) {
                if (data.value == 1) {
                    $("#limit_times_1").removeClass("layui-hide");
                    $("#limit_times_2").addClass("layui-hide");
                } else if (data.value == 2) {
                    $("#limit_times_1").addClass("layui-hide");
                    $("#limit_times_2").removeClass("layui-hide");
                }
            });
            //监听提交
            form.on('submit(upload_setting_save)', function(data) {
                $.ajax({
                    type: "POST",
                    url: '/admin/api/setting/upload.php?action=save',
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
            form.on('submit(cloud_setting_save)', function(data) {
                $.ajax({
                    type: "POST",
                    url: '/admin/api/setting/cloud.php?action=save',
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
                            shade: 0.3,
                            end: function() {
                                window.location.reload()
                            }
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