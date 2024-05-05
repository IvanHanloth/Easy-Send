<?php 
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/
include dirname(__FILE__)."/./common.php";

//检查是否安装
if (get_setting('install')==false or get_setting('install')==0) {
    exit("<script>window.location.href='/install'</script>");
}elseif(get_setting('update')==1){
    exit("<script>window.location.href='/update'</script>");
}else{
    if(file_exists(dirname(__FILE__)."/./install/install.lock") and file_exists(dirname(__FILE__)."/./update/update.lock")){
            if(isset($theme)==false or $theme == "" or !is_dir(dirname(__FILE__)."/./theme/".$theme)){
                $theme="default";
            }
            include dirname(__FILE__)."/./template/function.php";
            include dirname(__FILE__)."/./theme/".$theme."/config.php";
            if(isset($_REQUEST["mode"]) and $_REQUEST["mode"]=='user'){
                if(file_exists(dirname(__FILE__)."/./theme/".$theme."/user/index.php")){
                    include dirname(__FILE__)."/./theme/".$theme."/user/index.php";
                }else{
                    include dirname(__FILE__)."/./theme/default/user/index.php";
                }
            }elseif(isset($_REQUEST["mode"]) and $_REQUEST["mode"]=='app'){
                if(file_exists(dirname(__FILE__)."/./theme/".$theme."/app/index.php")){
                    include dirname(__FILE__)."/./theme/".$theme."/app/index.php";
                }else{
                    include dirname(__FILE__)."/./theme/default/app/index.php";
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