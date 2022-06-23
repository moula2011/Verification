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
    $ambuqt=0; $ambuup=0; $ambutot=0;
    $veriqt=0; $veriup=0; $veritot=0;$served=0; 
    $veriamounted=0;$done=0;$days_left=0;$days_done_to_veri=0;

    foreach($consult as $check): 
        $days_done_to_veri += $check->done;
        $served += $check->served;
        $done += $check->done; 
        foreach($check->items->consultation as $consul):if($check->period == $period && $consul->insured !=0){ $cup+=$consul->cons_u_p;} endforeach;
        foreach($check->items->laboratoire as $labo): if($check->period == $period && $labo->insured !=0){ $lab+=$labo->lab_u_p; } endforeach;
        foreach($check->items->medicines as $meds):  if($check->period == $period && $meds->insured !=0){  $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; } endforeach;
        foreach($check->items->consommables as $cons): if($check->period == $period && $cons->insured !=0){ $consoqt+=$cons->conso_quantity; $consup+=$cons->conso_u_p; } endforeach;
        foreach($check->items->soins as $soin): if($check->period == $period && $soin->insured !=0){ $soinqt+=$soin->act_med_quantity; $soinup+=$soin->act_med_u_p; } endforeach;
        foreach($check->items->hospitalisation as $hosp):if($check->period == $period && $hosp->insured !=0){ $hospqt+=$hosp->hosp_quantity; $hospup+=$hosp->hosp_u_p; } endforeach;
        //============ Ambulance ==========================
        foreach($check->items->ambulance as $ambu):if($check->period == $period){ $ambuqt+=$ambu->ambu_quantity; $ambuup+=$ambu->ambu_u_p; } endforeach;
    endforeach;   

    $mtot=$mqt*$mup;$consotot=$consoqt*$consup;$sointot=$soinqt*$soinup;$hosptot=$hospqt*$hospup;$ambutot=$ambuqt*$ambuup; 
    
    $tot=$cup+$lab+$mtot+$consotot+$sointot+$hosptot+$ambutot; 

    echo $tot ;

?>