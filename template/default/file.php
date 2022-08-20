<?php
/* By Ivan Hanloth
本文件为易传文件上传模板文件
2022/4/3 */
?>
  <div class="layui-upload-drag layui-anim layui-anim-upbit dragbox" id="upload" data-anim="layui-anim-down">
    <div class="info">
      <i class="layui-icon layui-anim layui-anim-upbit" data-anim="layui-anim-down"></i>
      <p>点击上传，或将文件拖拽到此处</p>
      <div id="upload-size-info"></div>
      <div class="layui-hide info" id="upload-progress">
        <div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="progress">
          <div class="layui-progress-bar" lay-percent=""></div>
        </div>
      </div>
    </div>
    <p id="local-info"></p>
  </div>
  <div class="layui-hide info" id="upload-info">
    <div id="file-info" class="info">
    </div>
    <div id="reload-tip"></div>
    <button type="button" class="layui-btn btn" id="upload-Action">开始上传</button></div>