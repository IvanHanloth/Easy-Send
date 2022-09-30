<?php
/*
By Ivan Hanloth
本文件为易传文件存储接口文件
2022/4/4
*/
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
include dirname(__FILE__)."/../../common.php";
$date=date("Y/m/");
$dir =$_SERVER['DOCUMENT_ROOT']."/upload/files/".$date;
if(!is_dir($dir)){
    mkdir($dir,0777,true);
}
    if ($_FILES["file"]["error"] > 0){
        echo return_json( array("code"=>"0","tip"=>"错误".$_FILES["file"]["error"]));
    }else{
            $origin_name=$_FILES["file"]["name"];
            $file_name=random(6)."_".random(16).".".random(6);
            $mov=move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$file_name);
            if($mov==TRUE){
                    $file_url=$domain."upload/files/".$date.$file_name;
                    $file_path=$dir.$file_name;
                    $tillday=time()+$settime;//剩余时长
                    $tilltime=date('Y-m-d H:i:s', $tillday);
                    $check=array(1);//定义进行循环检查
                    while ($check[0]>=1){//进行循环检查
                        $key=random(4);//获得一个key
                        $check=mysqli_query($db,"SELECT count(*) FROM `data` WHERE binary `gkey` = '{$key}'");//获取数据库中是否存在相同key
                        $check=mysqli_fetch_row($check);//sql对象转化为数组
                    };
                    mysqli_query($db,"INSERT INTO `data` (`id`, `gkey`, `type`, `data`,`origin`,`path`, `tillday`, `times`) VALUES (NULL, '{$key}', '1', '{$file_url}','{$origin_name}','{$file_path}', '{$tilltime}', '{$times}')");//插入数据
                echo return_json(array("code"=>"200","tip"=>"文件上传成功","key"=>$key,"tillday"=>$tilltime,"times"=>$times,"qrcode"=>$qrcode.$domain."?key=".$key));
            }else{
                echo return_json(array("code"=>"100","tip"=>"文件上传失败"));
            }
    };
?>