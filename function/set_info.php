<?php
require "../config.php";
 echo json_encode( array("code"=>"200","filesize"=>$uploadsize,"textsize"=>$textsize),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?>