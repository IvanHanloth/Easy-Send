<?php
include dirname(__FILE__)."/./header.php";
$data=json_decode($_POST["data"],true);
foreach ($data as $name=>$content){
    if($content!=""){
        if($name=="data"){
                $data=get_data_by_id($_REQUEST["id"],"*");
                if($data['method']==2){
                    file_put_contents($data["data"],$content);
                    $content=mb_substr($content,0,10);
                    if(strlen($data["text"])>10){
                        $content.="…";
                    }
                    $name="preview";
                }
            }
        save_data_by_id($_REQUEST["id"],$name,$content);
    }
}
echo return_json(array("code"=>200,"tip"=>'保存成功'))
?>