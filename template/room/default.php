<script src="/public/template/room/js/default.js"></script>
<link rel="stylesheet" type="text/css" href="/public/template/room/css/default.css">
<div id="room_input">
	<form class="layui-form room_default_roombox">
		<div class="layui-form-item layui-anim layui-anim-upbit">
			<input type="text" name="roomid" lay-verify="roomid" autocomplete="off" placeholder="请输入房间号" id="roomid_input" value="<?php echo $_REQUEST['roomid']?>" class="layui-input room_default_get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required>
		</div>
		<div class="layui-form-item layui-anim layui-anim-upbit">
			<input type="text" name="roompassword" lay-verify="roompassword" autocomplete="off" placeholder="请输入房间密码" id="roompassword_input" value="<?php echo $_REQUEST['roompassword']?>" class="layui-input room_default_get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required>
		</div>
		<div class="info">
			<button type="submit" class="layui-btn room_default_btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="roombtn">立即加入</button><br><br>
			    <span class="layui-icon" style="text-align:center;font-size:10px;cursor: pointer;" id="room_use_tips">&#xe702;&nbsp;&nbsp;<a>文件直传使用方法</a></span>
		</div>
	</form>
</div>
<div id="room_info" style="text-align:center" class="layui-hide">
	<img src="/public/template/public/img/placeholder.svg" class="qrcode" id="room_qrcode">
	<p>房间号：<span id="room_roomid"></span></p>
	<p>房间状态：<span id="room_state"></span></p>
	<p>我的身份：<span id="room_type"></span></p>
	<div id="if_notify" class="layui-hide">
    <input type="checkbox" style="width: 15px;height: 11px;" id="if_notify_box">
    <span>状态变更提醒</span>
    </div>
</div>
<div id="room_choose" class="layui-form layui-hide room_default_formbox" style="text-align:center">
    <div class="layui-form-item">
    	<button type="button" class="layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" id="room_choose_send">发送</button>
    	<button type="button" class="layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" id="room_choose_receive">接收</button>
	</div>
	<div class="layui-form-item">
        <button type="button" class="layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" onclick="window.open('/help.html')">兼容性检测
        </button>
		<button type="button" class="room_logout layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>">退出房间</button>
		</div>
</div>
<div id="room_send" class="layui-hide room_default_formbox" style="text-align:center">
	<div id="room_send_connected" class="layui-hide">
		<button type="button" class="layui-btn <?php echo $theme_config["main_css"]?>" id="room_send_button">选择上传文件</button>
		<input type="file" class="layui-hide" id="room_send_file">
		<div id="room_send_file_info" class="layui-hide">
			<p>文件大小:<span id="room_send_file_size"></span>MB</p>
			<p>文件名称:<span id="room_send_file_name"></span></p>
			<button type="button" onclick="room_upload(0)" class="layui-btn <?php echo $theme_config["main_css"]?>" id="room_send_button_confirm">确定发送</button>
		</div>
	</div>
	<div id="room_send_sending" class="layui-hide">
		<div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="room_progress">
			<div class="layui-progress-bar <?php echo $theme_config["main_css"]?>" lay-percent="" id="room_send_upload_progress"></div>
		</div>
	</div>
	<div id="room_send_finish" class="layui-hide">
		<button type="button" class="layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" id="room_send_button_continue">继续发送</button>
	</div>
	<br>
	<div class="room_logout_box">
		<button type="button" class="room_logout layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>">退出房间</button>
	</div>
</div>
<div id="room_receive" class="layui-hide room_default_formbox" style="text-align:center">
	<div id="room_receive_connected" class="layui-hide">
	    
	</div>
	<div id="room_receive_sending" class="layui-hide">
		<div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="room_receive_progress">
			<div class="layui-progress-bar <?php echo $theme_config["main_css"]?>" lay-percent="" id="room_receive_progress"></div>
		</div>
	</div>
	<div id="room_receive_finish" class="layui-hide" style="text-align:center">
	    本次传输已完成！
	</div>
	<div class="room_logout_box"><br>
		<button type="button" class="room_logout layui-btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>">退出房间</button>
	</div>
</div>

