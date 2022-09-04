<?php /*
By Ivan Hanloth
本文件为易传尾部模板文件
2022/9/3
*/
?>

<footer>
    <?php echo $footer;  ?>
</footer>
<?php
if(empty($_REQUEST["key"])==false){
?>
<script>
planecss($("#get_panel"));  //校正样式
$("#get_panel").addClass("layui-show")
$("#fixed").addClass("layui-show")
</script>
<?php } ?>
    <script src="/template/blue/js/main.js"></script>
    <script src="/static/js/function.js"></script>
  </body>
</html>
