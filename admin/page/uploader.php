<?php
/*
By Ivan Hanloth
本文件为用户中心框架文件
2022/7/31
*/
session_start();
include dirname(__FILE__)."/../../common.php";
if($_SESSION["admin"]!=$admintoken){
    echo "<script>window.location.href='/admin/page/login.php'</script>";
    exit;
}
if($admintoken=="21232f297a57a5a743894a0e4a801fc3ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ="){
    echo "<script>window.location.href='/admin/page/admin_edit.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $webname?> - 后台管理</title>    
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="../../public/layui/lib/css/layui.css" media="all">
    <link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="../lib/layui-v2.6.3/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">    
    <script src="../../public/lib/layui/layui.js" charset="utf-8"></script>
    <script src="../lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <blockquote class="layui-elem-quote">
            此处上传的文件不限制后缀、不限制文件大小（具体请查看php配置文件里设置的的文件上传限制）<br>
            上传前确保程序对输入的上传目录有写入权限（Linux 775以上）<br>
            上传目录应以“/”结尾，为服务器绝对地址，否则会导致上传文件出错<br>
            上传.php等后缀的文件时，可能会被宝塔防火墙拦截，关闭防火墙再上传即可（只关闭对应站点的POST防护亦可）
        </blockquote>

          <div class="layui-form-item">
    <label class="layui-form-label">上传目录</label>
    <div class="layui-input-block">
      <input type="text" id="upload_path" required  lay-verify="required" placeholder="请输入上传的目录" autocomplete="off" class="layui-input" value="<?php echo $_SERVER["DOCUMENT_ROOT"]."/" ?>">
    </div>
  </div>
                <div class="layui-upload">
                     <button type="button" class="layui-btn layui-btn-normal" id="testList">选择多文件</button>
         <div class="layui-upload-list" style="max-width: 1000px;">
          <table class="layui-table">
           <colgroup>
            <col>
            <col width="150">
            <col width="260">
            <col width="150">
           </colgroup>
           <thead>
            <tr>
             <th>文件名</th>
             <th>大小</th>
             <td>状态</td>
             <th>操作</th>
            </tr>
           </thead>
           <tbody id="demoList"></tbody>
          </table>
         </div> <button type="button" class="layui-btn" id="testListAction">开始上传</button>
        </div>
    </div>
</div>
<script>
layui.use(function(){
    var upload=layui.upload,
    element=layui.element;

    uploadListIns = upload.render({
    elem: '#testList'
    ,elemList: $('#demoList') //列表元素对象
    ,url: '/admin/api/upload.php' //此处用的是第三方的 http 请求演示，实际使用时改成您自己的上传接口即可。
    ,accept: 'file'
    ,multiple: true
    ,drag: true
    ,auto: false
    ,bindAction: '#testListAction'
    ,data: {
        path:function(){
            return $("#upload_path").val()
        }
    }
    ,choose: function(obj){
      var that = this;
      var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
      //读取本地文件
      obj.preview(function(index, file, result){
        var tr = $(['<tr id="upload-'+ index +'">'
          ,'<td>'+ file.name +'</td>'
          ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
          ,'<td><div class="layui-progress" lay-filter="progress-demo-'+ index +'"><div class="layui-progress-bar" lay-percent=""></div></div></td>'
          ,'<td>'
            ,'<button class="layui-btn layui-btn-xs demo-reload layui-hide">重传</button>'
            ,'<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'
          ,'</td>'
        ,'</tr>'].join(''));

        //单个重传
        tr.find('.demo-reload').on('click', function(){
          obj.upload(index, file);
        });

        //删除
        tr.find('.demo-delete').on('click', function(){
          delete files[index]; //删除对应的文件
          tr.remove();
          uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
        });



        that.elemList.append(tr);
        element.render('progress'); //渲染新加的进度条组件
      });
    }
    ,done: function(res, index, upload){ //成功的回调
      var that = this;
      if(res.code == 200){ //上传成功
        var tr = that.elemList.find('tr#upload-'+ index)
        ,tds = tr.children();
        tds.eq(3).html(''); //清空操作
        delete this.files[index]; //删除文件队列已经上传成功的文件
        return;
      }
      this.error(index, upload);
    }
    ,allDone: function(obj){ //多文件上传完毕后的状态回调
      console.log(obj)
    }
    ,error: function(index, upload){ //错误回调
      var that = this;
      var tr = that.elemList.find('tr#upload-'+ index)
      ,tds = tr.children();
      tds.eq(3).find('.demo-reload').removeClass('layui-hide'); //显示重传
    }
    ,progress: function(n, elem, e, index){ //注意：index 参数为 layui 2.6.6 新增
      element.progress('progress-demo-'+ index, n + '%'); //执行进度条。n 即为返回的进度百分比
    }
  });
})
</script>