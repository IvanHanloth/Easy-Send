<?php

/*

By Ivan Hanloth
本文件为易传文件存储接口文件
2022/4/4
*/

include dirname(__FILE__)."/../../common.php";
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
$room=roominfo();
if($room==false){
    echo return_json(array("code"=>100,"tip"=>"房间不存在"));
    exit;
}
if($_SESSION["roomtype".$room["rid"]]!="send"){
    echo return_json(array("code"=>100,"tip"=>"非法访问"));
    exit;
}
if($room["state"]!="connected" and $room["state"]!="sending"){
    echo return_json(array("code"=>100,"tip"=>"非法访问"));
    exit;
}
$now=time();
$roomid=$room["roomid"];
$date=date("Y/m/");
$add="upload/room/".$roomid."/".$date;
$dir =$_SERVER['DOCUMENT_ROOT']."/".$add;
if(!is_dir($dir)){
    mkdir($dir,0777,true);
}
if($_REQUEST["index"]==1){
    mysqli_query($db,"UPDATE `room` SET `total`='{$_POST['total']}',`origin`='{$_POST['origin']}',`size`='{$_POST['size']}',`state`='sending',`starttime`='{$now}' WHERE binary `roomid`='{$roomid}'");
    //清除当前room之前的数据
    $result=mysqli_query($db,"SELECT * FROM `roomdata` WHERE binary `roomid`='{$roomid}'");
    $num=mysqli_num_rows($result);
    if($num!=0){
    $result=mysqli_fetch_all($result,MYSQLI_BOTH);
    for($i=0;$i<=$num;$i++){
        $delete_file=unlink($result[$i]["path"]);
        if($delete_file==TRUE){
                mysqli_query($db,"DELETE FROM `roomdata` WHERE `rdid`='{$result[$i]['rdid']}'");
            }
    }}
}
if($_POST["index"]==$_POST["total"]){
    mysqli_query($db,"UPDATE `room` SET `state`='send-finish',`send`='0',`endtime`='{$endtime}' WHERE binary `roomid`='{$roomid}'");
    $_SESSION["roomtype".$room["rid"]]="";
}
    if ($_FILES["file"]["error"] > 0){
        echo return_json( array("code"=>"0","tip"=>"错误".$_FILES["file"]["error"]));
    }else{
            $file_name=random(16).time().".".random(6);
            $mov=move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$file_name);
            if($mov==TRUE){
                    $file_url=$domain.$add.$file_name;
                    $file_path=$dir.$file_name;
                    mysqli_query($db,"INSERT INTO `roomdata` (`roomid`,`num`,`url`,`path`,`total`,`origin`,`size`) VALUES ('{$roomid}','{$_POST['index']}','{$file_url}','{$file_path}','{$_POST['total']}','{$_POST['origin']}','{$_POST['size']}')");
                echo return_json( array("code"=>"200","tip"=>"文件直传成功"));
            }else{
                echo return_json( array("code"=>"100","tip"=>"文件直传失败"));
            }
    
}
?>