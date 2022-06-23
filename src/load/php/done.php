<?php

error_reporting(1|0);
include 'link.php';

$consult =json_decode(file_get_contents('../../../data/rugarama.json'));

$period=$_REQUEST['period']; 

$days_done_to_veri=0;  
foreach($consult as $check): 
    if($check->period == $period && $check->done == 1){
        $days_done_to_veri += $check->done;
    }
endforeach; 
echo $days_done_to_veri;
 ?>

