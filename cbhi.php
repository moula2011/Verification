<?php 
include('src/load/php/link.php'); 
$consult =json_decode(file_get_contents('data/rugarama.json'));

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
            // let client=data.filter((data) => data.period==period);             
            // let cnt=0;
            // let i=client.map(() => cnt++);
            // document.getElementById('uncheckd').innerHTML=cnt;

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

                $.get('src/load/php/drugs.php?period='+period,function(data){
                    $('#drugs').html(data);
                });  

                $.get('src/load/php/acts.php?period='+period,function(data){
                    $('#acts').html(data);
                }); 
                
                $.get('src/load/php/consum.php?period='+period,function(data){
                    $('#consum').html(data);
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
            <div class="medi-unique top-10 flex flex-row" style="width: 720px;">
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">MONTH:</label>
                    <select class="form-select px-12 py-2 border-black rounded-t-lg" onchange='call(this.value,<?php echo json_encode($consult); ?>)'>
                        <?php

                            $qry=mysqli_query($link,"SELECT DISTINCT period FROM orders ORDER BY period");
                            if(!$qry){ die('Error :'.mysqli_error($link)); }
                            while($row=mysqli_fetch_assoc($qry)){
                                $period=$row['period'];
                                echo '<option value="'.$period.'">'.$period.'</option>';
                                
                            }            
                            
                            // foreach($consult as $check):
                            //     $period = $check->period;
                            // endforeach ; 
                            // echo '<option value="'.$period.'">'.$period.'</option>';
                        ?>                        
                    </select>

                </div>
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">Holidays:</label>
                    <select class="form-select px-12 py-2 border-black rounded-t-lg" style="width:320px;">
                    <?php
                            $qry=mysqli_query($link,"SELECT DISTINCT date,name FROM holidays ORDER BY date");
                            if(!$qry){ die('Error :'.mysqli_error($link)); }
                            while($row=mysqli_fetch_assoc($qry)){
                                $holiday=$row['date'];
                                $name=$row['name'];
                                echo '<option value="'.$holiday.'">'.$holiday.' - '.$name.'</option>';
                            }
                        ?>        
                    </select>
                </div>
            </div>
        </div> 
        <div class="medi-container absolute inset-x-12 top-28 bg-white rounded-xl overflow-hidden md:w-100">
            <div class="flex flex-row w-3/5 " style="border-top: 1px solid #52dcff;">
                <a href="cbhi.php" class="mt-4 mx-4 text-2xl">Today</a>
                <a href="src/forms/check.php">
                    <?php $v_c=0; $v_v=0; foreach($consult as $check): $v_c += $check->checked; $v_v += $check->verified; endforeach; $v_check =$v_c - $v_v;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unchecked"><?= $v_check; ?></b> &nbsp;Unchecked
                    </div>
                </a>                
                <a href="src/forms/not_verified.php">
                    <?php $v_v=0; foreach($consult as $check): $v_c = $check->checked;$v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unverified"><?= $v_check;  ?></b> &nbsp;Not Verified
                    </div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">

            <!--=============================== page zosee zifite ibyaruguru============================= -->
            <?php
                // foreach($consult as $check): 
                    $cqt=0;
                    $cupp=0;
                    $cstot=0;
                foreach($check->items->medicines as $meds): $mqt=$meds->med_quantity; $mup=$meds->med_u_p; $mtot=$qt*$up; endforeach;
                // foreach($check->items->consommables as $cons): $qt=$cons->conso_quantity; $up=$cons->conso_u_p; $ctot=$qt*$up; endforeach;
                foreach($check->items->consultation as $consul): $cupp+=$consul->cons_u_p; endforeach;
                $cstot=$cqt; 
                $tot=$cstot;
                // endforeach;
            ?>
            <?php 
                $cup=0; $lab=0; $tot=0; 
                $mqt=0; $mup=0; $mtot=0; 

                foreach($consult as $check): $v_c = $check->checked;$v_v += $check->verified; 
                    foreach($check->items->consultation as $consul): $cup+=$consul->cons_u_p; endforeach;
                    foreach($check->items->laboratoire as $labo): $lab+=$labo->lab_u_p; endforeach;
                    foreach($check->items->medicines as $meds): $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; endforeach;

                    $mtot=$mqt*$mup;
                endforeach;  
                $tot=$cup+$lab+$mtot; 

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
                                            <i id="after_veri">0</i> Frw
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
                                            <i id="veri_rate">0</i> %
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
                                            <i id="deduct">0</i> Frw
                                        </h1>
                                    </div>
                                    <div class=" border-indigo-500 w-100 ml-4 p-3 bg-red-500" style="border: 2px solid red;">
                                        <h1 class="text-1xl text-center">
                                            Deducted amount, <i id="deducted">0</i> %
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
                                                <h1 class="text-3xl text-left" id="remain_days">0</h1>
                                                <h1 class="text-1xl text-left">Days</h1>
                                                <br>
                                                <span>Amount</span>
                                            </div>
                                        </a>
                                        <a href="src/forms/not_verified.php" class="ml-6">
                                            <div class="flex flex-col w-2/3">
                                                <h1 class="text-2xl text-left" id="pm">Month</h1>
                                                <h1 class="text-1xl text-left" id="py">&nbsp;</h1>
                                                <br>
                                                <span><b id="unverify">0</b> Frw</span>
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
                                                <h1 class="text-3xl text-left" id="appeal">0</h1>
                                                <h1 class="text-1xl text-left">Days</h1>
                                                <br>
                                                <span>Amount</span>
                                            </div>
                                        </a>
                                        <a href="src/forms/appeal.php" class="ml-10">
                                            <div class="flex flex-col w-2/3 ">
                                                <h1 class="text-2xl text-left" id="pm1">Month</h1>
                                                <h1 class="text-1xl text-left" id="py1">&nbsp;</h1>
                                                <br>
                                                <span><b id="appeal_amount">0</b> Frw</span>
                                            </div>
                                        </a>
                                        <br>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container flex flex-col my-2 md:flex-row  ">
                        <div class="flex flex-col mx-2 md:w-full">
                            <div class=" border-indigo-500 mx-3 p-1 w-full" style="border: 2px solid #52dcff;"> 
                                <h1 class="text-2xl text-center" >Pricing</h1>
                            </div>
                            <div class="flex flex-row gap-2 ml-3 w-full"  style="border: 2px solid #52dcff;">
                                <a href="src/forms/drug.php" class="w-1/4">
                                    <div class="medi-magic medi-magic-btn m-6 py-4 bg-gradient-to-r bg-gray-light rounded-md" >
                                        <h1 class="text-1xl text-center" ><b id="drugs">0</b> Drugs</h1>
                                    </div>
                                </a>
                                <a href="src/forms/consum.php" class="w-1/4">
                                    <div class="medi-magic medi-magic-btn m-6 py-4 bg-gradient-to-r bg-gray-light rounded-md" >
                                        <h1 class="text-1xl text-center" ><b id="consum">0</b> Consumables</h1>
                                    </div>
                                </a>
                                <a href="src/forms/medical_act.php" class="w-1/4">
                                    <div class="medi-magic medi-magic-btn m-6 py-4 bg-gradient-to-r bg-gray-light rounded-md" >
                                        <h1 class="text-1xl text-center" ><b id="acts">0</b> Acts</h1>
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
                            <img width="45px" height="25px" class="medi-center" src="img/clipboard.png" alt="">
                            <h1 class="text-2xl text-center" >Report of medical verification</h1>
                        </div>
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <img width="45px" height="25px" class="medi-center py-2" src="img/health-check.png" alt="">
                            <h1 class="text-2xl text-center" >CBHI Utilization of medical <br> services Monthly</h1>
                        </div>
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <img width="45px" height="25px" class="medi-center" src="img/balance-sheet.png" alt="">
                            <h1 class="text-2xl text-center" > Verification sheet</h1>
                        </div>
                        <div class="medi-magic medi-magic-btn w-1/4 my-2 mx-2 py-4 bg-gradient-to-r bg-gray-light rounded-md">
                            <img width="45px" height="25px" class="medi-center" src="img/invoice.png" alt="">
                            <h1 class="text-2xl text-center" >Verified invoice</h1>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 2px solid #52dcff;">
        </div>
    </section >
<script src="src/load/js/load.js"></script>
</body>
</html>