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
    foreach($consult as $check):if($check->day == $today){ $days_done_to_veri += $check->done; $served += $check->served; $done += $check->done;}
      //====================================Billed====================================================
      foreach($check->items->consultation as $consul):if($check->day == $today && $consul->insured !=0){ $cup+=$consul->cons_u_p;} endforeach;
      foreach($check->items->laboratoire as $labo): if($check->day == $today && $labo->insured !=0){ $lab+=$labo->lab_u_p; } endforeach;
      foreach($check->items->medicines as $meds):  if($check->day == $today && $meds->insured !=0){  $mqt=$meds->med_quantity; $mup=$meds->med_u_p; $mtot+=$mqt*$mup;} endforeach;
      foreach($check->items->consommables as $cons): if($check->day == $today && $cons->insured !=0){ $consoqt+=$cons->conso_quantity; $consup+=$cons->conso_u_p; $consotot+=$consoqt*$consup; } endforeach;
      foreach($check->items->soins as $soin): if($check->day == $today && $soin->insured !=0){ $soinqt=$soin->act_med_quantity; $soinup=$soin->act_med_u_p; $sointot+=$soinqt*$soinup;} endforeach;
      foreach($check->items->hospitalisation as $hosp):if($check->day == $today && $hosp->insured !=0){ $hospqt=$hosp->hosp_quantity; $hospup=$hosp->hosp_u_p;$hosptot+=$hospqt*$hospup; } endforeach;

      //=====================================after verification========================================
      foreach($check->items->verification->consultation as $consul):if($check->day == $today){ $af_cup+=$consul->item_u_p;$conded+=$consul->amounted;} endforeach;
      foreach($check->items->verification->laboratoire as $labo): if($check->day == $today){ $af_lab+=$labo->item_u_p;$laded+=$labo->amounted; } endforeach;
      foreach($check->items->verification->medicines as $meds):  if($check->day == $today){  $af_mqt=$meds->item_quantity; $af_mup=$meds->item_u_p; $af_mtot+=$af_mqt*$af_mup;$meded+=$meds->amounted;} endforeach;
      foreach($check->items->verification->consommables as $cons): if($check->day == $today){ $af_consoqt=$cons->item_quantity; $af_consup=$cons->item_u_p; $af_consotot+=$af_consoqt*$af_consup;$consoded+=$cons->amounted; } endforeach;
      foreach($check->items->verification->soins as $soin): if($check->day == $today){ $af_soinqt=$soin->item_quantity; $af_soinup=$soin->item_u_p; $af_sointot+=$af_soinqt*$af_soinup; $soded+=$soin->amounted;} endforeach;
      foreach($check->items->verification->hospitalisation as $hosp):if($check->day == $today){ $af_hospqt=$hosp->item_quantity; $af_hospup=$hosp->item_u_p; $af_hosptot+=$af_hospqt*$af_hospup; $hoded+=$hosp->amounted;} endforeach;
      foreach($check->items->verification->ambulance as $ambu):if($check->day == $today){ $af_ambuqt=$ambu->item_quantity; $af_ambuup=$ambu->item_u_p; $af_ambutot+=$af_ambuqt*$af_ambuup;$ambded+=$ambu->amounted; } endforeach;
      foreach($check->items->verification->musa_tm as $tm):if($check->day == $today ){ $af_tmup+=$tm->item_u_p; } endforeach;
    endforeach;     
    //====================================Billed====================================================
    $af_tambu=$af_ambutot*0.1; $af_gtt=$af_tmup+$af_tambu;

    $gtt=$cup+$lab+$mtot+$consotot+$sointot+$hosptot+$af_ambutot;
    $billed_amount=$gtt-$af_gtt;

    //=====================================after verification========================================
    $af_tot=$af_cup; 
    $af_co_pay=$af_tmup+$af_tambu;  $af_amount_bill=$af_tot-$af_gtt;
    $af_medi_pro=$billed_amount+$af_mtot;
    $totded=$conded+$laded+$meded+$consoded+$soded+$hoded;
    $ded=$billed_amount-$totded;
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
            <td colspan="2" width="181">Health Facility</td>
            <td colspan="6" width="549">
              <?php 
                $section = "SELECT * FROM address  LIMIT 1";// get the location 
                $retval = mysqli_query($link,$section);
                if(! $retval )
                {
                  die('Could not get data: ' . mysqli_error($link));
                }    
                while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
                {
                  $district=$row['district'];
                  $section1=$row['hc'];
                  echo $row['hc'];
                }
              ?>
              HC
            </td>
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
            <td colspan="6">
              <?php 
                $section = "SELECT * FROM address  LIMIT 1";// get the location 
                $retval = mysqli_query($link,$section);
                if(! $retval )
                {
                  die('Could not get data: ' . mysqli_error($link));
                }    
                while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
                {
                  $district=$row['district'];
                  $section1=$row['hc'];
                  echo $row['hc'];
                }
              ?>
            </td>
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
            <td colspan="2">Administrative District</td>
            <td colspan="6">
              <?php 
                $section = "SELECT * FROM address  LIMIT 1";// get the location 
                $retval = mysqli_query($link,$section);
                if(! $retval )
                {
                  die('Could not get data: ' . mysqli_error($link));
                }    
                while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
                {
                  $district=$row['district'];
                  $section1=$row['hc'];
                  echo $row['district'];
                }
              ?>
            </td>
          </tr>
        </table>
        <br />
      </td>
    </tr>
    <?php
      $facyear= date("Y", strtotime($per));
      $facmonth =mb_substr($per, 0, 3);
      $where=mb_substr($per,9, 15);
      switch ($facmonth)
      {
        case "Jan":
            $facmonth="7";
            break;
        case "Feb":
            $facmonth="8";
            break;
        case "Mar":
            $facmonth="9";
            break;
        case "Apr":
              $facmonth="10";
              break;
        case "May":
              $facmonth="11";
              break;
        case "Jun":
              $facmonth="12";
              break;
        case "Jul":
              $facmonth="1";
              break;
        case "Aug":
              $facmonth="2";
              break;
        case "Sep":
              $facmonth="3";
              break;
        case "Oct":
              $facmonth="4";
              break;
        case "Nov":
              $facmonth="5";
              break;
        case "Dec":
              $facmonth="6";
              break;
                
        default:
            echo "error:WRONG MONTH";
      }
    ?>
    <tr style="border:2px solid #000; padding-left:10px;">
      <td style="padding-left:10px;" colspan="2">
        <table style="border-collapse:collapse;margin-right: 60px;" border="1" cellspacing="0" cellpadding="0">
          <col width="81" />
          <col width="100" />
          <col width="92" />
          <col width="107" />
          <tr>
            <td colspan="2" width="239" >Invoice number / Provider</td>
            <td colspan="2" width="199">N<sup><u>o</u></sup><?=$facmonth;?> </td>
          </tr>
          <tr>
            <td colspan="2">Period</td>
            <td colspan="2"><?= $per?></td>
          </tr>
          <tr>
            <td colspan="2">Reception date</td>
            <td colspan="2"><?= date('d-F-Y') ?></td>
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
            <td width="69"><?= $billed_amount?></td>
            <td width="75">Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Amount after Verification</td>
            <td><?= $totded?></td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Difference + or -</td>
            <td><?= $totded?></td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">RRA Taxes (3%)</td>
            <td>0</td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Medical procedures</td>
            <td><?= $af_medi_pro?></td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Drugs</td>
            <td><?=$af_mtot?></td>
            <td>Rwf</td>
          </tr>
          <tr>
            <td colspan="20">Ambulance</td>
            <td><?=$af_ambutot?></td>
            <td>Rwf</td>
          </tr>
        </table> <br />
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" width="199">Amount paid (in figures):</td>
            <td colspan="2" width="199"><?=$ded?></td>
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
            <td colspan="4" width="473">Amount paid (in words):</td>
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
            <td width="95">Other<br />Consumables</td>
            <td width="207">Drugs</td>
            <td width="69">Co-payment</td>
            <td width="">Amount after<br /> Verification</td>
          </tr>
          <tr>
            <td>Amount billed</td>
            <td><?=$cup?></td>
            <td><?=$lab?></td>
            <td>0</td>
            <td><?=$hosptot?> </td>
            <td><?=$sointot?></td>
            <td><?=$af_ambutot?></td>
            <td><?=$consotot?></td>
            <td><?=$mtot?></td>
            <td><?=$af_co_pay?> </td>
            <td><?=$billed_amount?></td>
          </tr>
          <tr>
            <td>Amount after verification</td>
            <td><?=$af_cup?></td>
            <td><?=$af_lab?></td>
            <td>0</td>
            <td><?=$af_hosptot?> </td>
            <td><?=$af_sointot?></td>
            <td><?=$af_ambutot?></td>
            <td><?=$af_consotot?></td>
            <td><?=$af_mtot?></td>
            <td><?=$af_co_pay?> </td>
            <td><?=$ded?></td>
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
            <td colspan="4">CBHI Section Manager</td>
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
            <td colspan="2">Branch supervisor</td>
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