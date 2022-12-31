
<script src="/public/template/get_data/js/default.js"></script>
<link rel="stylesheet" type="text/css" href="/public/template/get_data/css/default.css">
<div id="input">
    <form class="layui-form get_data_default_getbox">
         <div class="layui-form-item layui-anim layui-anim-upbit">
           <input type="text" name="key" lay-verify="get" pattern="/^([a-zA-Z0-9]*)$/" autocomplete="off" placeholder="请输入提取码" id="get-input" value="<?php echo $_REQUEST['key']?>" data-anim="layui-anim-down" class="layui-input get_data_default_get"onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required>
           </div>
          <div class="info">
          <button type="submit" class="layui-btn get_data_default_btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="getbtn" data-anim="layui-anim-down">立即提取</button>
          </div>
    </form>
</div>
<div id="result" class="layui-hide get_data_default_formbox">
    <div class="layui-form-item layui-form-text layui-anim layui-anim-upbit layui-hide" id="result-text">
      <textarea class="layui-textarea get_data_default_textarea" data-anim="layui-anim-down" id="result-value"></textarea>
    </div>
    <div class="layui-form-item layui-anim layui-anim-upbit layui-hide" id="result-file">
        <input type="text" value="" autocomplete="off" id="result-url" class="layui-input get_data_default_get" data-anim="layui-anim-down">
    </div>
    <div class="info layui-hide" id="result-download-btn">
        <a id="result-download" href="" target="_blank">
        <button type="button" class="layui-btn get_data_default_btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" data-anim="layui-anim-down">立即下载</button>
        </a><br>
        <a href="/help.html" target="_blank">
        <button type="button" class="layui-btn get_data_default_btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" data-anim="layui-anim-down">兼容性检测</button>
        </a>
    </div>
    <div class="info" id="result-info" class="layui-hide layui-anim layui-anim-upbit">
        <span>剩余查看次数:</span><span style="color: #FF5722;" id="get-leave-times"></span><br>
        <span>到期时间:</span><span style="color: #FF5722;" id="get-leave-tillday"></span><br><br>
        <button type="button" class="layui-btn get_data_default_btn <?php echo $theme_config["main_css"]?>" onclick="GetContinue()">继续提取</button>
    </div>
</div>
