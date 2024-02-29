/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
/*
全局变量定义区
*/
room_info = 0;
all_blob = [];
save_lock = 1;
upload_lock = "";

function send_notification(content) {
    try {
        new Notification("直传状态变更提醒", {
            badge: "/favicon.ico",
            body: content,
            icon: "/favicon.ico"
        })
    } catch (e) {
        $("#if_notify_box").prop("checked", false);
        $("#if_notify").addClass("layui-hide");
        layui.use(function () {
            layui.layer.msg("抱歉，您的浏览器不支持发送网页通知")
        })
    }
}
layui.use(function () {
    var form = layui.form,
        $ = layui.jquery,
        element = layui.element,
        layer = layui.layer;
    //提示
    $('#room_use_tips').click(function () {
        layer.open({
            content: "<b>Q：文件直传原理是什么？</b><br>\
    		    A：文件直传借助服务器进行跨设备文件即时传输，通过发送端即时分片上传，接收端即时分片下载实现。<br><br>\
    		    <b>Q：文件直传是否需要不同设备处在同一网络下，例如同一WIFI或同一局域网？</b><br>\
    		    A：发送端与接收端可不在同一网络环境下。<br><br>\
    		    <b>Q：房间号与密码是什么？</b><br>\
    		    A：房间是用于标识不同的传输过程。输入未创建的房间号后自动会创建新的房间，输入已存在的房间号则需要正确输入密码才能加入。<br><br>\
    		    <b>Q：文件直传会消耗流量吗？</b><br>\
    		    A：会，如果在使用的是移动数据，文件直传需要消耗流量。<br><br>\
    		    <b>Q：文件直传需要注意些什么？</b><br>\
    		    A：1.正确选择当前设备所处身份<br>\
    		    &emsp;2.使用完直传功能后应该点击“退出房间”按钮退出，以免出现后续无法再次加入该房间的问题。",
            shade: 0.3,
            shadeClose: true,
            area: ["70%", "60%"],
            title: "文件直传使用方法Q&A"
        });
    });
    $("#if_notify span").click(function () {
        $("#if_notify_box").click();
    })
    //检查是否支持订阅
    if (window.Notification && document.location.protocol == "https:") {
        $("#if_notify").removeClass("layui-hide");
    }
    //订阅通知
    $("#if_notify_box").change(function () {
        if ($("#if_notify_box").prop("checked")) {
            if (Notification.permission == "default") {
                layer.confirm('状态变更提醒需要获取浏览器的通知权限<br>手机浏览器一般不支持此功能', {
                    cancel: function (index) {
                        layer.close(index);
                        $("#if_notify_box").prop("checked", false);
                    },
                    title: "获取权限"
                }, function (index) {
                    Notification.requestPermission(function (status) {
                        if (status === "granted") {
                            layer.msg("权限获取成功！", {
                                icon: 1,
                                time: 1500
                            })
                            layer.close(index);

                        } else if (status === "default") {
                            layer.msg("权限获取失败，可尝试重新获取", {
                                icon: 2,
                                time: 1500
                            })
                            $("#if_notify_box").prop("checked", false);
                        } else if (status === "denied") {
                            layer.msg("您禁用了通知权限", {
                                icon: 2,
                                time: 1500
                            })
                            $("#if_notify_box").prop("checked", false);
                        }
                    });
                }, function (index) {
                    $("#if_notify_box").prop("checked", false)
                    layer.close(index);
                })
            } else if (Notification.permission == "denied") {
                layer.open({
                    content: "状态变更提醒功能需要获取浏览器的通知权限，您曾禁止了我们获取的此项权限<Br>请尝试重置网站设置以便我们能够重新获取该权限",
                    title: "无法启用",
                    end: function () {
                        $("#if_notify_box").prop("checked", false);
                    }
                })
                $("#if_notify_box").prop("checked", false);
            }
        }
    });

    //监听提交
    form.on('submit(roombtn)', function (data) {
        $.ajax({
            //定义提交的方式
            type: "POST",
            //定义要提交的URL
            url: '/public/api/room_attend.php',
            //定义提交的数据类型
            dataType: 'json',
            async: true,
            //要传递的数据
            data: {
                "data": JSON.stringify(data.field),
                "step": "input"
            },
            //服务器处理成功后传送回来的json格式的数据
            success: function (res) {
                room_reset();
                if (res.code == 200) {
                    $("#room_input").addClass("layui-hide");
                    $("#room_choose").removeClass("layui-hide");
                    $("#room_info").removeClass("layui-hide");
                    $("#room_roomid").html(res.roomid);
                    if (res.type == "send") {
                        mytype = "发送端";
                    } else if (res.type == "receive") {
                        mytype = "接收端";
                    } else {
                        mytype = "神秘人";
                    }
                    $("#room_type").html(mytype);
                    $("#room_state").html(res.state);
                    layer.msg(res.tip, {
                        icon: 1
                    });
                    data_check_i();
                } else {
                    if (res.code == 100) {
                        layer.msg(res.tip, {
                            icon: 2
                        });
                    } else {
                        layer.msg("出现异常", {
                            icon: 2
                        });
                    }
                }
            },
            error: function () {
                layer.msg('出现异常，请重试', {
                    icon: 2
                });
            }
        });
        return false;
    });
    $("#room_choose_send").click(function () {
        $.ajax({
            //定义提交的方式
            type: "POST",
            //定义要提交的URL
            url: '/public/api/room_attend.php',
            //定义提交的数据类型
            dataType: 'json',
            async: true,
            //要传递的数据
            data: {
                "type": "send",
                "step": "choose"
            },
            //服务器处理成功后传送回来的json格式的数据
            success: function (res) {
                if (res.code == 200) {
                    $("#room_choose").addClass("layui-hide");
                    $("#room_send").removeClass("layui-hide");
                    layer.msg(res.tip, {
                        icon: 1
                    });
                } else {
                    layer.msg(res.tip, {
                        icon: 2
                    });
                }
            },
            error: function () {
                layer.msg('出现异常，请重试', {
                    icon: 2
                });
            }
        });
    });
    $("#room_choose_receive").click(function () {
        $.ajax({
            type: "POST",
            url: '/public/api/room_attend.php',
            dataType: 'json',
            async: true,
            //要传递的数据
            data: {
                "type": "receive",
                "step": "choose"
            },
            //服务器处理成功后传送回来的json格式的数据
            success: function (res) {
                if (res.code == 200) {
                    $("#room_choose").addClass("layui-hide");
                    $("#room_receive").removeClass("layui-hide");
                    room_receive();
                    layer.msg(res.tip, {
                        icon: 1
                    });
                } else {
                    layer.msg(res.tip, {
                        icon: 2
                    });
                }
            },
            error: function () {
                layer.msg('出现异常，请重试', {
                    icon: 2
                });
            }
        });
    });
    $("#room_send_button_continue").click(function () {
        $("#room_send_file").val("");
        $("#room_send_button_confirm").addClass("layui-hide");
        $("#room_send_file_info").addClass("layui-hide");
        $("#room_choose").removeClass("layui-hide");
        $("#room_send").addClass("layui-hide");
    });
    $("#room_send_button").click(function () {
        $("#room_send_file").change(function () {
            $("#room_send_button_confirm").removeClass("layui-hide");
            $("#room_send_file_info").removeClass("layui-hide");
            file = $("#room_send_file")[0].files[0];
            filename = file.name;
            if (filename.length > 11) {
                filename = filename.substr(0, 11) + "…";
            }
            size = (file.size / (1024 * 1024)).toFixed(2);
            $("#room_send_file_name").html(filename);
            $("#room_send_file_size").html(size);
            upload_lock = true;
        })
        $("#room_send_file").click();
    });
    $(".room_logout").click(function () {
        logout = layer.msg("正在退出，请稍等", {
            time: 0,
            icon: 16,
            shade: 0.3,
            shadeClose: false
        });
        $.getJSON("/public/api/room_logout.php", function (res) {
            if (res.code == 200) {
                layer.close(logout);
                layer.msg(res.tip, {
                    icon: 1,
                    shade: 0.3,
                    time: 2000,
                    end: function () {
                        room_reset();
                    }
                });
            } else {
                layer.close(logout);
                layer.msg(res.tip, {
                    icon: 2,
                    shade: 0.3,
                    time: 2000
                });
            }
            try {
                clearInterval(statetime);
            } catch { }
            try {
                clearInterval(room_receive_time);
            } catch { }
            upload_lock = false;
        });
    });
});

