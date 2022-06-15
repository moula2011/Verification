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
      $i=0; foreach($consult as $invoice):  $i++;
      foreach($invoice->items->verification->consultation  as $consult):endforeach;
      foreach($invoice->items->verification->hospitalisation as $hosp):endforeach;
    ?>
    <tr>
      <td class="medi-btn text-center"><?= $i?></td>
      <td class="medi-btn p-2 text-center"><?= 0?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->client_id?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->day?></td>
      <td class="medi-btn p-2 text-center"><?= $invoice->cat?></td>
      <td class="medi-btn p-2"><?= $invoice->bene?></td>
      <td class="medi-btn p-2"><?= $invoice->bene_insu_code?></td>
      <td class="medi-btn p-2"><?= $invoice->age?></td>
      <td class="medi-btn p-2"><?= $invoice->sex?></td>
      <td class="medi-btn p-2"><?= $invoice->chef?></td>
      <td class="medi-btn p-2"><?= $invoice->insurance_code?></td>
    </tr>

    <?php endforeach; ?>
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