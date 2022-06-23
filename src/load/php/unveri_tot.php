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
    $un_ambuqt=0; $un_ambuup=0; $un_ambutot=0;
    $veriqt=0; $veriup=0; $veritot=0;$served=0; 
    $veriamounted=0;$done=0;$days_left=0;$days_done_to_veri=0;
    $v_v=0; 
    foreach($consult as $check): 
        foreach($check->items->consultation as $consul): if($check->period == $period && $check->done == 0 && $consul->insured !=0){$un_cup+=$consul->cons_u_p;} endforeach;
        foreach($check->items->laboratoire as $labo): if($check->period == $period && $check->done == 0 && $labo->insured !=0){$un_lab+=$labo->lab_u_p;} endforeach;
        foreach($check->items->medicines as $meds): if($check->period == $period && $check->done == 0 && $meds->insured !=0){ $un_mqt+=$meds->med_quantity; $un_mup+=$meds->med_u_p; } endforeach;
        foreach($check->items->consommables as $cons): if($check->period == $period && $check->done == 0 && $cons->insured !=0){ $un_consoqt+=$cons->conso_quantity; $un_consup+=$cons->conso_u_p; } endforeach;
        foreach($check->items->soins as $soin): if($check->period == $period && $check->done == 0 && $soin->insured !=0){ $un_soinqt+=$soin->act_med_quantity; $un_soinup+=$soin->act_med_u_p; }  endforeach;
        foreach($check->items->hospitalisation as $hosp): if($check->period == $period && $check->done == 0 && $hosp->insured !=0){ $un_hospqt+=$hosp->hosp_quantity; $un_hospup+=$hosp->hosp_u_p; } endforeach;
        //============ Ambulance ==========================
        foreach($check->items->ambulance as $ambu): if($check->period == $period && $check->done == 0){ $un_ambuqt+=$ambu->ambu_quantity; $un_ambuup+=$ambu->ambu_u_p; } endforeach;
    endforeach;


    $un_consotot=$un_consoqt*$un_consup; $un_ambutot=$un_ambuqt*$un_ambuup; $un_hosptot=$un_hospqt*$un_hospup; $un_sointot=$un_soinqt*$un_soinup; $un_mtot=$un_mqt*$un_mup;

    $unveri_tot=$un_cup+$un_lab+$un_mtot+$un_consotot+$un_sointot+$un_hosptot+$un_ambutot;

    echo $unveri_tot ;

?>

