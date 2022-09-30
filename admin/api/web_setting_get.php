<?php
include dirname(__FILE__)."/./header.php";
echo return_json(array("webname"=>$webname,"theme"=>$theme,"header"=>$header,"logo"=>$logo,"footer"=>$footer,"head"=>$head,"keywords"=>$keywords,"description"=>$description,"qrcode"=>$qrcode,"announcement"=>$announcement))
?>