function room_reset() {
    $("#room_send_connected").addClass("layui-hide");
    $("#room_send").addClass("layui-hide");
    $("#room_send_file").addClass("layui-hide");
    $("#room_send_file_info").addClass("layui-hide");
    $("#room_send_sending").addClass("layui-hide");
    $("#room_send_finish").addClass("layui-hide");
    $("#room_receive").addClass("layui-hide");
    $("#room_receive_finish").addClass("layui-hide");
    $("#room_info").addClass("layui-hide");
    $("#room_choose").addClass("layui-hide");
    $("#room_input").removeClass("layui-hide");
    $("#room_send_button").removeClass("layui-hide");
    $("#room_roomid").html("");
    $("#room_state").html("");
    $("#room_type").html("");
    $("#room_send_file_size").html("");
    $("#room-qrcode").html('');
    $("#room_send_file_name").html("");
    $("#room_send_file").val("");
    try {
        clearInterval(statetime);
    } catch { }
    try {
        clearInterval(room_receive_time);
    } catch { }
    upload_lock = false;
    layui.use(function () {
        element = layui.element;
        element.progress("room_progress", 0);
        element.progress("room_receive_progress", 0);
    });
}


function room_upload(index) {
    if (upload_lock) {
        layui.use(function () {
            layer = layui.layer
            element = layui.element
            if (index == 0) {
                data_check()
                layer.msg("正在发送…", {
                    icon: 16,
                    time: 3000,
                    shade: 0.3
                })
            }
            sliceSize = (1024 * 1024) * 0.5; //切片0.5M
            xhr = new XMLHttpRequest();
            const file = $("#room_send_file")[0].files[0]
            const name = file.name
            const size = file.size
            const total = Math.ceil(size / sliceSize)
            start = index * sliceSize
            end = start + sliceSize
            if (start >= size) {
                data_check()
                $("#room_send_connected").addClass("layui-hide")
                $("#room_send_sending").addClass("layui-hide")
                $("#room_send_finish").removeClass("layui-hide")
                layer.msg("直传成功", {
                    icon: 1,
                    shade: 0.3,
                    time: 2000
                })
                return true
            }
            if (end >= size) {
                end = size
            }
            progress = Number((end / size).toFixed(2)) * 100 + "%"
            blob = file.slice(start, end)
            sliced = new File([blob], index + name)
            form = new FormData()
            form.append("file", sliced)
            form.append("index", index + 1)
            form.append("total", total)
            form.append("size", size)
            form.append("origin", name)
            xhr.open("post", "/public/api/room_upload.php", true) //发送请求
            xhr.send(form) //携带集合    
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    element.progress("room_progress", progress)
                    room_upload(index + 1);
                }
            };
        })
    }
}
function data_check() {
    $.getJSON("/public/api/room_info.php", function (data) {
        $("#room_roomid").html(data.roomid);
        if (data.type == "send") {
            mytype = "发送端"
        } else if (data.type == "receive") {
            mytype = "接收端"
        } else {
            mytype = "神秘人"
        }
        if (data.type == "send") {
            if (data.state != $("#room_state").html() && $("#if_notify_box").prop("checked")) { //需要提醒
                if (data.state == "waiting") {
                    send_notification("正在等待接收端加入……");
                } else if (data.state == "connected") {
                    send_notification("接收端加入啦！可以开始发送文件了");
                } else if (data.state == "sending") {
                    send_notification("正在努力发送文件!");
                } else if (data.state == "send-finish") {
                    send_notification("文件发送完啦");
                } else if (data.state == "finish") {
                    send_notification("文件接收完成！")
                }
            }
            if (data.state == "connected") {
                $("#room_send_connected").removeClass("layui-hide")
                $("#room_send_finish").addClass("layui-hide")
                $("#room_send_sending").addClass("layui-hide")
            } else if (data.state == "sending") {
                $("#room_send_finish").addClass("layui-hide")
                $("#room_send_connected").addClass("layui-hide")
                $("#room_send_sending").removeClass("layui-hide")
            } else if (data.state == "send-finish" || data.state == "finish") {
                $("#room_send_connected").addClass("layui-hide")
                $("#room_send_sending").addClass("layui-hide")
                $("#room_send_finish").removeClass("layui-hide")
            }
        } else if (data.type == "receive") {
            if (data.state != $("#room_state").html() && $("#if_notify_box").prop("checked")) { //需要提醒
                if (data.state == "waiting") {
                    send_notification("正在等待发送端加入……")
                } else if (data.state == "connected") {
                    send_notification("有发送端加入啦！")
                } else if (data.state == "sending") {
                    send_notification("努力接收文件ing……")
                } else if (data.state == "send-finish") { } else if (data.state == "finish") {
                    send_notification("文件接收成功！")
                }
            }
            if (data.state == "connected") {
                $("#room_receive_connected").removeClass("layui-hide")
                $("#room_receive_finish").addClass("layui-hide")
                $("#room_receive_sending").addClass("layui-hide")
                localforage.clear()
            } else if (data.state == "sending") {
                $("#room_receive_finish").addClass("layui-hide")
                $("#room_receive_connected").addClass("layui-hide")
                $("#room_receive_sending").removeClass("layui-hide")
            } else if (data.state == "send-finish") {
                $("#room_receive_connected").addClass("layui-hide")
                $("#room_receive_sending").addClass("layui-hide")
            } else if (data.state == "finish") {
                $("#room_receive_connected").addClass("layui-hide")
                $("#room_receive_sending").addClass("layui-hide")
                $("#room_receive_finish").removeClass("layui-hide")
            }
        }
        $("#room_type").html(mytype);
        $("#room_state").html(data.state);
        $("#room_qrcode").html('');
        $("#room_qrcode").qrcode({
            text:data.qrcode,
            width: 120,
            height: 120,
        });
        room_info = data;
    })
}
function data_check_i() {
    statetime = setInterval(function () { data_check() }, 3000);
}

