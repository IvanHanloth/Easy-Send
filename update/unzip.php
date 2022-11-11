<?php
header("Content-type:text/json");
include dirname(__FILE__)."/../common.php";
            if(file_exists($_SERVER['DOCUMENT_ROOT']."/update/file/code.zip")){
                $a=unzip($_SERVER['DOCUMENT_ROOT']."/update/file/code.zip",$_SERVER['DOCUMENT_ROOT']."/");
            }
            if(file_exists($_SERVER['DOCUMENT_ROOT']."/update/file/sql.zip")){
                $b=unzip($_SERVER['DOCUMENT_ROOT']."/update/file/sql.zip",$_SERVER['DOCUMENT_ROOT']."/update/");
            }
                    sleep(2);
                    if($a and $b){
                        echo return_json(array("code"=>200,"tip"=>"解压完成"));
                    }
                    if(!$a and !$b){
                        echo return_json(array("code"=>100,"tip"=>"解压失败"));
                    }
?>