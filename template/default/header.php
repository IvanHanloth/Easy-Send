<?php /*
By Ivan Hanloth
本文件为易传头部模板文件
2022/4/3
*/
?><!Doctype html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>
    </title>
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/template/default/css/main.css">
    <link rel="stylesheet" type="text/css" href="/static/css/scrollbar.css">
    <script src="/static/js/jquery2.2.4.min.js"></script>
    <script src="/static/layui/layui.js"></script>
    <script src="/static/js/main.js"></script>
    <script src="/static/js/function.js"></script>
  </head>
  <body>
      <?php if($_REQUEST['key']!=""){//传入了key?>
      <script>
        layui.use(function () {
        	var	element = layui.element;
            element.tabChange('tab', 'get');
        });
      </script><?php
      }; ?>
        <?php echo $header?>
