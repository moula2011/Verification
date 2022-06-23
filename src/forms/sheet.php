<?php 
    include('./../../link.php'); 
    $consult =json_decode(file_get_contents('../../data/rugarama.json'));
    error_reporting(1|0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon" />
  <title>Verification Sheet</title>
</head>

<body>
  <?php $today = date('Y-m-d'); $per = date("F-Y", strtotime($today));?>
  <?php 
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
  <table style="border-collapse:collapse; border:2px solid #000; width:50%" cellpadding="0" cellspacing="0" border="1">
    <tr style="border:2px solid #000;">
      <td style="padding-left:10px;" colspan="5">
        <img src="../../img/rssb.PNG" style="position: absolute; width: 123px; height: 62px;" />
        <br /><br /><br /><br />
        <center>
          <div style="background-color:#CCC;"><strong>VERIFICATION SHEET RSSB/CBHI</strong></div>
        </center>
        <table cellspacing="0" cellpadding="0">
          <col width="81" />
          <col width="100" />
          <col width="92" />
          <col width="107" />
          <col width="85" />
          <col width="68" />
          <col width="102" />
          <col width="95" />
          <tr>
            <td colspan="2" width="181">Health Facility </td>
            <td colspan="6" width="549">HC</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">CBHI Section</td>
            <td colspan="6"></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">Administrative District </td>
            <td colspan="6"></td>
          </tr>
        </table>
        <br />

      </td>
    </tr>
    <tr style="border:2px solid #000; padding-left:10px;">
      <td style="padding-left:10px;" colspan="2">
        <table style="border-collapse:collapse;  " border="1" cellspacing="0" cellpadding="0">
          <col width="81" />
          <col width="100" />
          <col width="92" />
          <col width="107" />
          <tr>
            <td colspan="2" width="181">Invoice number / Provider  </td>
            <td colspan="2" width="199">N<sup><u>o</u></sup> </td>
          </tr>
          <tr>
            <td colspan="2">Period</td>

            <td colspan="2">
            </td>
          </tr>
          <tr>
            <td colspan="2">Reception date</td>
            <td colspan="2"><?= $per?></td>
          </tr>
          <tr>
            <td colspan="2">Number of Vouchers</td>
            <td colspan="2"></td>
          </tr>
        </table>
      </td>
      <td style="padding-left:10px;" colspan="3">
        <br /><br />
        <table cellspacing="0" style="border-collapse:collapse;" border="1" cellpadding="0">
          <tr>
            <td colspan="20" width="197">Amount billed</td>
            <td width="69"><?= $tot?></td>
            <td width="75">Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Amount after Verification</td>
            <td><?= $after_amount?></td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Difference + or -     </td>
            <td></td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">RRA Taxes (3%) </td>
            <td>0</td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Medical procedures</td>
            <td>
            </td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Drugs</td>
            <td>
            </td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Ambulance</td>
            <td>
            </td>
            <td>Rwf</td>
          </tr>
        </table> <br />
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" width="181">Amount paid  (in figures):</td>
            <td colspan="2" width="199"></td>
          </tr>
        </table>
      </td>
      <td colspan="3">
        <table cellspacing="0" cellpadding="0">
          <col width="102" />
          <col width="95" />
          <col width="207" />
          <col width="69" />
          <tr>
            <td colspan="4" width="473"> Amount paid (in words):</td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2">&nbsp;</td>
            <td></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr style="border:2px solid #000;">
      <td style=" padding-left:20px;" colspan="5">
        <table style="border-collapse:collapse;" cellspacing="0" border="1" cellpadding="0">
          Observations <br /><br /><br /><br /><br /><br /><br /><br />
          Summary of verification data
          <tr>
            <td width="81">&nbsp;</td>
            <td width="100">Consultation</td>
            <td width="92">Laboratory</td>
            <td width="107">Imaging</td>
            <td width="85">Hospita-<br />
              lization</td>
            <td width="68">Acts &amp; <br />
              Materials</td>
            <td width="102">Ambulance</td>
            <td width="95">Other<br />
              Consumables</td>
            <td width="207">Drugs</td>
            <td width="69">Co-payment</td>
            <td width="">Amount after<br /> Verification</td>
          </tr>
          <tr>
            <td> Amount billed</td>
            <td></td>
            <td></td>
            <td>0</td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> </td>
            <td></td>
          </tr>
          <tr>
            <td>Amount after verification</td>
            <td></td>
            <td></td>
            <td>0</td>
            <td>
            </td>
            <td>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
        <br />
      </td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr style="border:2px solid #000;">
      <td>
        <table cellspacing="0" cellpadding="0">
          <col width="42" />
          <col width="81" />
          <col width="100" />
          <col width="92" />
          <tr>
            <td colspan="2" width="123">Verified by</td>
            <td width="100">&nbsp;</td>
            <td width="92">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td align="right">&nbsp;</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">Signature:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">Names:</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">Medical Benefits Verification Agent / Officer</td>
          </tr>
        </table>
      </td>
      <td colspan="3">
        <table cellspacing="0" cellpadding="0">
          <col width="107" />
          <col width="85" />
          <col width="68" />
          <col width="102" />
          <tr>
            <td colspan="2" width="192">Approved at 1st level</td>
            <td width="68">&nbsp;</td>
            <td width="102">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">Date:</td>
            <td></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Signature:</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Names:</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">CBHI Section Manager                                                                                                               </td>
          </tr>
        </table>
      </td>
      <td>
        <table cellspacing="0" cellpadding="0">
          <col width="95" />
          <col width="207" />
          <tr>
            <td colspan="2" width="302">Approved at 2nd level</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
          </tr>
          <tr>
            <td>Signature:</td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
          </tr>
          <tr>
            <td>Names</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"> Branch supervisor </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr style="border:2px solid #000;">
      <td colspan="3">
        <table cellspacing="0" cellpadding="0">
          <col width="42" />
          <col width="81" />
          <col width="100" />
          <col width="92" />
          <tr>
            <td colspan="2" width="123">Reviewed by</td>
            <td width="100">&nbsp;</td>
            <td width="92">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">Signature:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">Names:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4">Director of Medical Benefits Verification Unit</td>
          </tr>
        </table>
      </td>
      <td colspan="2">
        <table cellspacing="0" cellpadding="0">
          <col width="102" />
          <col width="95" />
          <col width="207" />
          <tr>
            <td colspan="2" width="197">Approved by</td>
            <td width="207"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Signature:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Names:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3">CBHI Medical Benefits Division Manager</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>