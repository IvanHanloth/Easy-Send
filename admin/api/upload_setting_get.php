<?php
include dirname(__FILE__)."/./header.php";
echo return_json(array(
    "times"=>$times,
    "settime"=>$settime,
    "textmethod"=>$textmethod,
    "uploadsize"=>$uploadsize,
    "textsize"=>$textsize,
    "limit_way_times"=>$limit_way_times,
    "limit_num_times"=>$limit_num_times,
    "limit_way_tillday"=>$limit_way_tillday,
    "limit_num_tillday"=>$limit_num_tillday
    ))
?>