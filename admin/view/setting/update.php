<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body class="pear-container">
    <div class="pear-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>网站更新</legend>
        </fieldset>
        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <div class="layui-colla-title">更新需要注意什么？</div>
                <div class="layui-colla-content">
                    无论您选择使用什么方式进行更新，都需要您的PHP启用ZipArchive扩展，否则无法实现一键更新<Br>
                    更新前请先备份您的数据库以及您对各模板的更改，以免造成数据的丢失。<br>
                    目前无法实现跨版本更新，如果您的版本与最新版本相差过大，请逐一更新<br>
                </div>
            </div>
            <div class="layui-colla-item">
                <div class="layui-colla-title">怎么选择更新方式？</div>
                <div class="layui-colla-content">
                    对于不同更新方式的说明：<br>
                    在线更新：使用服务器网络进行更新，要求服务器能够访问Github，并安装了curl拓展<br>
                    离线更新：您手动下载更新包并上传至/update/file文件夹下，对服务器的网络没有要求<br>
                    如何选择：<br>
                    点击“评估”按钮，按照提示进行选择
                </div>
            </div>
            <div class="layui-colla-item">
                <div class="layui-colla-title">更新和重装的区别？</div>
                <div class="layui-colla-content">
                    更新：仅获取更改的内容并覆盖，您的使用数据将会被保留<br>
                    重装：完全重装本程序，您的使用数据将会被清空并将程序升级至最新版本
                </div>
            </div>
        </div>
        <blockquote class="layui-elem-quote">
            <button type="button" id="evaluate" class="layui-btn layui-btn-danger">更新评估</button>
            <button type="button" id="update_get_btn" class="layui-btn layui-btn-warm">检查更新</button>
            <button type="button" id="update_log_get" class="layui-btn">更新日志</button>
            <button type="button" id="update_offline" class="layui-btn layui-bg-blue">离线更新</button>
        </blockquote>
        <div id="update_info" class="layui-hide">
            <p>当前版本号：<span id="now_version"></span></p>
            <p>最新版本号：<span id="newest_version"></span></p>
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="info_box">
                <legend>更新说明</legend>
                <div class="layui-collapse" id="version_info">

                </div>
            </fieldset>
        </div>
        <div id="update_log" class="layui-hide">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="log_box">
                <legend>更新日志</legend>
                <div class="layui-collapse" id="version_log">

                </div>
            </fieldset>
        </div>
        <div id="update_evl" class="layui-hide">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="log_box">
                <legend>更新评估</legend>
            </fieldset>
            <div id="update_evl_info" style="color:red;font-size:20px;font-weight:bold">
            </div>
        </div>
    </div>

    <script>
        function update(version_num, all) {
            layui.use(function() {
                var layer = layui.layer,
                    $ = layui.jquery;
                layer.prompt({
                    title: "请输入后台密码以确认更新",
                    formType: 1
                }, function(value, index, elem) {
                    layer.msg("正在提交……", {
                        icon: 16,
                        time: 0,
                        shade: 0.3
                    })
                    $.ajax({
                        type: "POST",
                        url: "/admin/api/setting/update.php?action=online_update",
                        data: {
                            "password": value,
                            "version_num": version_num,
                            "all": all
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
            })
        }
        layui.use(['form', 'layer', 'button', 'element', 'jquery'], function() {
            var form = layui.form,
                layer = layui.layer,
                button = layui.button,
                element = layui.element,
                $ = layui.jquery;
            $("#evaluate").click(function() {
                var ev_btn = button.load({
                    elem: '#evaluate'
                });
                $.getJSON("/admin/api/setting/update.php?action=evaluate", function(data) {
                    $("#update_evl_info").html(data.tip);
                    ev_btn.stop();
                    $("#update_evl").removeClass("layui-hide");
                })
            })
            $("#update_get_btn").click(function() {
                layer.msg("正在获取更新信息", {
                    icon: 16,
                    time: 0,
                    shade: 0.3
                })
                $.getJSON("/admin/api/setting/update.php?action=info", function(res) {
                    layer.closeAll()
                    $("#update_info").removeClass("layui-hide")
                    $("#now_version").html(res.now_version)
                    $("#newest_version").html(res.newest_version)
                    if (res.code == 200) {
                        if (res.info.length != 0) {
                            res.info.forEach(function(value) {
                                $("#version_info").append('<div class="layui-colla-item"><h2 class="layui-colla-title">' + value.version + '</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>' + value.time + '</p><p><span>更新内容：</span>' + value.description + '</p><button class="layui-btn layui-btn-normal" onclick="update(' + value.version_num + ',false)">更新至此版本</button></div></div>')
                            })
                        } else {
                            $("#version_info").append('<div class="layui-colla-content layui-show"><strong>恭喜，您的程序处于最新版本，并不需要更新</strong></div>')
                        }

                        $("#version_info").append('<div class="layui-colla-content layui-show">您也可以选择重装本程序<br><button class="layui-btn layui-btn-danger" id="total-reinstall" type="button" onclick="update('+"''"+',true)">完全重装</button></div>')
                    } else {
                        layer.open({
                            content: "服务器无法连接至Github，正在尝试使用本地网络连接",
                            icon: 2,
                            title: "错误"
                        });
                        $.ajax({
                            url: "//ivanhanloth.github.io/Easy-Send/server.json",
                            type: "GET",
                            success: function(data) {
                                if (res.now_version_num < data.update[0].version_num) {
                                    data.update.forEach(function(data) {
                                        if (res.now_version_num < data.version_num) {
                                            $("#version_info").append('<div class="layui-colla-item"><h2 class="layui-colla-title">' + data.version + '</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>' + data.time + '</p><p><span>更新内容：</span>' + data.description + '</p></div></div>')
                                        }
                                    })
                                    $("#version_info").append('<div class="layui-colla-content layui-show"><strong>您的服务器无法连接至Github，更新信息使用本地网络获取，如需进行更新请使用离线更新功能</strong></div>')
                                } else {
                                    $("#version_info").append('<div class="layui-colla-content layui-show"><strong>恭喜，您的程序处于最新版本，并不需要更新</strong></div>')
                                }
                                $("#newest_version").html(data.update[0].version)
                                $("#version_info").append('<div class="layui-colla-content layui-show">您也可以选择重装本程序<br><button class="layui-btn layui-btn-danger" id="total-reinstall" type="button" onclick="update("",true)">完全重装</button></div>')

                            },
                            error: function() {
                                layer.open({
                                    content: "您的网络无法连接至Github，检查更新失败",
                                    icon: 2,
                                    title: "错误"
                                });
                            }
                        });
                    }

                })
            })


            $("#update_log_get").click(function() {
                layer.msg("正在获取日志信息", {
                    icon: 16,
                    time: 0,
                    shade: 0.3
                })
                $.getJSON("/admin/api/setting/update.php?action=log", function(res) {
                    layer.closeAll()
                    $("#update_log").removeClass("layui-hide")
                    if (res.log.length != 0) {
                        res.log.forEach(function(value) {
                            $("#version_log").append('<div class="layui-colla-item"><h2 class="layui-colla-title">' + value.version + '</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>' + value.time + '</p><p><span>更新内容：</span>' + value.description + '</p></div></div>')
                        })
                    } else {
                        layer.open({
                            content: "服务器无法连接至Github，正在尝试使用本地网络连接",
                            icon: 2,
                            title: "错误"
                        });
                        $.ajax({
                            url: "//ivanhanloth.github.io/Easy-Send/server.json",
                            type: "GET",
                            success: function(data) {
                                data.update.forEach(function(data) {
                                    $("#version_log").append('<div class="layui-colla-item"><h2 class="layui-colla-title">' + data.version + '</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>' + data.time + '</p><p><span>更新内容：</span>' + data.description + '</p></div></div>')
                                })
                            },
                            error: function() {
                                layer.open({
                                    content: "您的网络无法连接至Github，获取更新日志失败",
                                    icon: 2,
                                    title: "错误"
                                });
                            }
                        });
                    }
                })
            })
            $("#update_offline").click(function() {
                layer.open({
                    type: 2,
                    title: '离线更新',
                    content: '/admin/view/setting/update_offline.php',
                    area: ['80%', '80%'],
                    maxmin: true
                });
            })
        });
    </script>

</body>

</html>
