<?php
include dirname(__FILE__) . "/../header.php";
function get_data()
{
    global $db;
    $page = $_REQUEST["page"];
    $limit = $_REQUEST["limit"];
    if ($page == "" or $limit == "") {
        $page = 1;
        $limit = 10;
    }
    $start = ($page - 1) * $limit;
    if ($_REQUEST["action"] == "get") {
        $count = $db->query( "SELECT count(*) FROM `user`");
        $result = $db->query("SELECT `uid`,`account`,`mail` FROM `user` LIMIT {$start},{$limit}");
    } elseif ($_REQUEST["action"] == "search") {
        $data = json_decode($_REQUEST["data"], true);
        $mail = $data["mail"];
        $account = $data["account"];
        $uid = $data["uid"];
        $add = " WHERE `account`!=''";
        if ($uid != "") {
            $add .= " AND `uid`='{$uid}'";
        }
        if ($mail != "") {
            $add .= " AND `mail` LIKE '%{$mail}%'";
        }
        if ($account != "") {
            $add .= " AND `account` LIKE '%{$account}%'";
        }
        $count = $db->query( "SELECT count(*) FROM `user`" . $add);
        $result = $db->query("SELECT `uid`,`account`,`mail` FROM `user`" . $add . " LIMIT {$start},{$limit}");
    }
    
    $count = $count->fetch_row();
    if ($count[0] != 0) {
        $result = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $result = array();
    }
    return array(
        "code" => 0,
        "msg" => 0,
        "count" => $count[0],
        "data" => $result
    );
}
function delete_data(){
    global $db;
    if($_REQUEST["type"]=="one"){
        $res=$db->query("DELETE FROM `user` WHERE `uid`='{$_REQUEST['uid']}'");
        if(!$res){
                $wrong=$_REQUEST["uid"];
            }
    }else{
        $data=json_decode($_REQUEST["data"],true);
        foreach ($data as $datal){
            $res=$db->query("DELETE FROM `user` WHERE `uid`='{$datal['uid']}'");
            if(!$res){
                break;
                $wrong=$datal["uid"];
            }
        }
    }
    if($res){
        return array("code"=>200,"tip"=>"删除成功");
    }else{
        return array("code"=>100,"tip"=>"删除失败,出错id".$wrong."，请刷新后重试");
    }
}
function edit_data(){
    global $db;
    if($_REQUEST["type"]=="get"){
        $data=$db->query("SELECT * FROM `user` WHERE `uid`='{$_REQUEST['uid']}'");
        $data=$data->fetch_assoc();
        return array("account"=>$data["account"],"mail"=>$data["mail"]);
    }
    if($_REQUEST["type"]=="save"){
        $data=json_decode($_POST["data"],true);
        $uid=$_REQUEST["uid"];
        foreach ($data as $name=>$content){
            if($name=="password"){
                $account=$db->query("SELECT `account` FROM `user` WHERE `uid`={$uid}");
                $account=$account->fetch_row();
                $account=$account[0];
                $a=$content;
                $a=base64_encode($a);
                $a=md5($a);
                $a=base64_encode($a);
                $usertoken=md5(base64_encode($account)).md5($a);
                $db->query("UPDATE `user` SET `password`='{$a}',`usertoken`='{$usertoken}' WHERE `uid`='{$uid}'");
                continue;
            }
            if($name=="account"){
                $password=$db->query("SELECT `password` FROM `user` WHERE `uid`={$uid}");
                $password=$password->fetch_row();
                $a=$password[0];
                $usertoken=md5(base64_encode($content)).md5($a);
                $db->query("UPDATE `user` SET `account`='{$content}',`usertoken`='{$usertoken}' WHERE `uid`='{$uid}'");
                continue;
            }
            if($name=="mail"){
                $db->query("UPDATE `user` SET `mail`='{$content}' WHERE `uid`='{$uid}'");
                continue;
            }
        }
    }
    return array("code"=>200,"tip"=>"保存成功");
}
function handler()
{
    switch ($_REQUEST["action"]) {
        case "get":
            $res = get_data();
            break;
        case "search":
            $res = get_data();
            break;
        case "delete":
            $res = delete_data();
            break;
        case "edit":
            $res = edit_data();
            break;
        // case "add":
        //     $res = add_data();
        //     break;
        default:
            $res = array("code" => "100", "tip" => "非法访问");
            break;
    }
    echo return_json($res);
}
handler();
?>