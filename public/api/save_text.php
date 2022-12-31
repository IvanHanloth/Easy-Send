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
$user=userinfo();
if(!$user){
    $uid=0;
}else{
    $uid=$user["uid"];
}		
		//剩余时长
		if($limit_way_tillday==1){//固定值
		    $tillday=time()+$settime*24*60*60;
		    $tilltime=date('Y-m-d H:i:s', $tillday);
		}else{//自定义值,此时tillday为最大到期时间
		    $tillday=time()+$limit_num_tillday*24*60*60;
		    if(strtotime($data['tillday'])<=$tillday){//合法时间
		        $tilltime=$data['tillday'];
		    }else{
		        echo return_json(array("code"=>0,"tip"=>"到期时间超过上限"));
		        exit;
		    }
		}
		//提取次数
		if($limit_way_times==2){//自定义值
		    if($data['times']<=$limit_num_times){//合法提取次数
		        $times=$data['times'];
		    }else{
		        echo return_json(array("code"=>0,"tip"=>"提取次数超过上限"));
		        exit;
		    }
		}
$check=array(1);
//定义进行循环检查
while ($check[0]>=1) {
	//进行循环检查
	$key=random($verify_num,$verify_type);
	//获得一个key
	$check=mysqli_query($db,"SELECT count(*) FROM `data` WHERE binary `gkey` = '{$key}'");
	//获取数据库中是否存在相同key
	$check=mysqli_fetch_row($check);
	//sql对象转化为数组
}
$preview=mb_substr($data["text"],0,10);
if(strlen($data["text"])>10) {
	$preview.="…";
}
if($textmethod=="off") {
	mysqli_query($db,"INSERT INTO `data` (`id`, `gkey`, `type`, `method`, `data`, `tillday`, `times`,`preview`,`uid`) VALUES (NULL, '{$key}', '2','1','{$data['text']}', '{$tilltime}', '{$times}','{$preview}','{$uid}')");
	//插入数据
	echo return_json( array("code"=>"200","tip"=>"文本保存成功","key"=>$key,"tillday"=>$tilltime,"times"=>$times,"qrcode"=>$qrcode.$domain."?key=".$key));
	exit;
} elseif($textmethod=="on");
$dir =$_SERVER['DOCUMENT_ROOT']."/upload/text/".$date;
if(!is_dir($dir)) {
	mkdir($dir,0777,true);
}
$file_path=$dir.random(16).".txt";
file_put_contents($file_path,$data['text']);
mysqli_query($db,"INSERT INTO `data` (`id`, `gkey`, `type`, `method`, `data`, `tillday`, `times`, `preview`,`uid`) VALUES (NULL, '{$key}', '2','2','{$file_path}', '{$tilltime}', '{$times}', '{$preview}','{$uid}')");
//插入数据
echo return_json( array("code"=>"200","tip"=>"文本保存成功","key"=>$key,"tillday"=>$tilltime,"times"=>$times,"qrcode"=>$qrcode.$domain."?key=".$key));
exit;
?>