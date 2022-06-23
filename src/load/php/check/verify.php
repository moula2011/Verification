<?php


$consult =json_decode(file_get_contents('../../../../data/rugarama.json'));

$period=$_REQUEST['date'];

$v_v=0; 
foreach($consult as $check): 
    if($check->day == $period && $check->verified == 1){
    $v_v += $check->verified; }
    $v_veri =$v_v;
endforeach; 
echo $v_veri;
 ?>