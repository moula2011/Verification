
<?php
ini_set('memory_limit', '5000M');
ini_set('max_execution_time', 0);
error_reporting(1|0);
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
    <link rel="icon" href="img/favicon.ico">
    <script src="jquery-3.3.1.min.js"></script>
    <title>.::CBHI::.</title>

<title>DATA COLLECTION TOOL ON UTMS-AUGUST 2019</title>
</head>

<body>
  <?php
    $consult =json_decode(file_get_contents('../../data/rugarama.json'));
  ?>
<div style="width:142%; margin: 2px;">
  <table width="0" style="margin: 20px;font-size:15px; border-collapse: collapse;"  border="1" cellspacing="0" cellpadding="3">
    <tr>
      <td rowspan="3" width="20"><strong>No</strong></td>
      <td rowspan="3" width="180"><strong>DATE</strong></td>
      <td colspan="14">&nbsp;</td>
      <td colspan="14"><strong>PATIENTS    FREQUENTING HEALTH FACILITIES</strong></td>
      <td colspan="11"><strong>HEALTH    CARE SERVICES</strong></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>NAMES OF    PATIENT</strong></td>
      <td colspan="2"><strong>#Patients/    Gender</strong></td>
      <td colspan="2"><strong>#Patients</strong></td>
      <td width="50"><strong>#Total Patients</strong></td>
      <td width="69"><strong>ID Number/<br />
        Application<br />
        Number<br />
      </strong></td>
      <td colspan="3"><strong>#Patients/    Distribution by Age  </strong></td>
      <td colspan="4"><strong>#Patients/    Distribution by Ubudehe Category </strong></td>
      <td width="45"><strong>Z<br />
        (Zone) </strong></td>
      <td width="39"><strong>HZ<br />
        (Hors Zone)</strong></td>
      <td width="48"><strong><br />
        HD<br />
        (Hors<br />
        District)</strong></td>
      <td width="51"><strong><br />
        Out Patients </strong></td>
      <td width="45"><strong><br />
        In Patient </strong></td>
      <td width="50"><strong><br />
        <br />
        Prisoner<br />
      </strong></td>
      <td width="54"><strong><br />
        <br />
        Transfer Case<br />
      </strong></td>
      <td width="71"><strong>Emergency    Case</strong></td>
      <td width="68"><strong>Transfer    by <br />
        Ambulance<br />
      </strong></td>
      <td width="68"><strong>Transfer    without <br />
        Ambulance<br />
      </strong></td>
      <td width="58"><strong><br />
        Accident Case<br />
      </strong></td>
      <td width="24"><strong>X-Ray</strong></td>
      <td width="34"><strong><br />
        CT Scan Case<br />
      </strong></td>
      <td width="33"><strong><br />
        MRI Case<br />
      </strong></td>
      <td width="88"><strong> Days of Hospitalization<br />
        <br />
        <br />
        <br />
      </strong></td>
      <td width="66"><strong>Medicines    subjected of stock out <br />
        (to be specified)</strong></td>
      <td width="68"><strong>Number    of patients who did not received all drugs prescribed </strong></td>
      <td width="72"><strong>Laboratory    Tests not provided <br />
        (to be specified)</strong></td>
      <td width="66"><strong>Number    of patients who did not received all laboratory tests precribed</strong></td>
      <td width="58"><strong>X-Ray <br />
        not provided <br />
        (to be specified)</strong></td>
      <td width="58"><strong>Number    of patients who did not received X-Ray precribed</strong></td>
      <td width="58"><strong>CT    Scan not provided<br />
        (to be specified)</strong></td>
      <td width="58"><strong>Number    of patients who did not received CT Scan precribed</strong></td>
      <td width="58"><strong>MRI    not provided<br />
        (to be specified)</strong></td>
      <td width="58"><strong>Number    of patients who did not received MRI precribed</strong></td>
      <td width="58"><strong>Total Billed Amount</strong></td>
      <td width="58"><strong>Total TM</strong></td>
      <td width="58"><strong>Total to be paid</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><strong>Male</strong></td>
      <td><strong>Female</strong></td>
      <td><strong>New case</strong></td>
      <td><strong>Old case</strong></td>
      <td><strong>TOTAL</strong></td>
      <td width="69">&nbsp;</td>
      <td><strong>&lt;5 years</strong></td>
      <td><strong>5-19 years</strong></td>
      <td><strong>≥20 years</strong></td>
      <td width="60"><strong>Category 1</strong></td>
      <td width="60"><strong>Category 2</strong></td>
      <td width="60"><strong>Category 3</strong></td>
      <td width="60"><strong>Category 4</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="50">&nbsp;</td>
      <td width="54">&nbsp;</td>
      <td width="71">&nbsp;</td>
      <td width="68">&nbsp;</td>
      <td width="68">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td width="24">&nbsp;</td>
      <td width="34">&nbsp;</td>
      <td width="33">&nbsp;</td>
      <td width="88">&nbsp;</td>
      <td width="66">&nbsp;</td>
      <td width="68">&nbsp;</td>
      <td width="72">&nbsp;</td>
      <td width="66">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td width="58">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php 
      $i=0; foreach($consult as $util):  $i++;
      foreach($util->items->verification->consultation  as $consult):endforeach;
      foreach($util->items->verification->hospitalisation as $hosp):endforeach;
    ?>
    <tr>
      <td class="medi-btn text-center"><?= $i?></td>
      <td class="medi-btn p-2"><?= $util->day?></td>
      <td class="medi-btn p-2"><?= $util->bene?></td>
      <td class="medi-btn p-2"><?php if($util->sex == "M") {echo $m=1;}?></td>
      <td class="medi-btn p-2"><?php if($util->sex == "F") {echo $f=1;}?></td>
      <td class="medi-btn p-2"><?php if($consult->cases == "0") {echo 1;}else{echo 0;}?></td>
      <td class="medi-btn p-2"><?php if($consult->cases == "1") {echo 1;}else{echo 0;}?></td>
      <td class="medi-btn p-2"><?php if($util->served == "1") {echo $patot=1;}else{echo 0;}?></td>
      <td class="medi-btn p-2"><?= $util->insurance_code?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->age < 5){echo $age=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->age <19){echo $age=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->age >= 20){echo $age=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->cat == 1){echo $cat=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->cat == 2){echo $cat=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->cat == 3){echo $cat=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->cat == 4){echo $cat=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->dep == "Z"){echo $dep=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->dep == "HZ"){echo $dep=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($util->dep == "HD"){echo $dep=1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($hosp->item_quantity <= 0){echo $outp = 1 ;}else{echo 0;} ?></td>
      <td class="medi-btn p-2 text-center"><?php if($hosp->item_quantity != 0 ){echo $inp=1 ;}else{echo 0 ;} ?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td><?= 0;?></td>
      <td>&nbsp;</td>
      <td><?= 0;?></td>
      <td>&nbsp;</td>
    </tr>
    <?php  ?>
    <?php endforeach; ?>
    <tr>
      <td colspan="42"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>
</body>
</html>