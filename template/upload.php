<?php
/* By Ivan Hanloth
本文件为易传文件上传模板文件
2022/4/3 */
?>
  <div class="layui-upload-drag layui-anim layui-anim-upbit dragbox" id="upload" data-anim="layui-anim-down">
    <div class="info">
      <i class="layui-icon layui-anim layui-anim-upbit" data-anim="layui-anim-down"></i>
      <p>点击上传，或将文件拖拽到此处</p>
      <p>文件最大100MB</p>
      <div class="layui-hide info" id="uploadprogress">
        <div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="progress">
          <p id="tip"></p>
          <div class="layui-progress-bar" lay-percent=""></div>
        </div>
      </div>
    </div>
    <p id="localinfo"></p>
  </div>
  <div class="layui-hide info" id="uploadinfo">
    <div id="fileinfo" class="info"></div>
    <button type="button" class="layui-btn btn" id="uploadAction">开始上传</button></div>