/*
By Ivan Hanloth
本文件为翰络云传文件提取表单提交文件
2022/4/3
*/
layui.use(['form'], function(){
  var form = layui.form
  ,$ = layui.jquery
  ,layer = layui.layer;
  //自定义验证规则
  form.verify({
    get: function(value){
      if(value.length != 4){
        return '提取码为4位';
      }
    }
  });
  //监听提交
  form.on('submit(getbtn)', function(data){
      $.ajax({
         //定义提交的方式
         type: "POST",
         //定义要提交的URL
         url:'/result.php',
         //定义提交的数据类型
         dataType:'json',
         async:false,
         //要传递的数据
         data:{'key':JSON.stringify(data.field)},
         //服务器处理成功后传送回来的json格式的数据
         success:function (res) {
             if(res.code==200){//返回存在该提取码
                $("#input").addClass("layui-hide");
                 layer.msg("获取成功",{icon:1});
                 $("#result").removeClass("layui-hide");
                 $("#result-info").html('<span>剩余查看次数:</span><span style="color: #FF5722;">'+res.times+'</span><br><span>到期时间:</span><span style="color: #FF5722;">'+res.tillday+'</span>')
                 if(res.type==1){//为文件型s
                     $("#result-download-btn").removeClass("layui-hide");
                     $("#result-file").removeClass("layui-hide");
                     $("#result-url").attr("value",res.data);
                     $("#result-download").attr("href",res.data);
                 }else{
                     if(res.type==2){//为文本型
                         $("#result-text").removeClass("layui-hide");
                         $("#result-value").val(res.data);
                     }
                 }
             }else{//返回不存在该提取码
                layer.msg(res.tip,{icon:2});
             }
         },
     } );
    return false;
  });
  
});