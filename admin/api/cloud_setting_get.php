<?php
include dirname(__FILE__)."/./header.php";
echo return_json(array("cloud_way"=>$cloud_way,"qiniu_Access_Key"=>$qiniu_Access_Key,"qiniu_Secret_Key"=>$qiniu_Secret_Key,"qiniu_bucket"=>$qiniu_bucket,"qiniu_domain"=>$qiniu_domain))
?>