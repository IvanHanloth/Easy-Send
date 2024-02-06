<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body class="pear-container">
    <div class="pear-main">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="log_box">
                <legend>颜色选择器</legend>
            </fieldset>
        <form class="layui-form" action="">
            <div class="layui-form-item"><label class="layui-form-label">颜色代码：</label>
                <div class="layui-input-inline" style="width: 200px;">
                    <input type="text" name="color" value="" placeholder="请选择颜色(RGBA)" class="layui-input" id="color-picker-input1">
                </div>
                <div class="layui-inline" style="left: -10px;">
                    <div id="color-picker1"></div>
                </div>
            </div>
            <div class="layui-form-item"><label class="layui-form-label">颜色代码：</label>
                <div class="layui-input-inline" style="width: 200px;">
                    <input type="text" name="color" value="" placeholder="请选择颜色(HEX)" class="layui-input" id="color-picker-input2">
                </div>
                <div class="layui-inline" style="left: -10px;">
                    <div id="color-picker2"></div>
                </div>
            </div>
        </form><blockquote class="layui-elem-quote">
            第一个颜色选择器返回RGBA格式，支持透明度<br>
            第二个颜色选择器返回HEX格式，不支持透明度
        </blockquote>
    </div>
    <script>
        layui.use(function() {
            var colorpicker = layui.colorpicker;
            var $ = layui.$;
            // 渲染
            colorpicker.render({
                elem: '#color-picker1',
                alpha: true,
                format: 'rgb',
                change: function(color) {
                    $('#color-picker-input1').val(color);
                }
            });colorpicker.render({
                elem: '#color-picker2',
                change: function(color) {
                    $('#color-picker-input2').val(color);
                }
            });
        });
    </script>
</body>

</html>