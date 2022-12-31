        layui.use(['form','jquery'], function () {
        var $ = layui.jquery,
            form = layui.form,
            layer = layui.layer;
        $('.bind-password').on('click', function () {
            if ($(this).hasClass('icon-5')) {
                $(this).removeClass('icon-5');
                $("input[name='password']").attr('type', 'password');
            } else {
                $(this).addClass('icon-5');
                $("input[name='password']").attr('type', 'text');
            }
        });

        // 进行登录操作
        form.on('submit(login)', function (data) {
            data = data.field;
            if (data.account == '') {
                layer.msg('用户名不能为空',{icon: 2});
                return false;
            }
            if (data.password == '') {
                layer.msg('密码不能为空',{icon: 2});
                return false;
            }
                url="/admin/api/login.php";
                type="登录";
                errorcode="u01002";
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    url:url,
                    data:data,
                    success:function(result){
                        if(result.code==200){
                            layer.msg(result.tip,{
                                icon:1,
                                shade:0.3,
                                time:2000,
                                end:function(){
                                    window.location.href="/admin";
                                }
                            })
                        }else{
                            layer.msg(result.tip,{icon: 5,shade:0.3});
                        }
                    },
                    error:function(){
                        layer.msg(type+'失败，请联系客服！错误代码：'+errorcode,{icon: 5});
                    }
                })
            return false;
        });
    });