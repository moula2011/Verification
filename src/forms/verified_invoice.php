<?php
ini_set('memory_limit', '5000M');
ini_set('max_execution_time', 0);
error_reporting(1 | 0);
include('./../../link.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/main.css">
  <link rel="stylesheet" href="src/css/medi-style.css">
  <link rel="icon" href="../../img/favicon.ico">
  <script src="../../jquery-3.3.1.min.js"></script>
  <title>.::Facture MUSA::.</title>
</head>

<body>
  <?php
    $consult =json_decode(file_get_contents('../../data/rugarama.json'));

    $cup=0;$un_cup=0; $lab=0;$un_lab=0; $tot=0; 
    $mqt=0; $mup=0; $mtot=0; $un_mqt=0; $un_mup=0; $un_mtot=0; 
    $consoqt=0; $consup=0; $consotot=0; $un_consoqt=0; $un_consup=0; $un_consotot=0; 
    $soinqt=0; $soinup=0; $sointot=0; $un_soinqt=0; $un_soinup=0; $un_sointot=0; 
    $hospqt=0; $hospup=0; $hosptot=0;$un_hospqt=0; $un_hospup=0; $un_hosptot=0;$unveri_tot=0; 
    $veriqt=0; $veriup=0; $veritot=0;$served=0; 
    $veriamounted=0;$done=0;$days_left=0;$days_done_to_veri=0;

    foreach($consult as $check):if($check->day == $today){ $days_done_to_veri += $check->done; $served += $check->served; $done += $check->done;}
      foreach($check->items->consultation as $consul):if($check->day == $today){ $cup+=$consul->cons_u_p;} endforeach;
      foreach($check->items->laboratoire as $labo): if($check->day == $today){ $lab+=$labo->lab_u_p; } endforeach;
      foreach($check->items->medicines as $meds):  if($check->day == $today){  $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; } endforeach;
      foreach($check->items->consommables as $cons): if($check->day == $today){ $consoqt+=$cons->conso_quantity; $consup+=$cons->conso_u_p; } endforeach;
      foreach($check->items->soins as $soin): if($check->day == $today){ $soinqt+=$soin->act_med_quantity; $soinup+=$soin->act_med_u_p; } endforeach;
      foreach($check->items->hospitalisation as $hosp):if($check->day == $today){ $hospqt+=$hosp->hosp_quantity; $hospup+=$hosp->hosp_u_p; } endforeach;
      //============= verification ======================
      foreach($check->items->verification->consultation as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
      foreach($check->items->verification->medicines as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
      foreach($check->items->verification->consommables as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
      foreach($check->items->verification->laboratoire as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
      foreach($check->items->verification->soins as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
      foreach($check->items->verification->hospitalisation as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
      //============ Not verified =======================
      foreach($check->items->consultation as $consul): if($check->day == $today && $check->done == 0){$un_cup+=$consul->cons_u_p;} endforeach;
      foreach($check->items->laboratoire as $labo): if($check->day == $today && $check->done == 0){$un_lab+=$labo->lab_u_p;} endforeach;
      foreach($check->items->medicines as $meds): if($check->day == $today && $check->done == 0){ $un_mqt+=$meds->med_quantity; $un_mup+=$meds->med_u_p; } endforeach;
      foreach($check->items->consommables as $cons): if($check->day == $today && $check->done == 0){ $un_consoqt+=$cons->conso_quantity; $un_consup+=$cons->conso_u_p; } endforeach;
      foreach($check->items->soins as $soin): if($check->day == $today && $check->done == 0){ $un_soinqt+=$soin->act_med_quantity; $un_soinup+=$soin->act_med_u_p; }  endforeach;
      foreach($check->items->hospitalisation as $hosp): if($check->day == $today && $check->done == 0){ $un_hospqt+=$hosp->hosp_quantity; $un_hospup+=$hosp->hosp_u_p; } endforeach;
    endforeach;   

    $mtot=$mqt*$mup; $sointot=$soinqt*$soinup; $hosptot=$hospqt*$hospup; $consotot=$consoqt*$consup; 
    
    $tot=$cup+$lab+$mtot+$consotot+$sointot+$hosptot; 
    if($tot !=0)
    $deducted = $veriamounted*100/$tot;
    else
    $deducted = 0;

    $after_amount = $tot - $veriamounted;

    if($v_check !=0)
    $rate = $done*100/$v_check;
    else
    $rate=0;

    $days_left=$served-$done;  
    
    $un_consotot=$un_consoqt*$un_consup; $un_hosptot=$un_hospqt*$un_hospup; $un_sointot=$un_soinqt*$un_soinup; $un_mtot=$un_mqt*$un_mup;

    $unveri_tot=$un_cup+$un_lab+$un_mtot+$un_consotot+$un_sointot+$un_hosptot;
  ?>
  <!--<table width="0" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="222" scope="col"><b>PROVINCE/MVK</b></td>
    <th width="17" scope="col">&nbsp;</th>
    <th width="188" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td scope="row"><b>ADMINISTRATIVE DISTRICT</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td scope="row"><b>HEALTH FACILITY<b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td scope="row"><b>CODE/HEALTH FACILITY</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>-->

  <br />

  <table style="font-size:13px; border-collapse: collapse;" widtd="0" border="1" bordercolor="#999999" cellspacing="0" cellpadding="0">
    <tr>
      <th bgcolor="#DDEEFF" style=" text-transform:uppercase; height:40px; font-size:16px;" colspan="22">S U M M A R Y OF V OUC H E R S F O R R W A N D A S O C I A L S E C U R I T Y B O A D (R S S B) / CBHI/ </th>
    </tr>
    <tr bgcolor="">
      <td scope="col"><strong>No</strong></td>
      <td scope="col"><strong>VOUCHER No</strong></td>
      <td scope="col"><strong>CODE</strong></td>
      <td scope="col"><strong>DATE</strong></td>
      <td scope="col"><strong>MEMBER'S CATEGORY</strong></td>
      <td scope="col"><strong>BENEFICIARY'S NAMES </strong></td>
      <td scope="col"><strong>ID NUMBER / APPLICATION NUMBER OF BENEFICIARY</strong></td>
      <td scope="col"><strong>BENEFICIARY'S AGE</strong></td>
      <td scope="col"><strong>BENEFICIARY'S SEX</strong></td>
      <td scope="col"><strong>HEAD HOUSEHOLD'S NAMES </strong></td>
      <td scope="col"><strong>ID NUMBER / APPLICATION NUMBER OF HEAD OF HOUSEHOLD</strong></td>
      <td scope="col"><strong>COST FOR CONSULTATION</strong></td>
      <td scope="col"><strong>COST FOR LABORATORY TESTS</strong></td>
      <td scope="col"><strong>COST FOR MEDICAL IMAGING</strong></td>
      <td scope="col"><strong>COST FOR HOSPITALISATION</strong></td>
      <td scope="col"><strong>COST FOR PROCEDURES AND MATERIALS</strong></td>
      <td scope="col"><strong>COST FOR AMBULANCE</strong></td>
      <td scope="col"><strong>COST FOR OTHER CONSUMABLES</strong></td>
      <td scope="col"><strong>COST FOR MEDECINES</strong></td>
      <td scope="col"><strong>TOTAL AMOUNT</strong></td>
      <td scope="col"><strong>DETERRENT FEES</strong></td>
      <td scope="col"><strong>TOTAL AMOUNT TO BE PAID</strong></td>
      <!-- <td  scope="col"><strong>AMOUNT AFTER VERIFICATION</strong></td > -->

    </tr>

    <tr bgcolor="" style=" font-size:10px;">
      <td scope="col"></td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">&nbsp;</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">100%</td>
      <td scope="col">200RWF/0%/10%</td>
      <td scope="col">TOTAL AMOUNT -DETERRENT FEES</td>
      <td scope="col"></td>
      <td scope="col"></td>

    </tr></strong>
    </tr>
    <?php 
      $i=0;$labo=0; 
      $mqt=0; $mup=0; $mtot=0;
      foreach($consult as $invoice):  $i++;
      foreach($invoice->items->consultation  as $cons):endforeach;
      foreach($invoice->items->laboratoire as $labo): $labos+=$labo->lab_u_p;  endforeach;
      foreach($invoice->items->verification->consultation  as $consult):endforeach;
      foreach($invoice->items->verification->hospitalisation as $hosp):endforeach;
      $mtot=$mqt*$mup;
      foreach($invoice->items->medicines as $meds): $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; 
     ?>
    <tr>
      <td class="medi-btn text-center"><?= $i?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->voucher_no?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->client_id?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->day?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->cat?></td>
      <td class="medi-btn p-2"><?= $invoice->bene?></td>
      <td class="medi-btn p-2"><?= $invoice->bene_insu_code?></td>
      <td class="medi-btn p-2"><?= $invoice->age?></td>
      <td class="medi-btn p-2"><?= $invoice->sex?></td>
      <td class="medi-btn p-2"><?= $invoice->chef?></td>
      <td class="medi-btn p-2"><?= $invoice->insurance_code?></td>
      <td class="medi-btn p-2"><?= $cons->cons_u_p ?></td>
      <td class="medi-btn p-2"><?php if($labos !=0){echo $labos;}else{echo 0;} ?></td>
      <td class="medi-btn p-2"><?php if($mtot !=0){echo $mtot;}else{echo 0;} ?></td>
    </tr>

    <?php endforeach; endforeach;?>
    <tr>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><strong>TOTAL</strong></td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>

    </tr>
  </table>
</body>

</html>