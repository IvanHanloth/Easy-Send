/*
By Ivan Hanloth
本文件为翰络云文本保存文件
2022/4/3
*/
layui.use(['form'], function(){
  var form = layui.form
  ,$ = layui.jquery
  ,layer = layui.layer;
  //自定义验证规则
  form.verify({
    text: function(value){
      if(value.length > 5000){
        return '文本不能超过5000字符';
      }
    }
  });
  //监听提交
  form.on('submit(save)', function(data){
      $.ajax({
         //定义提交的方式
         type: "POST",
         //定义要提交的URL
         url:'/save_text.php',
         //定义提交的数据类型
         dataType:'json',
         async:false,
         //要传递的数据
        data:{'data':JSON.stringify(data.field)},
         //服务器处理成功后传送回来的json格式的数据
         success:function (res) {
             if(res.code == 200){
                $("#textinfo").html('<span>提取码:</span><span style="color: #FF5722;">'+res.key+'</span><br><span>剩余查看次数:</span><span style="color: #FF5722;">'+res.times+'</span><br><span>到期时间:</span><span style="color: #FF5722;">'+res.tillday+'</span>')
                $('#text').addClass('layui-hide');
                $('#textbtn').addClass('layui-hide');
             layer.msg('上传完毕', {icon: 1});
             }
         }
     } );
    return false;
  });
  
});