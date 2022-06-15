<?php

include 'link.php';

$consult =json_decode(file_get_contents('../../../data/rugarama.json'));

$period=$_REQUEST['period'];

$v_v=0; 
foreach($consult as $check): 
    if($check->period == $period && $check->verified == 1){
    $v_v += $check->verified; }
    $v_veri =$v_v;
endforeach; 
echo $v_veri;
 ?>