<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
header("Access-Control-Allow-Origin:*");
header("Content-type:text/json");
include dirname(__FILE__)."/../../common.php";
$date=date("Y/m/");

    $r=$_POST["data"];
    $data=json_decode($r,true);
    $tillday=time()+$settime;//剩余时长
    $tilltime=date('Y-m-d H:i:s', $tillday);
    $check=array(1);//定义进行循环检查
    while ($check[0]>=1){//进行循环检查
        $key=random(4);//获得一个key
        $check=mysqli_query($db,"SELECT count(*) FROM `data` WHERE binary `gkey` = '{$key}'");//获取数据库中是否存在相同key
        $check=mysqli_fetch_row($check);//sql对象转化为数组
        };
        $preview=mb_substr($data["text"],0,10);
        if(strlen($data["text"])>10){
            $preview.="…";
        }
    if($textmethod=="off"){
        mysqli_query($db,"INSERT INTO `data` (`id`, `gkey`, `type`, `method`, `data`, `tillday`, `times`,`preview`) VALUES (NULL, '{$key}', '2','1','{$data['text']}', '{$tilltime}', '{$times}','{$preview}')");//插入数据
        echo json_encode( array("code"=>"200","tip"=>"文本保存成功","key"=>$key,"tillday"=>$tilltime,"times"=>$times,"qrcode"=>$qrcode.$domain."?key=".$key),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }elseif($textmethod=="on");
            $dir =$_SERVER['DOCUMENT_ROOT']."/upload/text/".$date;
            if(!is_dir($dir)){
                mkdir($dir,0777,true);
            }
            $file_path=$dir.random(16).".txt";
            file_put_contents($file_path,$data['text']);
            mysqli_query($db,"INSERT INTO `data` (`id`, `gkey`, `type`, `method`, `data`, `tillday`, `times`, `preview`) VALUES (NULL, '{$key}', '2','2','{$file_path}', '{$tilltime}', '{$times}', '{$preview}')");//插入数据
            echo json_encode( array("code"=>"200","tip"=>"文本保存成功","key"=>$key,"tillday"=>$tilltime,"times"=>$times,"qrcode"=>$qrcode.$domain."?key=".$key),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?>