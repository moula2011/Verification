<?php

// error_reporting(1|0);
// include 'link.php';

$consult =json_decode(file_get_contents('../../../data/rugarama.json'));

$period=$_REQUEST['period']; 

$v_c=0;  
foreach($consult as $check): 
    if($check->period == $period && $check->checked == 1){
        $v_c += $check->checked; 
    }
    $v_check =$v_c;
endforeach; 
echo $v_check;
 ?>

