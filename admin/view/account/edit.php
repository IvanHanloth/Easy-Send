<?php
/*
By Ivan Hanloth
本文件为用户中心框架文件
2022/7/31
*/
session_start();
include dirname(__FILE__) . "/../../../common.php";
if ($_SESSION["admin"] != $admintoken) {
    echo "<script>parent.layui.admin.refreshFrame();</script><script>window.location.href='/admin/login.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../component/pear/css/pear.css" />
    <script src="../../component/layui/layui.js"></script>
    <script src="../../component/pear/pear.js"></script>
</head>

<body class="pear-container">
    <div class="pear-main">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>修改资料</legend>
        </fieldset>
        <form class="layui-form" lay-filter="admin_edit" action="">
            <?php if ($admintoken == "21232f297a57a5a743894a0e4a801fc3ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ=") {
                echo "<div class='layui-input-block'><span style='color:#f00'>您的账户密码未修改，您需要先更改账号密码才能继续使用</span></div>";
            } ?>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员账号</label>
                <div class="layui-input-block">
                    <input type="text" name="adminaccount" lay-verify="required" autocomplete="off" placeholder="请输入新的管理员帐号" class="layui-input" value="<?php echo $adminaccount ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员密码</label>
                <div class="layui-input-block">
                    <input type="text" name="adminpassword" autocomplete="off" placeholder="请输入新的管理员密码(不修改请留空)" class="layui-input" id="enter">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">重复密码</label>
                <div class="layui-input-block">
                    <input type="text" name="adminrepassword" autocomplete="off" placeholder="请重复新的管理员密码(不修改请留空)" class="layui-input" id="reenter">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="pear-btn" lay-submit="" lay-filter="admin_edit">立即提交</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        layui.use(['toast', 'jquery', 'form'], function() {
            var form = layui.form,
                $ = layui.jquery,
                toast = layui.toast;
            form.on('submit(admin_edit)', function(data) {
                if ($("#enter").val() != $("#reenter").val()) {
                    toast.error({
                        message: "两次输入的密码不一致"
                    });
                    return false;
                }
                $.ajax({
                    url: "/admin/api/account/edit.php",
                    type: "POST",
                    data: {
                        adminaccount: data.field.adminaccount,
                        adminpassword: data.field.adminpassword,
                        adminrepassword: data.field.adminrepassword
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            toast.success({
                                message: "修改成功"
                            });
                            setTimeout(function() {
                                parent.layui.admin.refreshFrame();
                            }, 1000);
                        } else {
                            toast.error({
                                message: "修改失败"
                            });
                        }
                    },
                    error: function(data) {
                        toast.error({
                            message: "程序出错"
                        });
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>