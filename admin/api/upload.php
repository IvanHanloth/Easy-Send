<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/11/15
*/
include dirname(__FILE__)."/./header.php";
$dir =$_POST["path"];
if(!is_dir($dir)){
    mkdir($dir,0777,true);
}
    if ($_FILES["file"]["error"] > 0){
        echo return_json( array("code"=>"0","tip"=>"错误".$_FILES["file"]["error"]));
    }else{
        $mov=move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$_FILES["file"]["name"]);
        if($mov){
            echo return_json(array("code"=>200,"tip"=>"上传成功"));
        }else{
            echo return_json(array("code"=>100,"tip"=>"文件上传失败"));
        }
    }
?>