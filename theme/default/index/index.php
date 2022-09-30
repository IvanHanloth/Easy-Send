      <?php tem_require_head()?>
  <body>
        <?php tem_require_header()?>
    <div class="main">
        <div class="layui-tab layui-tab-card" lay-filter="tab">
         <ul class="layui-tab-title">
          <li class="layui-this" lay-id="file">文件转存</li>
          <li lay-id="text">文字转存</li>
          <li lay-id="get">数据提取</li>
          <li lay-id="room">文件直传</li>
         </ul>
         <div class="layui-tab-content" style="height: 330px;">
          <div class="layui-tab-item layui-show">
           <?php
            tem_file_drag_box()
           ?>
          </div>
          <div class="layui-tab-item">
           <?php
            tem_text_textarea()
           ?>
          </div>
          <div class="layui-tab-item">
           <?php
            tem_get_default()
           ?>
          </div>
          <div class="layui-tab-item">
           <?php
            tem_room_default()
           ?>
          </div>
         </div>
        </div>
        </div>
        <footer>
    <?php tem_require_footer()?>      
      <script>
        layui.use(function () {
        	var	element = layui.element;
        	<?php
        	if($_REQUEST["key"]!=""){
        	    echo "element.tabChange('tab', 'get');";
        	}
        	if($_REQUEST["roomid"]!=""){
        	    echo "element.tabChange('tab', 'room');";
        	}
        	
        	?>
                
        });
      </script>
</footer>
  </body>
</html>