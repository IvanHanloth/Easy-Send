<?php
/* By Ivan Hanloth
本文件为易传文件上传模板文件
2022/4/3 */
?>
    <script src="/public/template/upload_file/js/drag_upload_box.js"></script>
  <div class="layui-upload-drag layui-anim layui-anim-upbit dragbox" id="upload" data-anim="layui-anim-down">
    <div class="info">
      <i class="layui-icon layui-anim layui-anim-upbit <?php echo $theme_config["some_css"]?>" data-anim="layui-anim-down"></i>
      <p>点击上传，或将文件拖拽到此处</p>
      <div id="upload-size-info">Loading…</div>
      <div class="layui-hide info" id="upload-progress">
        <div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="progress">
          <div class="layui-progress-bar <?php echo $theme_config["main_css"]?>" lay-percent=""></div>
        </div>
      </div>
    </div>
    <p id="local-info"></p>
  </div>
  <div class="layui-hide info" id="upload-info">
    <div id="file-info" class="info layui-hide">
        <img id="file-qrcode" class="qrcode" src="/public/template/public/img/placeholder.svg"><br>
        <span class="code" id="file-code"></span><br>
        <span>剩余查看次数:</span><span style="color: #FF5722;" id="file-leave-times"></span><br>
        <span>到期时间:</span><span style="color: #FF5722;" id="file-leave-tillday"></span><br><br>
        <button type="button" class="layui-btn btn <?php echo $theme_config["main_css"]?>" class="layui-hide" onclick="FileContinue()">继续上传</button>
    </div>
    <div id="reload-tip" class="layui-hide">
        <button type="button" class="layui-btn btn <?php echo $theme_config["main_css"]?>" id="reload">重新上传</button>
    </div>
    <button type="button" class="layui-btn btn <?php echo $theme_config["main_css"]?>" id="upload-Action">开始上传</button></div>