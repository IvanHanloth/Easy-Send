<?php
/* By Ivan Hanloth
本文件为易传文件上传模板文件
2022/4/3 */
?>
    <link rel="stylesheet" type="text/css" href="/public/template/upload_file/css/drag_upload_box.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qiniu-js/3.4.1/qiniu.min.js"></script>
    <script src="/public/template/upload_file/js/drag_upload_box.js"></script>
  <div class="layui-upload-drag layui-anim layui-anim-upbit upload_file_drag_upload_box_dragbox" id="upload" data-anim="layui-anim-down">
    <div class="info">
      <i class="layui-icon layui-anim layui-anim-upbit <?php echo $theme_config["some_css"]?>" data-anim="layui-anim-down"></i>
      <p class="<?php echo $theme_config["some_css"]?>">点击上传，或将文件拖拽到此处</p>
      <div id="upload-size-info" class="<?php echo $theme_config["some_css"]?>">Loading…</div>
      <div class="layui-hide info" id="upload-progress">
        <div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="progress">
          <div class="layui-progress-bar <?php echo $theme_config["main_css"]?>" lay-percent=""></div>
        </div>
      </div>
    </div>
    <p id="local-info" class="<?php echo $theme_config["some_css"]?>"></p>
  </div>
  <div class="layui-hide info" id="upload-info">
    <div id="file-info" class="info layui-hide layui-anim layui-anim-upbit">
        <img id="file-qrcode" class="qrcode" src="/public/template/public/img/placeholder.svg"><br>
        <span class="code" id="file-code"></span><br>
        <span>剩余查看次数:</span><span style="color:  var(--some_color);" id="file-leave-times"></span><br>
        <span>到期时间:</span><span style="color:  var(--some_color);" id="file-leave-tillday"></span><br><br>
        <button type="button" class="layui-btn upload_file_drag_upload_box_btn <?php echo $theme_config["main_css"]?>" onclick="FileContinue()">继续上传</button>
    </div>
    <form class="layui-form" style="max-width:500px;margin:auto">
  <div class="layui-form-item layui-hide layui-anim layui-anim-upbit"  id="file_times_selector_box">
    <label class="layui-form-label">提取次数</label>
    <div class="layui-input-block">
      <input type="number" class="layui-input" min="1" id="file_times_selector" placeholder="请输入文件可提取次数">
    </div>
    
  </div>  
  <div class="layui-form-item layui-hide layui-anim layui-anim-upbit" id="file_tillday_selector_box" >
    <label class="layui-form-label">到期时间</label>
    <div class="layui-input-block">
        <input type="text" class="layui-input" id="file_tillday_selector" placeholder="请选择文件到期时间">
    </div>
  </div>
  </form>
  
    <Br>
    <div id="reload-tip" class="layui-hide">
        <button type="button" class="layui-btn upload_file_drag_upload_box_btn <?php echo $theme_config["main_css"]?>" id="reload">重新上传</button>
    </div>
    <button type="button" class="layui-btn upload_file_drag_upload_box_btn <?php echo $theme_config["main_css"]?>" id="upload-Action">开始上传</button>
    <button type="button" class="layui-btn upload_file_drag_upload_box_btn <?php echo $theme_config["main_css"]?> layui-hide" id="upload-Action-cheat"></button>
    </div>
    <script>
layui.use( function(){
  var laydate = layui.laydate;
  laydate.render({
    elem: '#file_tillday_selector',
    type:"datetime",
    formate:"yyyy-MM-dd HH:mm:ss",
    max:<?php echo $limit_num_tillday?>,
    theme:"<?php echo $theme_config["main_color"]?>"
  });
});
</script>
