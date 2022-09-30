<?php
/* By Ivan Hanloth
本文件为易传文本存储模板文件
2022/4/3 */
?>
    <style>  .textarea::-webkit-scrollbar {
  /*滚动条整体样式*/
  width : 8px;  /*高宽分别对应横竖滚动条的尺寸*/
  height: 1px;
  }
  .textarea::-webkit-scrollbar-thumb {
  /*滚动条里面小方块*/
  border-radius   : 8px;
  background-color: <?php echo $theme_config["main_color"]?>;
  background-image: -webkit-linear-gradient(
      45deg,
      <?php echo $theme_config["some_color"]?> 10%,
      transparent 10%,
      transparent 30%,
      <?php echo $theme_config["some_color"]?> 30%,
    
      <?php echo $theme_config["some_color"]?> 50%,
      transparent 50%,
      transparent 70%,
      <?php echo $theme_config["some_color"]?> 70%,
    
      <?php echo $theme_config["some_color"]?> 90%,
      transparent 90%,
      transparent 100%,
      <?php echo $theme_config["some_color"]?> 100%,
      transparent
  );
  }</style>
    <script src="/public/template/upload_text/js/textarea.js"></script>
  
  <form class="layui-form formbox" action="">
    <div class="layui-form-item layui-form-text layui-anim layui-anim-upbit" id="text">
      <textarea name="text" placeholder="请输入内容" class="layui-textarea textarea" lay-verify="text" data-anim="layui-anim-down" id="text-textarea"></textarea>
    </div>
    <div class="info" id="text-btn">
      <button type="submit" class="layui-btn btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>" lay-submit="" lay-filter="save" data-anim="layui-anim-down">立即提交</button></div>
    <div id="text-info" class="info layui-hide">
        <img id="text-qrcode" class="qrcode" src="/public/template/public/img/placeholder.svg"><br>
        <span class="code" id="text-code"></span><br>
        <span>剩余查看次数:</span><span style="color: #FF5722;" id="text-leave-times"></span><br>
        <span>到期时间:</span><span style="color: #FF5722;" id="text-leave-tillday"></span><br><br>
        <button type="button" class="layui-btn btn <?php echo $theme_config["main_css"]?>" class="layui-hide" onclick="TextContinue()">继续上传</button>
    </div>
  </form>