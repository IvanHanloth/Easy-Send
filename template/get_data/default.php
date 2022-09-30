<?php /*
By Ivan Hanloth
本文件为易传文件提取模板文件
2022/4/3
*/
?>
    <script src="/public/template/get_data/js/default.js"></script>
<div id="input">
    <form class="layui-form getbox">
         <div class="layui-form-item layui-anim layui-anim-upbit">
           <input type="text" name="key" lay-verify="get" pattern="/^[a-zA-Z0-9]{4}$/" autocomplete="off" placeholder="请输入4位提取码" id="get-input" value="<?php echo $_REQUEST['key']?>" data-anim="layui-anim-down" class="layui-input get"onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required>
           </div>
          <div class="info">
          <button type="submit" class="layui-btn btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="getbtn" data-anim="layui-anim-down">立即提取</button>
          </div>
    </form>
</div>
<div id="result" class="layui-hide formbox">
    <div class="layui-form-item layui-form-text layui-anim layui-anim-upbit layui-hide" id="result-text">
      <textarea class="layui-textarea textarea" data-anim="layui-anim-down" id="result-value"></textarea>
    </div>
    <div class="layui-form-item layui-anim layui-anim-upbit layui-hide" id="result-file">
        <input type="text" value="" autocomplete="off" id="result-url" class="layui-input get" data-anim="layui-anim-down">
    </div>
    <div class="info layui-hide" id="result-download-btn">
        <a id="result-download" href="" target="_blank">
        <button type="button" class="layui-btn btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" data-anim="layui-anim-down">立即下载</button>
        </a>
    </div>
    <div class="info" id="result-info" class="layui-hide">
        <span>剩余查看次数:</span><span style="color: #FF5722;" id="get-leave-times"></span><br>
        <span>到期时间:</span><span style="color: #FF5722;" id="get-leave-tillday"></span><br><br>
        <button type="button" class="layui-btn btn" class="layui-hide <?php echo $theme_config["main_css"]?>" onclick="GetContinue()">继续提取</button>
    </div>
</div>