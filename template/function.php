<?php
//get_data
function tem_get_default(){
    global $theme_config;
    include dirname(__FILE__)."/./get_data/default.php";
}



//room
function tem_room_default(){
    global $theme_config;
    include dirname(__FILE__)."/./room/default.php";
}



//upload_file
function tem_file_drag_box(){
    global $theme_config,$limit_num_tillday;
    include dirname(__FILE__)."/./upload_file/drag_upload_box.php";
}
function tem_file_drag_whole(){
    global $theme_config,$limit_num_tillday;
    include dirname(__FILE__)."/./upload_file/drag_upload_whole.php";
}



//upload_text
function tem_text_textarea(){
    global $theme_config,$limit_num_tillday;
    include dirname(__FILE__)."/./upload_text/textarea.php";
}



//download
function tem_download_big_showpercent(){
    global $theme_config;
    include dirname(__FILE__)."/./download/big_showPercent.php";
}

//scan
function tem_scan_default(){
    global $theme_config;
    include dirname(__FILE__)."/./scan/default.php";
}

//require
function tem_require_head(){
    global $head,$keyword,$description,$webname,$theme_config;
    include dirname(__FILE__)."/./require/head.php";
}
function tem_require_header(){
    global $header,$announcement;
    
    include dirname(__FILE__)."/./require/header.php";
}
function tem_require_footer(){
    global $footer,$if_gray;
    include dirname(__FILE__)."/./require/footer.php";
}
//user
function tem_user_default(){
    global $theme_config;
    include dirname(__FILE__)."/./user/default.php";
}
?>