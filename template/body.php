<?php /*
By Ivan Hanloth
本文件为翰络云传模板引用文件
2022/4/3
*/
?>
    <div class="main">
        <div class="layui-tab layui-tab-card" >
         <ul class="layui-tab-title">
          <li class="layui-this">文件传输</li>
          <li>文字传输</li>
          <li>数据提取</li>
         </ul>
         <div class="layui-tab-content" style="height: 275px;">
          <div class="layui-tab-item layui-show">
           <?php
           require "upload.php";
           ?>
          </div>
          <div class="layui-tab-item">
            <?php
           require "text.php";
           ?>
          </div>
          <div class="layui-tab-item">
        <?php require"get.php";?>
          </div>
         </div>
        </div>
        </div>