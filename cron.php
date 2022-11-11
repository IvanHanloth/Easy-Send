<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/./common.php";
$now=time();
$result=mysqli_query($db,"SELECT * FROM `data` ORDER BY `id`");
$result=mysqli_fetch_all($result,MYSQLI_BOTH);
$success=0;
$faile=0;
$total=0;
foreach($result as $data){
    $total++;
    if(strtotime($data["tillday"])<=$now){
        $res=delete_data_by_id($data["id"]);
        if($res){
            $success++;
        }else{
            $faile++;
        }
    };
};
echo "Totally checked ".$total." data,deleted ".$success." data , failed ".$faile." times";
?>