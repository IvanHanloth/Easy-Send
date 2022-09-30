<script src="/public/template/room/js/default.js"></script>
<div id="room_input">
	<form class="layui-form roombox">
		<div class="layui-form-item layui-anim layui-anim-upbit">
			<input type="text" name="roomid" lay-verify="roomid" autocomplete="off" placeholder="请输入房间号" id="roomid_input" value="<?php echo $_REQUEST['roomid']?>" data-anim="layui-anim-down" class="layui-input get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required>
		</div>
		<div class="layui-form-item layui-anim layui-anim-upbit">
			<input type="text" name="roompassword" lay-verify="roompassword" autocomplete="off" placeholder="请输入房间密码" id="roompassword_input" value="<?php echo $_REQUEST['roompassword']?>" data-anim="layui-anim-down" class="layui-input get" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required>
		</div>
		<div class="info">
			<button type="submit" class="layui-btn btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="roombtn" data-anim="layui-anim-down">立即加入</button>
		</div>
	</form>
</div>
<div id="room_info" style="text-align:center" class="layui-hide">
	<img src="/public/template/public/img/placeholder.svg" class="qrcode" id="room_qrcode">
	<p>房间号：<span id="room_roomid"></span></p>
	<p>房间状态：<span id="room_state"></span></p>
	<p>我的身份：<span id="room_type"></span></p>
</div>
<div id="room_choose" class="layui-hide formbox" style="text-align:center">
	<button type="button" class="layui-btn btn layui-anim layui-anim-upbit <?php echo $theme_config["some_css"]?>" lay-submit="" id="room_choose_send" data-anim="layui-anim-down">发送</button><br>
	<button type="button" class="layui-btn btn layui-anim layui-anim-upbit <?php echo $theme_config["some_css"]?>" lay-submit="" id="room_choose_receive" data-anim="layui-anim-down">接收</button>
</div>
<div id="room_send" class="layui-hide formbox" style="text-align:center">
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
			<div class="layui-progress-bar <?php echo $theme_config["main_css"]?>" lay-percent=""></div>
		</div>
	</div>
	<div id="room_send_finish" class="layui-hide">
		<button type="button" class="layui-btn <?php echo $theme_config["main_css"]?>" id="room_send_button_continue">继续发送</button>
	</div>
</div>
<div id="room_receive" class="layui-hide formbox">
	<div id="room_receive_connected"></div>
	<div id="room_receive_sending"></div>
	<div id="room_receive_finish" class="layui-hide">
	</div>
</div>
