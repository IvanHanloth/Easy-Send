<?php
/* By Ivan Hanloth
本文件为易传文本存储模板文件
2022/4/3 */
?><link rel="stylesheet" type="text/css" href="/public/template/scan/css/default.css">	
  
  <form class="layui-form scan_default_formbox">
    <div class="layui-form-item layui-form-text layui-anim layui-anim-upbit">
        <div style="text-align:center"><h2><strong>扫码功能使用说明</strong></h2><br></div>
      <textarea class="layui-textarea scan_default_textarea" disabled style="font-size:14px">
          欢迎使用“扫码”功能！使用此功能前请先认真阅读以下使用说明以便您能了解此功能以及所涉及到的相关问题。
          “扫码”功能用于二维码（不包括一维码）扫描及对应内容的解析。
          如果二维码内容为网址，则我们将在解析成功后直接跳转至该网址，否则将会通过弹窗的形式告知您二维码的内容。
          此功能基于浏览器提供的调用摄像头的接口实现，这意味着如果您的浏览器不提供该接口或您的设备没有安装可供调用的摄像头则您无法使用此功能。
          使用此功能需要调用您设备中的摄像头进行二维码的捕获及解析，该操作可能涉及您的隐私。秉持保护用户个人隐私的原则，我们在此公布使用到的开源技术库：jquery.js、jsQR.js、qrcode.js。
          使用此功能需要您的授权，如果您的浏览器支持使用“扫码”功能，则点击“开始扫码”后，浏览器可能会弹出调用摄像头的授权框，您需要点击授权后才能正常使用扫码功能。
          我们承诺通过https协议进行数据传输，以保证数据传输的安全性。
          我们承诺不会保留扫码过程中摄像头即时展示的画面，并且不会保留每次扫码的结果以确保您隐私的安全，但同时我们也不保证您所扫描的二维码所连接到的网址的安全性及可访问性，这意味着我们仅提供二维码扫描及解析服务但并不对扫码后的结果负责。
      </textarea>
    </div>
    <div class="info" id="text-btn">		    
      <span class="layui-icon layui-anim layui-anim-upbit" style="text-align:center;font-size:10px;" id="room_use_tips">&#xe702;&nbsp;&nbsp;<a>点击“开始扫码”即代表您已认真阅读并同意以上使用说明</a></span><br>
      <a href="/scan">
      <button type="button" class="layui-btn scan_default_btn layui-anim layui-anim-upbit <?php echo $theme_config["main_css"]?>">开始扫码</button></div></a>
  </form>
