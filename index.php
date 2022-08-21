<?php 
/*
By Ivan Hanloth
本文件为易传首页文件
2022/8/21
*/
include "config.php";
include "common.php";
include "info.php";

//检查是否配置数据库
if ($dbconfig['host']=="" or $dbconfig['account']=="" or $dbconfig['password']=="" or $dbconfig['name']=="" or $dbconfig['port']=="") {
    echo("<script>window.location.href='/install'</script>");
} else{
    if(file_exists("./install/install.lock")){
         $db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
        if(!$db) {
            die('无法连接至数据库，请检查网站配置文件');
        } else {
            if(isset($template)==false or $template == "" or !is_dir("./template/".$template)){
                $template="default";
            }
            require "./template/".$template."/header.php";
            require "./template/".$template."/body.php";
            require "./template/".$template."/footer.php";
      };
    }else{
      echo "检测到您已安装本程序，为保证您的数据安全，请手动创建install/install.lock文件";
}
};
?>
