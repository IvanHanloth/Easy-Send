<?php
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2024/1/21
*/
include dirname(__FILE__).'/../../common.php';
$key=$_REQUEST["key"];
$my_stmt=$db->prepare("SELECT * FROM `data` WHERE binary `gkey` = ? AND `type`=1 AND `times`>0");
$my_stmt->bind_param("s",$key);
$my_stmt->execute();
$result=$my_stmt->get_result();
$my_stmt->close();
if($result->num_rows==0) {
    echo "不存在此文件或文件已过期";
    exit;
} else {
    $dbinfo=$result->fetch_assoc();
    $times=$dbinfo["times"]-1;
    $tillday=$dbinfo["tillday"];
    if($times<0) {
    	echo "不存在此文件或文件已过期";
    	exit;
    } else {
        if($times>0) {
            $my_stmt=$db->prepare("UPDATE `data` SET `times` = ? WHERE binary `gkey` = ?");
            $my_stmt->bind_param("is",$times,$key);
            $my_stmt->execute();
            $my_stmt->close();
        } else {
                $now=time();
                $deletetime=date('Y-m-d H:i:s', $now + 1800);
                $my_stmt=$db->prepare("UPDATE `data` SET `tillday` = ?,`times` = ? WHERE binary `gkey` = ?");
                $my_stmt->bind_param("sis",$deletetime,$times,$key);
                $my_stmt->execute();
                $my_stmt->close();
        };

        ob_clean(); // 清空输出缓冲区
        $filePath = $dbinfo["path"]; // 文件的路径
        $fileName = $dbinfo["origin"]; // 下载时的文件名
        // 设置标头
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        
        // 打开文件流
        $fileStream = fopen($filePath, 'rb');
        
        // 如果成功打开文件流
        if ($fileStream) {
            // 将文件内容分块传输到浏览器
            while (!feof($fileStream)) {
                echo fread($fileStream, 8192);
                ob_flush(); // 刷新输出缓冲区
                flush();    // 将输出发送到客户端
            }
        
            // 关闭文件流
            fclose($fileStream);
        }
        
    };
};

?>