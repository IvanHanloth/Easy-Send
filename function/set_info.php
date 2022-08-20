<?php
require "../info.php";
header("Access-Control-Allow-Origin:*");
echo json_encode( array("code"=>"200","filesize"=>$uploadsize,"textsize"=>$textsize,"webname"=>$webname,"header"=>$header,"footer"=>$footer),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?>
