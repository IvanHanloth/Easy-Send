<?php
/* By Ivan Hanloth
本文件为易传文本存储模板文件
2022/4/3 */
?><link rel="stylesheet" type="text/css" href="/public/template/upload_text/css/textarea.css">
    <script src="/public/template/upload_text/js/textarea.js"></script>
  
  <form class="layui-form upload_text_textarea_formbox" action="">
    <div class="layui-form-item layui-form-text layui-anim layui-anim-upbit" id="text">
      <textarea name="text" placeholder="请输入内容" class="layui-textarea upload_text_textarea_textarea" lay-verify="text" data-anim="layui-anim-down" id="text-textarea"></textarea>
    </div>
    <div class="info" id="text-btn">    
    <div style="max-width:500px;margin:auto">
  <div class="layui-form-item layui-hide layui-anim layui-anim-upbit"  id="text_times_selector_box">
    <label class="layui-form-label">提取次数</label>
    <div class="layui-input-block">
      <input type="number" class="layui-input" min="1" id="text_times_selector" name="times" placeholder="请输入文本可提取次数">
    </div>
    
  </div>  
  <div class="layui-form-item layui-hide layui-anim layui-anim-upbit" id="text_tillday_selector_box" >
    <label class="layui-form-label">到期时间</label>
    <div class="layui-input-block">
        <input type="text" class="layui-input" id="text_tillday_selector" name="tillday" placeholder="请选择文本到期时间">
    </div>
  </div>
  </div>
      <button type="submit" class="layui-btn upload_text_textarea_btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="save" data-anim="layui-anim-down">立即提交</button></div>
    <div id="text-info" class="info layui-hide layui-anim layui-anim-upbit">
        <img id="text-qrcode" class="qrcode" src="/public/template/public/img/placeholder.svg"><br>
        <span class="code" id="text-code"></span><br>
        <span>剩余查看次数:</span><span style="color:  var(--some_color);" id="text-leave-times"></span><br>
        <span>到期时间:</span><span style="color:  var(--some_color);" id="text-leave-tillday"></span><br><br>
        <button type="button" class="layui-btn upload_text_textarea_btn <?php echo $theme_config["main_css"]?>" onclick="TextContinue()">继续上传</button>
    </div>
  </form>
  
    <script>
layui.use( function(){
  var laydate = layui.laydate;
  laydate.render({
    elem: '#text_tillday_selector',
    type:"datetime",
    formate:"yyyy-MM-dd HH:mm:ss",
    max:<?php echo $limit_num_tillday?>,
    theme:"<?php echo $theme_config["main_color"]?>"
  });
});
</script>
