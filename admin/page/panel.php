<?php include_once dirname(__FILE__)."/./header.php"?>
<style>
    .layui-top-box {padding:40px 20px 20px 20px;color:#fff}
    .panel {margin-bottom:17px;background-color:#fff;border:1px solid transparent;border-radius:3px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
    .panel-body {padding:15px}
    .panel-title {margin-top:0;margin-bottom:0;font-size:14px;color:inherit}
    .label {display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;margin-top: .3em;}
    .layui-red {color:red}
    .main_btn > p {height:40px;}
</style>
<body>
<div class="layui-card">
    <div class="layui-card-header">数据统计</div>
    <div class=" layui-card-body layui-top-box">
        <div class="layui-row layui-col-space10 ">
            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-cyan">
                        <div class="panel-body">
                            <div class="panel-title">
                                <h5>文件总计</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins" id="file-total">获取中……</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-blue">
                        <div class="panel-body">
                            <div class="panel-title">
                                <h5>文本总计</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins" id="text-total">获取中……</h1>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-green">
                        <div class="panel-body">
                            <div class="panel-title">
                                <h5>房间统计</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins" id="room-total">获取中……</h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3">
                <div class="col-xs-6 col-md-3">
                    <div class="panel layui-bg-orange">
                        <div class="panel-body">
                            <div class="panel-title">
                                <h5>用户统计</h5>
                            </div>
                            <div class="panel-content">
                                <h1 class="no-margins" id="user-total">获取中……</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="layui-card">
    <div class="layui-card-header">公告</div>
    <div class="layui-card-body" id="announcement">
        获取中……
    </div>
</div>
<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script>
$.getJSON("/admin/api/panel.php",function(res){
    $("#announcement").html(res.announcement);
    $("#text-total").html(res.text_num);
    $("#file-total").html(res.file_num);
    $("#room-total").html(res.room_num);
    $("#user-total").html(res.user_total);
})
</script>
</body>
</html>