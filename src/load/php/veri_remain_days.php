<?php

include 'link.php';
$consult =json_decode(file_get_contents('../../../data/rugarama.json'));

$period=$_REQUEST['period'];
 
    $served=0;$done=0;$days_left=0;$days_done_to_veri=0;

    foreach($consult as $check): 
        if($check->period == $period){ 
            $days_done_to_veri += $check->done;
            $served += $check->served;
            $done += $check->done; 
        }
    endforeach;

    $days_left=$served-$done; 

    echo $days_left;

?>