<?php if ($announcement != "") { ?>
    <script>
    if(sessionStorage.getItem("announcement")!="true"){
        layui.use(function() {
            var layer = layui.layer
            layer.ready(function() {
                $.getJSON("/public/api/set_info.php", function(data) {
                    layer.alert(data.announcement, {
                        title:"公告",
                        btn:['知道了'],
                        btn1: function(index, layero, that){
                            sessionStorage.setItem("announcement", "true");
                        }

                    })
                })

            })
        })
    }
    </script>
<?php
}
echo $header;

?>