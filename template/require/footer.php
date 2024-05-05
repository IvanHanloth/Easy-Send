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
<script src="//res.zvo.cn/translate/translate.js"></script>
<script>
translate.language.setLocal('chinese_simplified'); 
translate.service.use('client.edge'); 
translate.execute();
</script>