<?php 
/*
By Ivan Hanloth
本文件为易传首页文件
2022/2/26
*/
include dirname(__FILE__)."/./common.php";

//检查是否安装


if (get_setting('install')==false or get_setting('install')==0) {
    echo("<script>window.location.href='/install'</script>");
    exit;
}elseif(get_setting('update')==1){
    echo("<script>window.location.href='/update'</script>");
    exit;
}else{
    if(file_exists(dirname(__FILE__)."/./install/install.lock") and file_exists(dirname(__FILE__)."/./update/update.lock")){
            if(isset($theme)==false or $theme == "" or !is_dir(dirname(__FILE__)."/./theme/".$theme)){
                $theme="default";
            }
            include dirname(__FILE__)."/./template/function.php";
            include dirname(__FILE__)."/./theme/".$theme."/config.php";
            if($_REQUEST["mode"]=='user'){
                if(file_exists(dirname(__FILE__)."/./theme/".$theme."/user/index.php")){
                    include dirname(__FILE__)."/./theme/".$theme."/user/index.php";
                }else{
                    include dirname(__FILE__)."/./theme/default/user/index.php";
                }
            }elseif($_REQUEST["mode"]=='download'){
                if(file_exists(dirname(__FILE__)."/./theme/".$theme."/download/index.php")){
                    include dirname(__FILE__)."/./theme/".$theme."/download/index.php";
                }else{
                    include dirname(__FILE__)."/./theme/default/download/index.php";
                }
            }else{
                if(file_exists(dirname(__FILE__)."/./theme/".$theme."/index/index.php")){
                    include dirname(__FILE__)."/./theme/".$theme."/index/index.php";
                }else{
                    include dirname(__FILE__)."/./theme/default/index/index.php";
                }
            }
    }else{
      echo "检测到您已安装本程序，为保证您的数据安全，请手动创建install/install.lock和update/update.lock文件";
      exit;
}
};
?>