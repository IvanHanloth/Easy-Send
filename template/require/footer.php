<?php
if($if_gray=="on"){
    echo '<style>
    body{
  -webkit-filter: grayscale(100%);
  -moz-filter: grayscale(100%);
  -ms-filter: grayscale(100%);
  -o-filter: grayscale(100%);
  filter: grayscale(100%);
  filter: gray;}
  </style>';
};
echo $footer;
?>
<style>
  .translateSelectLanguage{
    width:100px;
    border:none;
    background: none;
  }
</style>
<div style="position:fixed;bottom:2px;border: 1px solid;left:2px;border-radius: 2px;padding: 2px;z-index: 9999999999999999999999999;">
<i class="fa fa-globe"></i>
<span id="translate"></span>
</div>
<script src="/public/template/public/js/clipboard.js"></script>
<script>
  layui.extend({
    translate: '{/}https://mail_osc.gitee.io/translate_layui/layui_exts/translate/translate' // {/}的意思即代表采用自有路径，即不跟随 base 路径

})
//使用拓展模块
layui.use(['translate'], function(){
    var translate = layui.translate;
    //当页面加载完后执行翻译操作
    window.onload = function () {
        translate.execute();
        translate.setAutoDiscriminateLocalLanguage();
    };  
    $.getJSON("//ivan.hanloth.cn/api/Easy-Send/statistic.php?action=index",()=>{})
});
</script>