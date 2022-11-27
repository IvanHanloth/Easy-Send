user_info = "";
$(window).load(function() {
    layui.use(function() {
        var layer = layui.layer;
        var laypage = layui.laypage; 
        var table = layui.table; 
        var form = layui.form;
        //登录提交
        $("#user_log").submit(function() {
            if ($("#user_log").attr("user_log_type") == "login") {
                $.ajax({
                    type: "post",
                    url: "/public/api/user_login.php",
                    data: {
                        "type": "login",
                        "account": $("#user_account_input").val(),
                        "password": $("#user_password_input").val()
                    },
                    success: function(res) {
                        if (res.code == 200) {
                            get_user_info(false);
                            layer.msg(res.tip, {
                                icon: 1,
                                time: 2000,
                                shade: 0.3,
                                end: function() {
                                    $("#user_input").addClass("layui-hide");
                                    $("#user_menu").removeClass("layui-hide");
                                }
                            });
                        } else {
                            layer.msg(res.tip, {
                                icon: 2,
                                time: 2000
                            });
                        }
                    },
                    error: function() {
                        layer.msg('出现异常，请重试', {
                            icon: 2
                        });
                    }
                });
            } else {
                if ($("#user_repassword_input").val() == "" || $("#user_mail_input").val() == "") {
                    layer.msg("必填项不能为空", {
                        icon: 2,
                        time: 2000
                    });
                } else if ($("#user_repassword_input").val() != $("#user_password_input").val()) {
                    layer.msg("两次输入的密码不一致，请重新输入", {
                        icon: 2,
                        time: 2000
                    });
                } else {
                    $.ajax({
                        type: "post",
                        url: "/public/api/user_login.php",
                        data: {
                            "type": "register",
                            "account": $("#user_account_input").val(),
                            "password": $("#user_password_input").val(),
                            "mail": $("#user_mail_input").val()
                        },
                        success: function(res) {
                            if (res.code == 200) {
                                get_user_info(false);
                                layer.msg(res.tip, {
                                    icon: 1,
                                    time: 2000,
                                    shade: 0.3,
                                    end: function() {
                                        $("#user_input").addClass("layui-hide");
                                        $("#user_menu").removeClass("layui-hide");
                                    }
                                });
                            } else {
                                layer.msg(res.tip, {
                                    icon: 2,
                                    time: 2000
                                });
                            }
                        },
                        error: function() {
                            layer.msg('出现异常，请重试', {
                                icon: 2
                            });
                        }
                    });

                }
            }
            return false;
        });
        //切换模式
        $("#user_change_mode").click(function() {
            if ($("#user_log").attr("user_log_type") == "login") {
                $("#user_register_info_input").slideDown();
                $("#user_log_button").html("立即注册");
                $("#user_change_mode").html("前往登录");
                $("#user_log").attr("user_log_type", "register");
            } else {
                $("#user_register_info_input").slideUp();
                $("#user_log_button").html("立即登录");
                $("#user_change_mode").html("前往注册");
                $("#user_log").attr("user_log_type", "login");
            }
        });

        $(".user_refresh").click(function() {
            $(".user_refresh").css("animation-name", "refresh");
            $(".user_refresh").css("animation-duration", "3s");
            $(".user_refresh").css("animation-timing-function", "linear");
            $(".user_data").html("-");
            setTimeout(function() {
                get_user_info(false);
            }, 1500);
            setTimeout(function() {
                $(".user_refresh").css("animation-name", "");
                $(".user_refresh").css("animation-duration", "");
                $(".user_refresh").css("animation-timing-function", "");
            }, 3000);
        });
        get_user_info(true);


        table.render({
            elem: '#user_my_file_table',
            url: '/public/api/user_file_get.php' //数据接口（此处为静态数据，仅作演示）
                ,
            page: true //开启分页
                ,
            height: 500,
            skin: "line",
            cols: [
                [ //表头
                    {
                        field: 'gkey',
                        title: '提取码',
                        align: 'center'
                    }, {
                        field: 'tillday',
                        title: '到期时间',
                        align: 'center'
                    }, {
                        field: 'origin',
                        title: '文件名',
                        align: 'center'
                    }, {
                        field: 'times',
                        title: '剩余次数',
                        align: 'center'
                    }
                ]
            ]
        });
        table.render({
            elem: '#user_my_text_table',
            url: '/public/api/user_text_get.php' //数据接口（此处为静态数据，仅作演示）
                ,
            page: true //开启分页
                ,
            height: 500,
            skin: "line",
            cols: [
                [ //表头
                    {
                        field: 'gkey',
                        title: '提取码',
                        align: 'center'
                    }, {
                        field: 'tillday',
                        title: '到期时间',
                        align: 'center'
                    }, {
                        field: 'preview',
                        title: '文本预览',
                        align: 'center'
                    }, {
                        field: 'times',
                        title: '剩余次数',
                        align: 'center'
                    }
                ]
            ]
        });
        table.render({
            elem: '#user_my_room_table',
            url: '/public/api/user_room_get.php' //数据接口（此处为静态数据，仅作演示）
                ,
            page: true //开启分页
                ,
            height: 600,
            skin: "line",
            cols: [
                [ //表头
                    {
                        field: 'roomid',
                        title: '房间号',
                        align: 'center'
                    }, {
                        field: 'roompassword',
                        title: '房间密码',
                        align: 'center'
                    }, {
                        field: 'senduid',
                        title: '发送者',
                        align: 'center'
                    }, {
                        field: 'receiveuid',
                        title: '接收者',
                        align: 'center'
                    }, {
                        field: 'state',
                        title: '状态',
                        align: 'center'
                    }
                ]
            ]
        });

        $("#user_sign_out").click(function() {
            document.cookie = "usertoken=''";
            layer.msg("退出登录成功", {
                time: 2000,
                end: function() {
                    user_reset("log");
                }
            });

        });
        $("#user_menu_info_edit").click(function() {
            $("#user_info_edit").removeClass("layui-hide");
            $("#user_center_main_box").removeClass("layui-hide");
            $("#user_menu").addClass("layui-hide");
        });
        $("#user_menu_my_file").click(function() {
            $("#user_my_file").removeClass("layui-hide");
            $("#user_center_main_box").removeClass("layui-hide");
            $("#user_menu").addClass("layui-hide");
            table.reload('user_my_file_table');
        });
        $("#user_menu_my_text").click(function() {
            $("#user_my_text").removeClass("layui-hide");
            $("#user_center_main_box").removeClass("layui-hide");
            $("#user_menu").addClass("layui-hide");
            table.reload('user_my_text_table');
        });
        $("#user_menu_my_send").click(function() {
            $("#user_my_send").removeClass("layui-hide");
            $("#user_center_main_box").removeClass("layui-hide");
            $("#user_menu").addClass("layui-hide");
            table.reload('user_my_room_table');
        });
        $(".user_center_back_button").click(function() {
            user_reset("menu");
        });
    
        
            $.getJSON("/public/api/user_edit_get.php",function(res){
                form.val('user_edit_info_form',res)
            })
        //监听提交
        form.on('submit(user_edit_info_button)', function (data) {
            $.ajax({
    			type: "POST",
    			url: '/public/api/user_edit_save.php',
    			dataType: 'json',
    			async: false,
    			data:{"data":JSON.stringify(data.field)},
    			success:function(res){
    			    if(res.code==200){
        			    layer.msg(res.tip,{
        			        icon:1,
        			        time:2000,
        			        shade:0.3,
        			        end:function(){
        			            get_user_info(true);
        			        }
        			    })
    			    }else{
        			    layer.msg(res.tip,{
        			        icon:2,
        			        time:2000,
        			        shade:0.3
        			    })
    			        
    			    }
    			},
    			error:function(res){
    			    layer.msg("程度运行出错",{
    			        icon:2,
    			        time:2000,
    			        shade:0.3
    			    })
    			}
            })
            return false;
        });
    });


});

