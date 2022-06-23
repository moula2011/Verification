<?php 
include('src/load/php/link.php'); 
$consult =json_decode(file_get_contents('data/rugarama.json'));
$drugs =json_decode(file_get_contents('data/drugs.json'));
$consums =json_decode(file_get_contents('data/consums.json'));
$acts =json_decode(file_get_contents('data/acts.json'));
$calender =json_decode(file_get_contents('data/calender.json'));
error_reporting(1|0)
?> 

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="src/css/medi-style.css">
    <link rel="icon" href="img/favicon.ico">
    <script src="jquery-3.3.1.min.js"></script>
    <title>.::CBHI::.</title>
    <script>
        let call = (period,data) => {            

                $.get('src/load/php/check.php?period='+period,function(data){
                    $('#unchecked').html(data);
                });  
            
                $.get('src/load/php/billed.php?period='+period,function(data){
                    $('#billed').html(data);
                    $('#unverify').html(data);
                    // $('#pm').html('<?= date("m-Y",strtotime('period'))?>');
                    $('#pm').html(period);
                    $('#pm1').html(period);
                });     
                
                $.get('src/load/php/verify.php?period='+period,function(data){
                    $('#unverified').html(data);
                });    

                $.get('src/load/php/veri_remain_days.php?period='+period,function(data){
                    $('#remain_days').html(data);
                });   

                $.get('src/load/php/appeal.php?period='+period,function(data){
                    $('#appeal').html(data);
                });   

                $.get('src/load/php/appeal_amount.php?period='+period,function(data){
                    $('#appeal_amount').html(data);
                });  

                $.get('src/load/php/done.php?period='+period,function(data){
                    $('#done').html(data);
                });  
                
                $.get('src/load/php/unveri_tot.php?period='+period,function(data){
                    $('#unverify').html(data);
                });  

                $.get('src/load/php/after_veri.php?period='+period,function(data){
                    $('#after_veri').html(data);
                });  

                $.get('src/load/php/veri_rate.php?period='+period,function(data){
                    $('#veri_rate').html(data);
                });

                $.get('src/load/php/deduct.php?period='+period,function(data){
                    $('#deduct').html(data);
                });

                $.get('src/load/php/deducted.php?period='+period,function(data){
                    $('#deducted').html(data);
                });
            }
                
    </script>
