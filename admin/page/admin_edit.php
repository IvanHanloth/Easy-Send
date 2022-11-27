<?php
/*
By Ivan Hanloth
本文件为用户中心框架文件
2022/7/31
*/
session_start();
include dirname(__FILE__)."/../../common.php";
if($_SESSION["admin"]!=$admintoken){
    echo "<script>window.location.href='/admin/page/login.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $webname?> - 后台管理</title>    
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="../../public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="../lib/layui-v2.6.3/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">    
    <link rel="stylesheet" href="../lib/jq-module/zyupload/zyupload-1.0.0.min.css" media="all">
    <script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script src="../lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
    
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>修改资料</legend>
        </fieldset>
<?php if($admintoken=="21232f297a57a5a743894a0e4a801fc3ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ="){
    echo "<span style='color:#f00'>您的账户密码未修改，您需要先更改账号密码才能继续使用</span>";
} ?>
        <form class="layui-form" action="" lay-filter="admin_edit">
            <div class="layui-form-item">
                <label class="layui-form-label">管理员账号</label>
                <div class="layui-input-block">
                    <input type="text" name="adminaccount" lay-verify="required" autocomplete="off" placeholder="请输入新的管理员帐号" class="layui-input" value="<?php echo $adminaccount?>">
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
                    <button class="layui-btn" lay-submit="" lay-filter="admin_edit">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form'], function () {
        var form = layui.form
            , layer = layui.layer
        //监听提交
        form.on('submit(admin_edit)', function (data) {
            if($("#enter").val()!=$("#reenter").val()){
                layer.msg("两次输入的密码不一样",{icon:2,time:2000,shade:0.3})
            }else{
                $.ajax({
        			type: "POST",
        			url: '/admin/api/admin_edit.php',
        			dataType: 'json',
        			async: true,
        			data:{"data":JSON.stringify(data.field)},
        			success:function(res){
        			    if(res.code==200){
        			        icon=1
        			    }else{
        			        icon=2
        			    }
        			    layer.msg(res.tip,{
        			        icon:icon,
        			        time:2000,
        			        shade:0.3,
        			        end:function(){
        			            if(icon==1){
        			                window.loaction.reload()
        			            }
        			        }
        			    })
        			},
        			error:function(res){
    			    layer.msg("程序运行出错",{
    			        icon:2,
    			        time:2000,
    			        shade:0.3
    			    })
        			}
                })
                return false;
                    
            }
        });

    });
</script>

</body>
</html>