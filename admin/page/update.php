<?php include_once dirname(__FILE__)."/./header.php"?>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>网站升级</legend>
        </fieldset>
        <blockquote class="layui-elem-quote">
            网站升级程序需要获取由github提供的gitpage服务中的数据，请确保您的服务器能够访问github且您的php已经开启了curl、ZipArchive，否则无法实现一键更新<br>
            更新前请先备份您的数据库以及您对各模板的更改，以免造成数据的丢失。<br>
            一键更新服务分为升级与重装两种模式（升级：仅获取更改的内容并覆盖，重装：完全重装本程序）<br>
            目前无法实现跨版本更新，如果您的版本与最新版本相差过大，请逐一更新<br>
            <button type="button" id="update_get_btn" class="layui-btn  layui-btn-danger" lay-filter="update_get_btn">检查更新</button>
            <button type="buttn" id="update_log_get" class="layui-btn layui-btn-warm">更新日志</button>
        </blockquote>
        <div id="update_info" class="layui-hide">
            <p>当前版本号：<span id="now_version"></span></p>
            <p>最新版本号：<span id="newest_version"></span></p>
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="info_box">
              <legend>更新说明</legend>
              <div class="layui-collapse" id="version_info">
                  
               </div>
            </fieldset>
        </div>
        <div id="update_log" class="layui-hide">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;" id="log_box">
              <legend>更新日志</legend>
              <div class="layui-collapse" id="version_log">
                  
               </div>
            </fieldset>
        </div>
    </div>
</div>

<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script>
    function update(version_num,all){
        layui.use(function(){
            var layer=layui.layer;
            layer.prompt({title:"请输入后台密码以确认升级",formType: 1},function(value, index, elem){
                layer.msg("正在提交……",{icon:16,time:0,shade:0.3})
                $.ajax({
                    type:"POST",
                    url:"/admin/api/update_action.php",
                    data:{
                        "password":value,
                        "version_num":version_num,
                        "all":all
                    },
                    success:function(res){
                        layer.closeAll()
                        if(res.code==200){
                            layer.msg(res.tip,{icon:1,shade:0.3,time:100,end:function(){window.location.href="/"}})
                        }else{
                            layer.msg(res.tip,{icon:2,shade:0.3,time:2000})
                        }
                    },
                    error:function(){
                        layer.msg("服务器出现错误，请检查/admin/api/update_action.php",{icon:2,shade:0.3,time:2000})
                    }
                })
                });
        })
    }
    layui.use(function () {
        var form = layui.form
            , layer = layui.layer
            , element = layui.element;
            $("#update_get_btn").click(function(){
                layer.msg("正在获取更新信息",{icon:16,time:0,shade:0.3})
                $.getJSON("/admin/api/update_info.php/?type=info",function(res){
                    layer.closeAll()
                    $("#update_info").removeClass("layui-hide")
                    $("#now_version").html(res.now_version)
                    $("#newest_version").html(res.newest_version)
                    if(res.info.length!=0){
                        res.info.forEach(function(value){
                            $("#version_info").append('<div class="layui-colla-item"><h2 class="layui-colla-title">'+value.version+'</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>'+value.time+'</p><p><span>更新内容：</span>'+value.description+'</p><button class="layui-btn layui-btn-normal" onclick="update('+value.version_num+',false)">更新至此版本</button></div></div>')
                        })
                    }else{
                        $("#version_info").append('<div class="layui-colla-content layui-show"><strong>恭喜，您的程序处于最新版本，并不需要更新</strong></div>')
                    }
                    
                    $("#version_info").append('<div class="layui-colla-content layui-show">您也可以选择重装本程序<br><button class="layui-btn layui-btn-danger" id="total-reinstall" type="button" onclick="update('+res.newest_version_num+',true)">完全重装</button></div>')
                })
            })
            

            $("#update_log_get").click(function(){
                layer.msg("正在获取日志信息",{icon:16,time:0,shade:0.3})
                $.getJSON("/admin/api/update_info.php/?type=log",function(res){
                    layer.closeAll()
                    $("#update_log").removeClass("layui-hide")
                    if(res.log.length!=0){
                        res.log.forEach(function(value){
                            $("#version_log").append('<div class="layui-colla-item"><h2 class="layui-colla-title">'+value.version+'</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>'+value.time+'</p><p><span>更新内容：</span>'+value.description+'</p></div></div>')
                        })
                    }else{
                        $("#version_log").append('<div class="layui-colla-content layui-show">获取失败！</div>')
                    }
                })
            })

    });
</script>

</body>
</html>