</head>
<body style="background-image: url('img/31.jpg');" id="bg">    
    <div class="medi-menu bg-opacity-50 p-2.5 bg-blue-400 bg-medimenu">
        <div class="pt-0 float-left flex">
            <img src="img/logo_medi.png" alt="" class="ml-6 mb-4">
            <h2 class="hidden md:flex text-2xl text-white align-text-bottom m-1 ml-3">hello</h2>
        </div>
        <nav class="relative container mx-auto w-full px-6" >
            <div class="flex items-center justify-between  ">
                <div class="pt-0 ">
                    <h2 class="text-4xl">&nbsp;</h2>
                </div>
                <div class="flex space-x-2 right-0">
                    <a href="#"><img src="img/home.png" alt=""></a>
                    <a href="#"><img src="img/app.png" alt=""></a>
                    <a href="#"><img src="img/logout.png" alt=""></a>
                </div>
            </div>
        </nav> 
    </div>
    <section id="moula">
        <div class="absolute inset-x-12 h-20 top-0 bg-white" style="opacity: 0.8;">
            <div class="medi-unique flex flex-row" style="top: 25px; height: 50px; width: 720px;">
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">MONTH:</label>
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style="width: 172px; height: 30px;" onchange='call(this.value,<?php echo json_encode($consult); ?>)'>
                        <?php
                            echo '<option value="">select month...</option>';
                            foreach($calender as $per):
                                foreach($per->period as $peri):
                                    $period = $peri->month;
                                    echo '<option value="'.$period.'">'.$period.'</option>';
                                endforeach ; 
                            endforeach ; 
                        ?>                        
                    </select>

                </div>
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">Holidays:</label>
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style=" height: 30px; width:320px;">
                        <?php
                            echo '<option value="">select holidays...</option>';
                            foreach($calender as $per):
                                foreach($per->holidays as $day):
                                    $days = $day->day;
                                    echo '<option value="'.$days.'">'.$days.'</option>';
                                endforeach ; 
                            endforeach ; 
                        ?>        
                    </select>
                </div>
            </div>
        </div> 
        <?php $today = date('Y-m-d'); $per = date("F-Y", strtotime($today));?>
        <div class="medi-container absolute inset-x-12 top-28 bg-white rounded-xl overflow-hidden md:w-100">
            <div class="flex flex-row w-3/5 " style="border-top: 1px solid #52dcff;">
                <a href="cbhi.php" class="mt-4 mx-4 text-2xl">Today</a>
                <a href="src/forms/check.php">
                    <?php $v_c_today=0; foreach($consult as $check): if($check->day == $today && $check->checked ==1){$v_c_today += $check->checked;} endforeach; $c_today =$v_c_today;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unchecked"><?= $c_today ?></b> &nbsp;Unchecked
                    </div> 
                </a>                
                <a href="src/forms/not_verified.php">
                    <?php $v_v=0; foreach($consult as $check): $v_c = $check->checked;$v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <?php $v_v_today=0; foreach($consult as $check): if($check->day == $today && $check->done ==0){$v_c_today = $check->checked;$v_v_today += $check->verified; } endforeach; $v_today =$v_v_today;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unverified"><?= $v_today ?></b> &nbsp;Not Verified
                    </div>
                </a>
            </div> 
            <hr style="border-top: 1px solid #52dcff;">

            <!--=============================== page zosee zifite ibyaruguru============================= -->
            <?php 
                $cup=0;$un_cup=0; $lab=0;$un_lab=0; $tot=0; 
                $mqt=0; $mup=0; $mtot=0; $un_mqt=0; $un_mup=0; $un_mtot=0; 
                $consoqt=0; $consup=0; $consotot=0; $un_consoqt=0; $un_consup=0; $un_consotot=0; 
                $soinqt=0; $soinup=0; $sointot=0; $un_soinqt=0; $un_soinup=0; $un_sointot=0; 
                $hospqt=0; $hospup=0; $hosptot=0;$un_hospqt=0; $un_hospup=0; $un_hosptot=0;
                $ambuqt=0; $ambuup=0; $ambutot=0;$un_ambuqt=0; $un_ambuup=0; $un_ambutot=0;
                $unveri_tot=0; $veriqt=0; $veriup=0; $veritot=0;$served=0; 
                $veriamounted=0;$done=0;$days_left=0;$days_done_to_veri=0; 

                foreach($consult as $check):if($check->day == $today){ $days_done_to_veri += $check->done; $served += $check->served; $done += $check->done;}
                    foreach($check->items->consultation as $consul):if($check->day == $today && $consul->insured !=0){ $cup+=$consul->cons_u_p;} endforeach;
                    foreach($check->items->laboratoire as $labo): if($check->day == $today && $labo->insured !=0){ $lab+=$labo->lab_u_p; } endforeach;
                    foreach($check->items->medicines as $meds):  if($check->day == $today && $meds->insured !=0){  $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; } endforeach;
                    foreach($check->items->consommables as $cons): if($check->day == $today && $cons->insured !=0){ $consoqt+=$cons->conso_quantity; $consup+=$cons->conso_u_p; } endforeach;
                    foreach($check->items->soins as $soin): if($check->day == $today && $soin->insured !=0){ $soinqt+=$soin->act_med_quantity; $soinup+=$soin->act_med_u_p; } endforeach;
                    foreach($check->items->hospitalisation as $hosp):if($check->day == $today && $hosp->insured !=0){ $hospqt+=$hosp->hosp_quantity; $hospup+=$hosp->hosp_u_p; } endforeach;

                    //============ verification ======================
                    foreach($check->items->verification->consultation as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
                    foreach($check->items->verification->medicines as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
                    foreach($check->items->verification->consommables as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
                    foreach($check->items->verification->laboratoire as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
                    foreach($check->items->verification->soins as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
                    foreach($check->items->verification->hospitalisation as $veri):if($check->day == $today){ $veriamounted+=$veri->amounted;}endforeach;
                    //============ Not verified =======================
                    foreach($check->items->consultation as $consul): if($check->day == $today && $check->done == 0 && $consul->insured !=0){$un_cup+=$consul->cons_u_p;} endforeach;
                    foreach($check->items->laboratoire as $labo): if($check->day == $today && $check->done == 0 && $labo->insured !=0){$un_lab+=$labo->lab_u_p;} endforeach;
                    foreach($check->items->medicines as $meds): if($check->day == $today && $check->done == 0 && $meds->insured !=0){ $un_mqt+=$meds->med_quantity; $un_mup+=$meds->med_u_p; } endforeach;
                    foreach($check->items->consommables as $cons): if($check->day == $today && $check->done == 0 && $cons->insured !=0){ $un_consoqt+=$cons->conso_quantity; $un_consup+=$cons->conso_u_p; } endforeach;
                    foreach($check->items->soins as $soin): if($check->day == $today && $check->done == 0 && $soin->insured !=0){ $un_soinqt+=$soin->act_med_quantity; $un_soinup+=$soin->act_med_u_p; }  endforeach;
                    foreach($check->items->hospitalisation as $hosp): if($check->day == $today && $check->done == 0 && $hosp->insured !=0){ $un_hospqt+=$hosp->hosp_quantity; $un_hospup+=$hosp->hosp_u_p; } endforeach;
                    //============ Ambulance ==========================
                    foreach($check->items->ambulance as $ambu): if($check->day == $today && $check->done == 0){ $un_ambuqt+=$ambu->ambu_quantity; $un_ambuup+=$ambu->ambu_u_p; } endforeach;
                    foreach($check->items->ambulance as $ambu):if($check->day == $today){ $ambuqt+=$ambu->ambu_quantity; $ambuup+=$ambu->ambu_u_p; } endforeach;

                endforeach;   
            
                $mtot=$mqt*$mup; $consotot=$consoqt*$consup; $sointot=$soinqt*$soinup; $hosptot=$hospqt*$hospup; $ambutot=$ambuqt*$ambuup;  
                
                $tot=$cup+$lab+$mtot+$consotot+$sointot+$hosptot+$ambutot; 
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
                
                $un_consotot=$un_consoqt*$un_consup; $un_ambutot=$un_ambuqt*$un_ambuup; $un_hosptot=$un_hospqt*$un_hospup; $un_sointot=$un_soinqt*$un_soinup; $un_mtot=$un_mqt*$un_mup;

                $unveri_tot=$un_cup+$un_lab+$un_mtot+$un_consotot+$un_sointot+$un_hosptot+$un_ambutot;

            ?>

            <div class="container flex flex-col items-center px-0 mx-auto mt-2 space-y-1 md:space-y-1 md:flex-row  ">
                <div class="flex flex-col m-2 space-y-2 md:w-1/2">
                    <div class="container flex flex-col items-center px-0 mx-auto mt-2 space-y-1 md:space-y-1 md:flex-row  ">
                        <div class="flex flex-col m-2 space-y-12 md:w-full">
                            <div class="flex flex-row w-100 md:flex ">
                                <div class=" pl-8 py-4 w-1/2 ">
                                    <div class="border-l-4 rounded-l-md flex flex-row border-indigo-500 medi-magic p-3" > 
                                        <img src="img/play2.png" alt="">
                                        <h1 class="text-2xl text-center">
                                            <i id="billed"><?= $tot?></i> Frw
                                        </h1>
                                    </div>
                                    <h1 class="text-1xl text-center">
                                        Billed amount: 
                                    </h1>
                                </div>
                                <div class="pr-8 py-4 w-1/2 ">
                                    <div class="border-l-4 rounded-r-md flex flex-row border-indigo-500 bg-blue-500 medi-magic p-3" > 
                                        <img src="img/play2.png" alt="" style="position:relative;left:-19px;">
                                        <h1 class="text-2xl text-center ml-3">
                                            <i id="after_veri"><?= $after_amount?></i> Frw
                                        </h1>
                                    </div>
                                    <h1 class="text-1xl text-center">
                                        Amount after verification:
                                    </h1>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="container flex flex-col items-center px-0 mx-auto mt-2 bg-gray-light md:flex-row  ">
                        <div class="flex flex-col m-2 space-y-12 md:w-full">
                            <div class="flex flex-row w-100 md:flex ">
                                <div class=" pl-8 py-8 w-1/2 ">
                                    <div class="border-t-4 ml-4 rounded-t-md border-mediblue medi-magic-btn-l p-3" > 
                                        <h1 class="text-3xl text-center">
                                            <i id="veri_rate"><?= round($rate,1)?></i> %
                                        </h1>
                                    </div>
                                    
                                    <div class=" border-indigo-500 ml-4  p-3 bg-cyan-500" style="border: 2px solid #52dcff;"> 
                                        <h1 class="text-1xl text-center">
                                            Verification rate
                                        </h1>
                                    </div>
                                </div>
                                <div class="pr-8 py-8 w-1/2 ">
                                    <div class="border-t-4 ml-4 rounded-t-md border-red-500 medi-magic-btn-r p-3" > 
                                        <h1 class="text-3xl text-center">
                                            <i id="deduct"><?= $veriamounted?></i> Frw
                                        </h1>
                                    </div>
                                    <div class=" border-indigo-500 w-100 ml-4 p-3 bg-red-500" style="border: 2px solid red;">
                                        <h1 class="text-1xl text-center">
                                            Deducted amount, <i id="deducted"><?= round($deducted,1)?></i> %
                                        </h1>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-2 md:w-1/2">
                    <div class="container flex flex-col items-center px-0 mx-auto mt-2 space-y-1 md:space-y-1 md:flex-row  ">
                        <div class="flex flex-col m-2 space-y-12 md:w-full">
                            <div class="flex flex-row w-100 md:flex ">
                                <div class="pr-8 py-4 w-1/2 ">
                                    <div class=" border-indigo-500 w-100 ml-4 p-1 bg-gray-light" style="border: 2px solid #52dcff;">
                                        <h1 class="text-2xl text-center">Univerified</h1>
                                    </div>
                                    <div class="border-b-4 ml-4 flex flex-row rounded-b-md border-mediblue medi-magic-btn-l p-3" > 
                                        <a href="src/forms/not_verified.php">
                                            <div class="flex flex-col w-1/3 ml-10">
                                                <h1 class="text-3xl text-left" id="remain_days"><?= $days_left?></h1>
                                                <h1 class="text-1xl text-left">Patients</h1>
                                                <br>
                                                <span>Amount</span>
                                            </div>
                                        </a>
                                        <a href="src/forms/not_verified.php" class="ml-6">
                                            <div class="flex flex-col w-2/3">
                                                <h1 class="text-2xl text-left" id="pm"><?= $per ?></h1>
                                                <h1 class="text-1xl text-left" id="py">&nbsp;</h1>
                                                <br>
                                                <span><b id="unverify"><?= $unveri_tot?></b> Frw</span>
                                            </div>
                                        </a>
                                        <br> 
                                    </div>
                                </div>
                                <div class=" pl-4 py-4 w-1/2">
                                    <div class=" border-indigo-500 mx-2 p-1 bg-gray-light" style="border: 2px solid #52dcff;"> 
                                        <h1 class="text-2xl text-center" >Appeal ( <i>Redressement</i> )</h1>

                                    </div>
                                    <div class="border-b-4 mx-2 flex flex-row rounded-b-md border-mediblue medi-magic-btn-l p-3" > 
                                        <a href="src/forms/appeal.php">
                                            <div class="flex flex-col w-1/3 ml-10">
                                                <h1 class="text-3xl text-left" id="done"><?= $days_done_to_veri?></h1>
                                                <h1 class="text-1xl text-left">Patients</h1>
                                                <br>
                                                <span>Amount</span>
                                            </div>
                                        </a>
                                        <a href="src/forms/appeal.php" class="ml-10">
                                            <div class="flex flex-col w-2/3 ">
                                                <h1 class="text-2xl text-left" id="pm1"><?= $per ?></h1>
                                                <h1 class="text-1xl text-left" id="py1">&nbsp;</h1>
                                                <br>
                                                <span><b id="appeal_amount"><?= $veriamounted?></b> Frw</span>
                                            </div>
                                        </a>
                                        <br>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container flex flex-col my-2 md:flex-row ">
                        <div class="flex flex-col mx-2 md:w-full"> 
                            <div class=" border-indigo-500 mx-3 p-1 w-full" style="border: 2px solid #52dcff;"> 
                                <h1 class="text-2xl text-center" >Pricing</h1>
                            </div>
                            <div class="flex flex-row gap-2 ml-3 w-full"  style="border: 2px solid #52dcff;">
                                <a href="src/forms/drug.php" class="w-1/4">
                                    <div class="medi-magic medi-magic-btn m-6 py-4 bg-gradient-to-r bg-gray-light rounded-md" >
                                        <?php $num=0;$anum=0; foreach($drugs as $drug): if($drug->verified == 0 AND $drug->insured == 1){ $num +=1;}else{$anum +=1;} endforeach?>
                                        <?php if($num > 0){?><b class=" text-2xl ml-6" style="color: red;"><?= $num?></b> DRUG<?php if($num > 1){echo "S";}?>
                                        <?php }else{?><b class=" text-2xl ml-4" style="color: blue;"><?= $anum?></b> DRUG<?php if($anum > 1){echo "S";}?><?php }?>
                                    </div>
                                </a>
                                <a href="src/forms/consum.php" class="w-1/4">
                                    <div class="medi-magic medi-magic-btn m-6 py-4 bg-gradient-to-r bg-gray-light rounded-md" >
                                        <?php $num=0;$anum=0; foreach($consums as $consum): if($consum->verified == 0 AND $consum->insured == 1){ $num +=1;}else{$anum +=1;} endforeach?>
                                        <?php if($num > 0){?><b class=" text-2xl ml-6" style="color: red;"><?= $num?></b> ITEM<?php if($num > 1){echo "S";}?>
                                        <?php }else{?><b class=" text-2xl ml-4" style="color: blue;"><?= $anum?></b> ITEM<?php if($anum > 1){echo "S";}?><?php }?>
                                    </div>
                                </a>
                                <a href="src/forms/medical_act.php" class="w-1/4">
                                    <div class="medi-magic medi-magic-btn m-6 py-4 bg-gradient-to-r bg-gray-light rounded-md" >
                                    <?php $num=0;$anum=0; foreach($acts as $act): if($act->verified == 0 AND $act->insured == 1){ $num +=1;}else{$anum +=1;} endforeach?>
                                        <?php if($num > 0){?><b class=" text-2xl ml-6" style="color: red;"><?= $num?></b> ITEM<?php if($num > 1){echo "S";}?>
                                        <?php }else{?><b class=" text-2xl ml-4" style="color: blue;"><?= $anum?></b> ITEM<?php if($anum > 1){echo "S";}?><?php }?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr style="border-top: 2px solid #52dcff;">
            
            <div class="container flex flex-col items-center px-0 mx-auto mt-8 space-y-0 md:space-y-0 md:flex-row  ">
                <div class="flex flex-col m-2 space-y-12 md:w-full">
                    <div class="flex flex-row ">
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <a href="src/forms/tool.php">
                                <img width="45px" height="25px" class="medi-center" src="img/clipboard.png" alt="">
                                <h1 class="text-2xl text-center" >Report of medical verification</h1>
                            </a>
                        </div>
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <a href="src/forms/utilization.php" target="parent">
                                <img width="45px" height="25px" class="medi-center py-2" src="img/health-check.png" alt="">
                                <h1 class="text-2xl text-center" >CBHI Utilization of medical <br> services Monthly</h1>
                            </a>
                        </div>
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <a href="src/forms/sheet.php" target="parent">
                                <img width="45px" height="25px" class="medi-center" src="img/balance-sheet.png" alt="">
                                <h1 class="text-2xl text-center" > Verification sheet</h1>
                            </a>
                        </div>
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <a href="src/forms/verified_invoice.php" target="parent">
                                <img width="45px" height="25px" class="medi-center" src="img/invoice.png" alt="">
                                <h1 class="text-2xl text-center" >Verified invoice</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 2px solid #52dcff;">
        </div>
    </section >
<!-- <script src="src/load/js/load.js"></script> -->
</body>
</html>