function room_receive() {
    room_receive_time = setInterval(function () {
        $.getJSON("/public/api/room_download.php", function (data) {
            if (room_info.state == "waiting" || room_info.state == "connected") {
                all_blob = [];
                localforage.clear().then(function () {
                    save_lock = 1;
                }).catch(function (err) {
                    console.log(err)
                })
            } else {
                if (data.code != 100) {
                    data.forEach(function (content, index) {
                        localforage.getItem(String(content.num), function (err, value) {
                            if (value == null) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("GET", content.url, true); //open false 是同步请求，不会异步触发
                                xhr.responseType = 'blob';
                                xhr.onload = function () {
                                    localforage.setItem(String(content.num), xhr.response)
                                    layui.use(function () {
                                        var element = layui.element;
                                        prog = Number((index / content.total).toFixed(2)) * 100 + "%";
                                        element.progress("room_receive_progress", prog);
                                    })
                                };
                                xhr.send();
                            } else {
                                localforage.length().then(function (length) {
                                    if (length == room_info.total) {
                                        function blob_save(index) {
                                            layui.use(function () {
                                                var layer = layui.layer
                                                if (index == "lock") { } else {
                                                    if (index > room_info.total) {
                                                        save_blob = new Blob(all_blob);
                                                        if (window.navigator.msSaveOrOpenBlob) {
                                                            navigator.msSaveBlob(save_blob, room_info.origin);
                                                        } else {
                                                            var link = document.createElement('a');
                                                            var body = document.querySelector('body');
                                                            link.href = window.URL.createObjectURL(save_blob);
                                                            link.download = room_info.origin;
                                                            // fix Firefox 
                                                            link.style.display = 'none';
                                                            body.appendChild(link);
                                                            link.click();
                                                            body.removeChild(link);
                                                            window.URL.revokeObjectURL(link.href);
                                                        };
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "/public/api/room_download.php",
                                                            data: {
                                                                "state": "finish"
                                                            },
                                                            success: function (res) {
                                                                layer.msg("直传完成", {
                                                                    icon: 1,
                                                                    time: 2000,
                                                                    shade: 0.3
                                                                })
                                                                localforage.clear()
                                                                data_check();
                                                            },
                                                            error: function () {
                                                                layer.msg("直传出错", {
                                                                    icon: 2,
                                                                    time: 2000,
                                                                    shade: 0.3
                                                                })
                                                                data_check();
                                                            }
                                                        })
                                                    } else {
                                                        localforage.getItem(String(index)).then(function (value) {
                                                            //all_blob.push(value);
                                                            all_blob[Number(index)] = value
                                                            blob_save(index + 1);
                                                        }).catch(function (err) {
                                                            // 当出错时，此处代码运行
                                                            console.log(err)
                                                        });
                                                    }
                                                }
                                            })
                                        }
                                        blob_save(save_lock)
                                        save_lock = "lock"
                                    }
                                })
                            }
                        })
                    })
                }
            }
        })
    }, 5000)
}