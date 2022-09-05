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
if($_REQUEST['key']!=""){
?>
<script>
      if(document.body.clientWidth < 600){
        $("#get_panel").attr("style","margin-left:"+parseInt(document.body.clientWidth*0.94)/2*-1+"px")
      }
$("#get_panel").addClass("layui-show")
$("#fixed").addClass("layui-show")
</script>
<?php } ?>
    <script src="/template/blue/js/main.js"></script>
    <script src="/static/js/function.js"></script>
  </body>
</html>
