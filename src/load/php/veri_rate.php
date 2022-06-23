<?php
error_reporting(1|0);

include 'link.php';
$consult =json_decode(file_get_contents('../../../data/rugarama.json'));

$period=$_REQUEST['period'];
 
    $cup=0;$un_cup=0; $lab=0;$un_lab=0; $tot=0; 
    $mqt=0; $mup=0; $mtot=0; $un_mqt=0; $un_mup=0; $un_mtot=0; 
    $consoqt=0; $consup=0; $consotot=0; $un_consoqt=0; $un_consup=0; $un_consotot=0; 
    $soinqt=0; $soinup=0; $sointot=0; $un_soinqt=0; $un_soinup=0; $un_sointot=0; 
    $hospqt=0; $hospup=0; $hosptot=0;$un_hospqt=0; $un_hospup=0; $un_hosptot=0;$unveri_tot=0; 
    $veriqt=0; $veriup=0; $veritot=0;$served=0; 
    $veriamounted=0;$done=0;$days_left=0;$days_done_to_veri=0;
    $v_v=0; 
    foreach($consult as $check): 
        if($check->period == $period && $check->verified == 1){
        $v_v += $check->verified; }
        $v_check =$v_v;
    endforeach;
    foreach($consult as $check): 
        if($check->period == $period){
            $done += $check->done; 
        }
    endforeach;

    if($v_check !=0)
    $rate = $done*100/$v_check;
    else
    $rate=0;

    echo round($rate,1);
?>

