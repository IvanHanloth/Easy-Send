/*
By Ivan Hanloth
本文件为翰络云传轮播文件
2022/4/3
*/

layui.use(function(){
  var carousel = layui.carousel; //轮播
  //执行一个轮播实例
  carousel.render({
    elem: '#carousel'
    ,width: '80%' //设置容器宽度
    ,height: 200
    ,arrow: 'none' //不显示箭头
    ,anim: 'fade' //切换动画方式
  });
})