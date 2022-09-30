<?php include_once dirname(__FILE__)."/./header.php"?>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">提取码</label>
                            <div class="layui-input-inline">
                                <input type="text" name="gkey" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">文本内容</label>
                            <div class="layui-input-inline">
                                <input type="text" name="preview" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">剩余次数</label>
                            <div class="layui-input-inline">
                                <input type="text" name="times" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">到期时间</label>
                            <div class="layui-input-inline">
                                <input type="text" name="tillday" autocomplete="off" class="layui-input" id="tillday" placeholder="yyyy-MM-dd">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

        <script type="text/html" id="left-toolbar">
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
            </div>
        </script>

        <table class="layui-hide" id="main-table" lay-filter="main-table-filter"></table>

        <script type="text/html" id="each-tool">
            <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
        </script>

    </div>
</div>
<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form', 'table','laypage','laydate'], function () {
        var $ = layui.jquery,
            form = layui.form,
            laypage=layui.laypage,
            laydate=layui.laydate
            table = layui.table;
        laydate.render({elem:"#tillday"})

        table.render({
            elem: '#main-table',
            url: '/admin/api/text_data_get.php',
            toolbar: '#left-toolbar',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            where:{type:"get"},
            cols: [[
                {type: "checkbox", width: 50},
                {field: 'id', title: 'ID'},
                {field: 'preview',minWidth: 150, title: '文本预览'},
                {field: 'times',minWidth: 100, title: '剩余次数', align: "center"},
                {field: 'tillday',minWidth: 100, title: '到期时间', align: "center"},
                {title: '操作', minWidth: 150, toolbar: '#each-tool', align: "center"}
            ]],
            limits: [10, 25, 50, 100],
            limit: 10,
            page: true,
            text: {
                none: '暂无相关数据'
            },
            skin: 'line'
        });

        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            table.reload('main-table', {
            page: {
                curr: 1
            },
            where: {"type":"search","data":JSON.stringify(data.field)},
            });

            return false;
        });

        /**
         * toolbar监听事件
         */
        table.on('toolbar(main-table-filter)', function (obj) {
            if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('main-table')
                    , data = checkStatus.data;
                    
                layer.confirm('真的删除这'+data.length+'行么', function (index) {
                    $.ajax({
                        type:"POST",
                        url:"/admin/api/text_data_delete.php",
                        data:{"type":"some","data":JSON.stringify(data)},
                        dataType:"json",
                        async:false,
                        success:function(res){
                            layer.close(index);
                            layer.msg(res.tip,{icon:1,shade:0.3,time:2000});
                            table.reload('main-table',{})
                        },
                        error:function(){
                            layer.close(index);
                            layer.msg("删除失败",{icon:2,shade:0.3,time:2000})
                        }
                    })
                });
            }
            if (obj.event === "LAYTABLE_TIPS"){
                layer.open({
                    type:0,
                    content:"为保护用户隐私，此处不会显示提取码，仅可通过搜索框获取指定提取码对应的数据。<br>搜索功能中“提取码”和“剩余次数”为全词匹配搜索，不搜索此两项时请留空。<br>多个条件搜索则匹配同时符合所有搜索条件的结果。",
                    shade:0.3,
                    title:"说明"
                })
            }
        });

        table.on('tool(main-table-filter)', function (obj) {
            var data = obj.data;
            if (obj.event === 'edit') {
                var index = layer.open({
                    title: '编辑数据',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: '../page/text_data_edit.php?id='+JSON.stringify(data.id),
                    end:function(){
                        table.reload('main-table',{})
                    }
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除此行么', function (index) {
                    $.ajax({
                        type:"POST",
                        url:"/admin/api/text_data_delete.php",
                        data:{"type":"one","id":JSON.stringify(obj.data.id)},
                        dataType:"json",
                        async:false,
                        success:function(res){
                            layer.close(index);
                            layer.msg(res.tip,{icon:1,shade:0.3,time:2000});
                            table.reload('main-table',{})
                        },
                        error:function(){
                            layer.close(index);
                            layer.msg("删除失败",{icon:2,shade:0.3,time:2000})
                        }
                    })
                });
            }
        });

    });
</script>

</body>
</html>