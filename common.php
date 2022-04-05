<?php
/*
By Ivan Hanloth
本文件为通用简化函数文件
2022/2/26
*/

//随机数字字母混合字符串生成
function random($len, $chars=null){  
    if (isset($chars)==FALSE) {  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    }  
    mt_srand(1000000*(double)microtime());  
    for ($i = 0, $result = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        $result .= $chars[mt_rand(0, $lc)];  
    }  
    return $result;  
}
function deletefile($path){
    unlink($path);
    
}
?>