function get_user_info(reset) {
    $.getJSON("/public/api/user_info.php", function(data) {
        user_info = data;
        $(".user_info_account").html(user_info.account);
        $(".user_info_uid").html(user_info.uid);
        $(".user_info_mail").html(user_info.mail);
        $(".user_info_file").html(user_info.file_num);
        $(".user_info_text").html(user_info.text_num);
        $(".user_info_send").html(user_info.send_num);
        $(".user_info_receive").html(user_info.receive_num);
        if (data.account == "" || data.code == 100) {
            user_reset("log");
        } else {
            if (reset) {
                user_reset("menu");
            }
        }
    });
}

function user_reset(mode) {
    if (mode == "log") {
        $("#user_register_info_input").slideUp();
        $("#user_log_button").html("立即登录");
        $("#user_change_mode").html("前往注册");
        $("#user_log").attr("user_log_type", "login");
        $("#user_input").removeClass("layui-hide");
        $("#user_menu").addClass("layui-hide");
        $("#user_my_send").addClass("layui-hide");
        $("#user_my_text").addClass("layui-hide");
        $("#user_my_file").addClass("layui-hide");
        $("#user_info_edit").addClass("layui-hide");
        $("#user_center_main_box").addClass("layui-hide");
    } else if (mode == "menu") {
        $("#user_input").addClass("layui-hide");
        $("#user_menu").removeClass("layui-hide");
        $("#user_my_send").addClass("layui-hide");
        $("#user_my_text").addClass("layui-hide");
        $("#user_my_file").addClass("layui-hide");
        $("#user_info_edit").addClass("layui-hide");
        $("#user_center_main_box").addClass("layui-hide");
    }
}