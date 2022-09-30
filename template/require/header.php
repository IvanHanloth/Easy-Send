<?php if($announcement!=""){?>
<script>
    layui.use(function(){
        var layer=layui.layer
        layer.ready(function(){
            layer.alert('公告',{content:'<?php echo $announcement?>'})
        })
    })
</script>
<?php
}
echo $header;

?>