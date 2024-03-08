<?php include_once dirname(__FILE__) . "/../header.php" ?>
<link rel="stylesheet" href="../../admin/css/other/result.css" />

<body class="pear-container">
    <div class="pear-main">
        <div class="layui-card">
            <div class="layui-card-body" style="padding-top: 40px;">
                <div class="layui-carousel layui-hide" id="stepForm" lay-filter="stepForm" style="margin: 0 auto;">
                    <div carousel-item>
                        <div>
                            <form class="layui-form" action="javascript:void(0);" style="margin: 0 auto;max-width: 660px;padding-top: 40px;">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">当前版本:</label>
                                    <div class="layui-input-block">
                                        <div class="layui-form-mid layui-word-aux"><?php echo get_setting("version"); ?></div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">最新版本:</label>
                                    <div class="layui-input-block">
                                        <div class="layui-form-mid layui-word-aux" id="newest_version">????</div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">目标版本：</label>
                                    <div class="layui-input-block">
                                        <div class="layui-form-mid layui-word-aux" id="need_version">????</div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">更新模式：</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="type" value="更新" title="更新" checked lay-filter="update-type">
                                        <input type="radio" name="type" value="重装" title="重装" lay-filter="update-type">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">下载链接：</label>
                                    <div class="layui-input-block" id="need_download">
                                        ???<br>
                                        ???<BR>
                                        ???
                                    </div>

                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">注意：</label>
                                    <div class="layui-input-block">
                                        请在访问上述链接，完成下载后再点击“下一步”<br>
                                        请确保您选择了正确的更新模式，否则可能导致数据丢失<br>
                                        当前暂不支持跨版本更新，如果您与最新版差距较大请逐一更新
                                    </div>

                                </div>

                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="pear-btn pear-btn-success" lay-submit lay-filter="formStep">
                                            &emsp;下一步&emsp;
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <form class="layui-form" action="javascript:void(0);" style="margin: 0 auto;max-width: 660px;padding-top: 40px;">
                                <div id="update-upload">
                                    <div class="layui-row">
                                        <div class="layui-col-md6">
                                            <div class="layui-upload-drag" style="display: block;" id="code-upload">
                                                <i class="layui-icon layui-icon-upload"></i>
                                                <div>点击上传，或将文件拖拽到此处</div>
                                                <div>上传代码文件</div>
                                            </div>
                                        </div>
                                        <div class="layui-col-md6">
                                            <div class="layui-upload-drag" style="display: block;" id="sql-upload">
                                                <i class="layui-icon layui-icon-upload"></i>
                                                <div>点击上传，或将文件拖拽到此处</div>
                                                <div>上传数据库文件</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-hide" id="reinstall-upload">
                                    <div class="layui-upload-drag" style="display: block;" id="all-upload">
                                        <i class="layui-icon layui-icon-upload"></i>
                                        <div>点击上传，或将文件拖拽到此处</div>
                                        <div>上传完整包</div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        务必在完成所有文件上传后再点击下一步<br>
                                        <button type="button" class="pear-btn pear-btn-success pre">上一步</button>
                                        <button class="pear-btn pear-btn-success" lay-submit lay-filter="formStep2">
                                            &emsp;下一步&emsp;
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <form class="layui-form" action="javascript:void(0);" style="margin: 0 auto;max-width: 660px;padding-top: 40px;">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">管理员密码：</label>
                                    <div class="layui-input-block">
                                        <input class="layui-input" type="password" name="password" placeholder="请输入管理员密码">
                                    </div>
                                </div>
                                <button class="pear-btn pear-btn-success" lay-submit lay-filter="formStep3">
                                    &emsp;确认更新&emsp;
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="result layui-hide" id="error-page">
                    <div class="error">
                        <svg viewBox="64 64 896 896" data-icon="close-circle" width="80px" height="80px" fill="currentColor" aria-hidden="true" focusable="false" class="">
                            <path d="M685.4 354.8c0-4.4-3.6-8-8-8l-66 .3L512 465.6l-99.3-118.4-66.1-.3c-4.4 0-8 3.5-8 8 0 1.9.7 3.7 1.9 5.2l130.1 155L340.5 670a8.32 8.32 0 0 0-1.9 5.2c0 4.4 3.6 8 8 8l66.1-.3L512 564.4l99.3 118.4 66 .3c4.4 0 8-3.5 8-8 0-1.9-.7-3.7-1.9-5.2L553.5 515l130.1-155c1.2-1.4 1.8-3.3 1.8-5.2z"></path>
                            <path d="M512 65C264.6 65 64 265.6 64 513s200.6 448 448 448 448-200.6 448-448S759.4 65 512 65zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path>
                        </svg>
                    </div>
                    <h2 class="title">无法连接至Github</h2>
                    <p class="desc">
                        您当前的网络环境似乎无法访问Github，可能无法下载更新文件，可能无法使用离线更新功能<br>
                        如果您已下载更新文件，请点击下方按钮忽略此提示，上传文件<br>
                        您可以尝试使用Github镜像站下载更新文件或切换至其他网络环境重试
                    </p>
                    <form class="layui-form" action="javascript:void(0);" style="margin: 0 auto;max-width: 660px;padding-top: 40px;">
                        <div class="layui-form-item">
                            <label class="layui-form-label">更新模式：</label>
                            <div class="layui-input-block">
                                <input type="radio" name="type" value="更新" title="更新" checked lay-filter="update-type">
                                <input type="radio" name="type" value="重装" title="重装" lay-filter="update-type">
                            </div>
                        </div>
                    </form>
                    <div class="action">
                        <button class="pear-btn pear-btn-primary" id="pass-tip">忽略提示</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(['form', 'step', 'element', 'loading', 'context', 'upload'], function() {
            var $ = layui.$,
                form = layui.form,
                step = layui.step,
                loading = layui.loading,
                upload = layui.upload,
                context = layui.context;
            loading.Load(5, "正在检查网络状态...")
            context.put("update-type", "更新");
            $.ajax({
                url: "//ivanhanloth.github.io/Easy-Send/server.json",
                type: "GET",
                success: function(data) {
                    $("#stepForm").removeClass("layui-hide");
                    $("#error-page").addClass("layui-hide");
                    loading.loadRemove(100);
                    var need = [];
                    var current={};
                    $("#newest_version").html(data.update[0].version);
                    data.update.forEach(function(item) {
                        if(item.version_num == <?php echo get_setting("version_num"); ?>){
                            need.push({
                                "version": item.version,
                                "version_num": item.version_num,
                                "description": item.description,
                                "sql_url": item.sql_url,
                                "code_url": item.code_url,
                                "all_url": item.all_url,
                                "time:": item.time
                            });
                        }
                    })
                    data.update.forEach(function(item) {
                        if (item.version_num > <?php echo get_setting("version_num"); ?>) {
                            need.push({
                                "version": item.version,
                                "version_num": item.version_num,
                                "description": item.description,
                                "sql_url": item.sql_url,
                                "code_url": item.code_url,
                                "all_url": item.all_url,
                                "time:": item.time
                            });
                        }
                    })
                    $("#need_version").html(need[need.length - 1]["version"]);
                    if (need.length == 1) {
                        $("#need_version").html("无需更新");
                    }
                    $("#need_download").html("");
                    $("#need_download").append("<a id='code-url' href='" + need[need.length - 1]["code_url"] + "'>代码文件：" + need[need.length - 1]["code_url"] + "<br></a>");
                    $("#need_download").append("<a id='sql-url' href='" + need[need.length - 1]["sql_url"] + "'>数据库文件：" + need[need.length - 1]["sql_url"] + "<Br></a>");
                    $("#need_download").append("<a id='all-url' class='layui-hide' href='" + need[need.length - 1]["all_url"] + "'>完整包:" + need[need.length - 1]["all_url"] + "<Br></a>");

                },
                error: function() {
                    $("#error-page").removeClass("layui-hide");
                    $("#stepForm").addClass("layui-hide");
                    loading.loadRemove(100)
                }
            });
            $("#pass-tip").click(function() {
                $("#stepForm").removeClass("layui-hide");
                $("#error-page").addClass("layui-hide");
                step.next('#stepForm');
            })

            step.render({
                elem: '#stepForm',
                filter: 'stepForm',
                width: '100%',
                stepWidth: '600px',
                height: '500px',
                stepItems: [{
                    title: '下载更新包'
                }, {
                    title: '上传更新包'
                }, {
                    title: '准备更新'
                }]
            });
            form.on('radio(update-type)', function(data) {
                var data = data.value;
                if (data == "更新") {
                    $("#code-url").removeClass("layui-hide");
                    $("#sql-url").removeClass("layui-hide");
                    $("#all-url").addClass("layui-hide");
                    $("#update-upload").removeClass("layui-hide");
                    $("#reinstall-upload").addClass("layui-hide");
                } else {
                    $("#code-url").addClass("layui-hide");
                    $("#sql-url").addClass("layui-hide");
                    $("#all-url").removeClass("layui-hide");
                    $("#update-upload").addClass("layui-hide");
                    $("#reinstall-upload").removeClass("layui-hide");
                }
                context.put("update-type", data);
            });
            form.on('submit(formStep)', function(data) {
                step.next('#stepForm');
                upload.render({
                    elem: '#code-upload',
                    url: '/admin/api/tool/uploader.php',
                    data: {
                        filename: "code.zip",
                        relative: "true",
                        path: "/update/file"
                    },
                    done: function(res) {
                        layer.msg('上传成功');
                    }
                });
                upload.render({
                    elem: '#sql-upload',
                    url: '/admin/api/tool/uploader.php',
                    data: {
                        filename: "sql.zip",
                        relative: "true",
                        path: "/update/file"
                    },
                    done: function(res) {
                        layer.msg('上传成功');
                    }
                });
                upload.render({
                    elem: '#all-upload',
                    url: '/admin/api/tool/uploader.php',
                    data: {
                        filename: "code.zip"
                    },
                    done: function(res) {
                        layer.msg('上传成功');
                    }
                });
                return false;
            });

            form.on('submit(formStep2)', function(data) {
                step.next('#stepForm');
                return false;
            });
            form.on('submit(formStep3)', function(data) {
                layer.msg("正在提交……", {
                    icon: 16,
                    time: 0,
                    shade: 0.3
                })
                $.ajax({
                    type: "POST",
                    url: "/admin/api/setting/update.php?action=offline_update",
                    data: {
                        password: data.field.password,
                        type: context.get("update-type")
                    },
                    success: function(res) {
                        layer.closeAll()
                        if (res.code == 200) {
                            layer.msg(res.tip, {
                                icon: 1,
                                shade: 0.3,
                                time: 1000,
                                end: function() {
                                    window.location.href = "/"
                                }
                            })
                        } else {
                            layer.msg(res.tip, {
                                icon: 2,
                                shade: 0.3,
                                time: 2000
                            })
                        }
                    },
                    error: function() {
                        layer.msg("服务器出现错误，请检查/admin/api/setting/update.php", {
                            icon: 2,
                            shade: 0.3,
                            time: 2000
                        })
                    }
                })
            });

            $('.pre').click(function() {
                step.pre('#stepForm');
                return false;
            });

            $('.next').click(function() {
                step.next('#stepForm');
                return false;
            });
        })
    </script>
</body>

</html>