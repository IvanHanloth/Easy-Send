<?php
/* By Ivan Hanloth
本文件为易传文本存储模板文件
2022/4/3 */
?>
  <form class="layui-form formbox" action="">
    <div class="layui-form-item layui-form-text layui-anim layui-anim-upbit" id="text">
      <textarea name="text" placeholder="请输入内容" class="layui-textarea textarea" lay-verify="text" data-anim="layui-anim-down"></textarea>
    </div>
    <div class="info" id="text-btn">
      <button type="submit" class="layui-btn btn layui-anim layui-anim-upbit" lay-submit="" lay-filter="save" data-anim="layui-anim-down">立即提交</button></div>
    <div id="text-info" class="info"></div>
  </form>