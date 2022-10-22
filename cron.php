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
$num=mysqli_query($db,"SELECT * FROM `data`");
$num=mysqli_num_rows($num);
$result=mysqli_query($db,"SELECT * FROM `data` ORDER BY `id`");
$result=mysqli_fetch_all($result,MYSQLI_BOTH);
for($i=0;$i<=$num;$i++){
    if(strtotime($result[$i]["tillday"])<=$now){
        if($result[$i]["type"]==1){
            $delete_file=unlink($result[$i]["path"]);
            if($delete_file==TRUE){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$result[$i]['id']}'");
            }else{
                echo"Wrong";
            };
        }elseif($result[$i]["type"]==2){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$result[$i]['id']}'");
            }elseif($result[$i]["method"]==2){
            $delete_file=unlink($result[$i]["data"]);
            if($delete_file==TRUE){
                mysqli_query($db,"DELETE FROM `{$dbname}`.`data` WHERE `data`.`id`='{$result[$i]['id']}'");
            }else{
                echo"Wrong";
            };};
    };
};
echo "Finish";
?>