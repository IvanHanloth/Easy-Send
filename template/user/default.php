<script src="/public/template/user/js/default.js"></script>
<link rel="stylesheet" type="text/css" href="/public/template/user/css/default.css">		
<div id="user_loading" style="text-align:center">
    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    <h4>Loading...</h4>
</div>
<div id="user_input" class="layui-hide">
		<table id="user_login_table">
			<td>
	<form class="layui-form user_log_box" user_log_type="login" id="user_log" action="">
		<div class="layui-form-item layui-anim layui-anim-upbit">
			<input type="text" name="account" placeholder="请输入账号或邮箱" class="layui-input user_default_get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required id="user_account_input">
		</div>
		<div class="layui-form-item layui-anim layui-anim-upbit">
			<input type="password" name="password" placeholder="请输入密码" class="layui-input user_default_get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required id="user_password_input">
		</div>
		<div style="display:none" id="user_register_info_input">
    		<div class="layui-form-item layui-anim layui-anim-upbit">
    			<input type="password" name="repassword" placeholder="请再次输入密码" autocomplete="off" class="layui-input user_default_get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;"  id="user_repassword_input">
    		</div>		
    		<div class="layui-form-item layui-anim layui-anim-upbit">
    			<input type="email" name="mail" placeholder="请输入邮箱" autocomplete="off" class="layui-input user_default_get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" id="user_mail_input">
    		</div>
		</div>
		<div class="info">
	<div class="layui-form-item">
			<button type="submit" class="layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" id="user_log_button">立即登录</button>
			<button type="button" class="layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" id="user_change_mode">前往注册</button>
			</div>
		</div>
	</form>
	</td>
	</table>
</div>
<div id="user_menu" class="layui-hide layui-anim layui-anim-upbit">
    <div class="user_center_main_box_up layui-row <?php echo $theme_config["main_css"]?>">
        <div class="user_photo_div">
        <img src="/public/template/public/img/user_profile.png"  class="user_photo" width="500px" height="500px">
        </div>
        <div class="user_name_box">
            <div class="user_name">
                UID：<span class="user_info_uid"> - </span><br>
                账号：<span class="user_info_account"> - </span><br>
                邮箱：<span class="user_info_mail"> - </span>
            </div>
        </div>
        <div class="user_info">
            <span><li class="user_data user_info_file">-</li>文件总数</span>&nbsp;&nbsp;
            <span><li class="user_data user_info_text">-</li>文本总数</span>&nbsp;&nbsp;
            <span><li class="user_data user_info_send">-</li>正在发送</span>&nbsp;&nbsp;
            <span><li class="user_data user_info_receive">-</li>正在接收</span>&nbsp;&nbsp;
            <span class="fa fa-refresh user_refresh"></span>&nbsp;&nbsp;
        </div>
    </div> 
    <div class="user_center_main_box_down">
        <ul class="user_menu">
            <li id="user_menu_info_edit"><span class="fa fa-pencil-square-o"></span>编辑用户资料<span class="layui-icon">&#xe602;</span></li>
            <li id="user_menu_my_file"><span class="fa fa-file-o"></span>我的文件<span class="layui-icon">&#xe602;</span></li>
            <li id="user_menu_my_text"><span class="fa fa-file-text-o"></span>我的文本<span class="layui-icon">&#xe602;</span></li>
            <li id="user_menu_my_send"><span class="fa fa-send-o"></span>我的直传<span class="layui-icon">&#xe602;</span></li>
            <li id="user_sign_out"><span class="fa fa-sign-out"></span>退出登录<span class="layui-icon">&#xe602;</span></li>
        </ul>
    </div>
</div>
<div class="layui-hide layui-anim layui-anim-upbit" id="user_center_main_box">
    <div id="user_center_bar_back" class="user_center_bar">
        <button class="user_center_back_button" type="button"><span class="layui-icon">&#xe603;</span></button>
    </div>
    <div id="user_info_edit" class="layui-hide">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>修改用户资料</legend>
        </fieldset>
        
        <form class="layui-form" action="" lay-filter="user_edit_info_form">
            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-block">
                    <input type="text" name="account" lay-verify="required" autocomplete="off" placeholder="请输入修改后的账号" class="layui-input">
                </div>
            </div>            
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="mail" lay-verify="required" autocomplete="off" placeholder="请输入修改后的邮箱" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">当前密码</label>
                <div class="layui-input-block">
                    <input type="text" name="password" autocomplete="off" placeholder="请输入当前密码（不修改密码请留空）" class="layui-input">
                </div>
            </div>
            
            <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-block">
                    <input type="password" name="newpassword" autocomplete="off" placeholder="请输入新密码（不修改密码请留空）" class="layui-input">
                </div>
            </div>            
            <div class="layui-form-item">
                <label class="layui-form-label">再次输入新密码</label>
                <div class="layui-input-block">
                    <input type="password" name="renewpassword" autocomplete="off" placeholder="请输入新密码（不修改密码请留空）" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="user_edit_info_button">保存设置</button>
                </div>
            </div>
        </form>
    </div>
    <div id="user_my_file" class="layui-hide">
        <div class="user_table_box">
            <table class="layui-hide" id="user_my_file_table" lay-filter="user_my_file_table"></table>
        </div>
    </div>
    <div id="user_my_text" class="layui-hide">
        <div class="user_table_box">
            <table class="layui-hide" id="user_my_text_table" lay-filter="user_my_text_table"></table>
        </div>
    </div>
    <div id="user_my_send" class="layui-hide">
        <div class="user_table_box">
            <table class="layui-hide" id="user_my_room_table" lay-filter="user_my_room_table"></table>
        </div>
    </div>
</div>


<script>
</script>