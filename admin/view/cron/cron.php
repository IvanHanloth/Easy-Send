<?php include_once dirname(__FILE__) . "/../header.php" ?>

<body class="pear-container">
    <div class="pear-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>数据监控</legend>
        </fieldset>
        <blockquote class="layui-elem-quote">
            数据监控用于完成一些定时任务，例如清除过期文件、清除直传房间等<br>
            数据监控的地址为<code> <?php echo $domain ?>cron.php</code>，您可以手动访问该地址或点击下方按钮来完成一次监控任务，当然，我们更推荐您使用自动化的数据监控<br>
            您可访问我们的说明文档来了解如何配置自动化数据监控
        </blockquote>
        <a href="<?php echo $domain ?>cron.php" target="_blank">
            <button class="layui-btn layui-btn-radius">手动执行监控任务</button>
        </a>
        <a href="http://doc.hanloth.cn/docs/easy-send-docs-help/easy-send-docs-help-1ed6gfe8mqpv8" target="_blank">
            <button class="layui-btn layui-btn-normal layui-btn-radius">说明文档</button>
        </a>
        <a href='http://doc.o5g.top/docs/easy-send-docs-help/easy-send-docs-help-1ed6gfe8mqpv8' target="_blank">
            <button class="layui-btn layui-btn-warm layui-btn-radius">说明文档（备用地址）</button>
        </a>
    </div>
</body>

</html>