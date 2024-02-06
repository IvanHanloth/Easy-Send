<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
tem_require_head() ?>

<body>
  <?php tem_require_header();
  if ($whole_upload == "on") {
    tem_file_drag_whole();
  } ?>

  <!-- <?php if ($if_scan == "on") { ?>
    <span class="scaner_menu_button"><i class="fa fa-qrcode scaner_menu_button_icon"></i></span>
  <?php } ?> -->

  <div class="main-box">
    <div class="quarter-container">
      <div class="quarter-main-box"><?php tem_file_drag_box() ?></div>
    </div>
    <div class="quarter-container">
      <div class="quarter-main-box"><?php tem_text_textarea() ?></div>
    </div>
    <div class="quarter-container">
      <div class="quarter-main-box"><?php tem_room_default() ?></div>
    </div>
    <div class="quarter-container">
      <div class="quarter-main-box"><?php tem_get_default() ?></div>
    </div>
  </div>

  <div class="circle-box" id="logo-box">
    <div>
      <div class="logo">
        <img src="<?php echo $logo ?>" width="80px" height="80px">
      </div>

      <div id="menu-box" style="z-index:-1">

        <div class="quarter-container layui-bg-orange">
            <div class="menu-item-left-top" onclick="window.open('/user')">
              <i class="fa fa-user-o"></i>
            </div>
        </div>
        <div class="quarter-container layui-bg-green">
          <?php if ($if_scan == "on") { ?>
          <div class="menu-item-right-top" onclick="window.open('/code')">
            <i class="fa fa-qrcode"></i>
          </div>
          <?php } ?>
        </div>
        <div class="quarter-container layui-bg-blue">
          <div class="menu-item-left-bottom">

          </div>
        </div>
        <div class="quarter-container layui-bg-red">
          <div class="menu-item-right-bottom">

          </div>
        </div>

      </div>
    </div>
  </div>

  </div>

  <!-- 全局蒙版遮罩 -->
  <div id="shadow" class="layui-hide"></div>
  <footer>
    <?php tem_require_footer() ?>
  </footer>
  <script src="/theme/quarter/static/js/main.js"></script>
</body>

</html>