<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/./common.php";


/*
定期删除过期文件
*/
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
echo "Totally checked ".$total." data , deleted ".$success." data , failed ".$faile." times";


/*
定期删除房间
*/
$result=mysqli_query($db,"SELECT * FROM `room` ORDER BY `rid`");
$result=mysqli_fetch_all($result,MYSQLI_BOTH);
$success=0;
$faile=0;
$total=0;
foreach($result as $data){
    $total++;
    for($i=1;$i<3;$i++){
        session_write_close();
        if($i==1){
            $type="send";
        }elseif($i==2){
            $type="receive";
        }
        session_id($data[$type]);
        session_start();
        if($_SESSION["roomtype".$data["rid"]]!=$type or isset($_SESSION["roomtype".$data["rid"]])==false){
            $my_stmt=$db->prepare("UPDATE `room` SET `{$type}`='',`state`='waiting' WHERE `rid`=? ");
            $my_stmt->bind_param("s",$data['rid']);
            $my_stmt->execute();
            $my_stmt->close();
        }
        session_write_close();
    };
    if($data["state"]=="finish" and $data["receive"]==""){
        $res=delete_roomdata($data["rid"],true);
        $success++;
    }
    if($data["send"]=="" and $data["receive"]==""){
        $res=delete_roomdata($data["rid"],true);
        $success++;
    }
};
echo "<br>Totally checked ".$total." rooms , deleted ".$success." rooms , failed ".$faile." times";


?>