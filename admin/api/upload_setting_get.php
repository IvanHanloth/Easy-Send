<?php
include dirname(__FILE__)."/./header.php";
echo return_json(array("times"=>$times,"settime"=>$settime,"textmethod"=>$textmethod,"uploadsize"=>$uploadsize,"textsize"=>$textsize))
?>