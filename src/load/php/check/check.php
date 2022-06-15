<?php

include '../link.php';

$consult =json_decode(file_get_contents('../../../../data/rugarama.json'));

$date=$_REQUEST['date']; 

$v_c=0;  
foreach($consult as $check): 
    if($check->date == $date && $check->checked == 1){
        $v_c += $check->checked; 
    }
    $v_check =$v_c;
endforeach; 
echo $v_check;
 ?>

