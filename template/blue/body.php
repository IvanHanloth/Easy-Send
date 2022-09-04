<h1>
    <img src="<?php echo $header?>" width="120" height="120"/></h1>
<p id="name"class="web-font"> <?php echo $webname?> </p>
<P id="des">简约跨平台数据传输</P>
  <!-- 操作功能按钮 -->
  <div id="button">
    <button id="file-tab"class="button tab-b">文件传输</button>
    <button id="text-tab" class="button tab-b">文本传输</button>
    <button id="get-tab" class="button button2 tab-w">数据提取</button>
  </div>
  
  <!-- 文件面板 -->
  <div id="file_panel" class="panel">
    <p class="panel_title">文件传输</p>

        <?php include"file.php"?>
    <b class="close"><span style="font-size: 20px;" class="iconfont icon-close_cricle"></span></b>
  </div>  
  <!-- 文件面板 -->
  <div id="text_panel" class="panel">
    <p class="panel_title">文本传输</p>

        <?php include"text.php"?>
    <b class="close"><span style="font-size: 20px;" class="iconfont icon-close_cricle"></span></b>
  </div>  
  <!-- 提取面板 -->
  <div id="get_panel" class="panel">
    <p class="panel_title">数据提取</p>

        <?php include"get.php"?>
    <b class="close"><span style="font-size: 20px;" class="iconfont icon-close_cricle"></span></b>
  </div>
  <!-- 全局蒙版遮罩 -->
  <div id="fixed"></div>