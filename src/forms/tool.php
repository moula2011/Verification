<?php 
include('./../../link.php'); 
error_reporting(1|0);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/medi-style.css">
    <link rel="icon" href="../../img/favicon.ico">
    <title>.::CBHI::.</title>
</head>
<body style="background-image: url('../../img/31.jpg');" id="bg">
    <?php
        $consult =json_decode(file_get_contents('../../data/rugarama.json'));
    ?>
    <div class="medi-menu bg-opacity-50 p-2.5 bg-blue-400 bg-medimenu">
        <div class="pt-0 float-left flex">
            <img src="../../img/logo_medi.png" alt="" class="ml-6 mb-4">
            <h2 class="hidden md:flex text-2xl text-white align-text-bottom m-1 ml-3">hello</h2>
        </div>
        <nav class="relative container mx-auto w-full px-6" >
            <div class="flex items-center justify-between  ">
                <div class="pt-0 ">
                    <h2 class="text-4xl">&nbsp;</h2>
                </div>
                <div class="flex space-x-2 right-0">
                    <a href="#"><img src="../../img/home.png" alt=""></a>
                    <a href="#"><img src="../../img/app.png" alt=""></a>
                    <a href="#"><img src="../../img/logout.png" alt=""></a>
                </div>
            </div>
        </nav> 
    </div>
    <section id="moula">
        <div class="absolute inset-x-12 h-20 top-11 bg-white md: w-100" style="opacity: 0.8;">
            <div class="medi-unique flex flex-row" style="top: 25px; height: 50px; width: 720px;">
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">MONTH:</label>
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style="width: 172px; height: 30px;" onchange='call(this.value,<?php echo json_encode($consult); ?>)'>
                        <?php
                            echo '<option value="">select month...</option>';
                            $qry=mysqli_query($link,"SELECT DISTINCT period FROM orders ORDER BY date");
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
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style=" height: 30px; width:320px;">
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
                <a href="../../cbhi.php" class="mt-4 mx-4 text-2xl">Today</a>
                <a href="check.php">
                    <?php $v_c=0; $v_v=0; foreach($consult as $check): $v_c += $check->checked; $v_v += $check->verified; endforeach; $v_check =$v_c;?>
                    <div class="medi-magic medi-magic-btn m-2 p-1 bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unchecked"><?= $v_check; ?></b> 
                        &nbsp;Unchecked
                    </div>
                </a>                
                <a href="not_verified.php">
                    <?php $v_v=0; foreach($consult as $check): $v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <div class="medi-magic medi-magic-btn m-2 p-1 bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unverified"><?= $v_check; ?></b> 
                        &nbsp;Not Verified
                    </div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">
            
            <!-- ================== ni hano boby itangirira =================================== -->

            <div style="background-color: #999;" style=" height: 900px; ">
                <div class="medi-btn m-6 bg-white rounded-md" style="width: 1900px; ">
                    <table class="m-4 medi-btn" style="overflow:auto ">
                        <tr style="background-color: #ccc; color:#333 ;">
                            <th class="medi-btn">No</th>
                            <th class="medi-btn">Date</th>
                            <th class="medi-btn">BENEFICIARY'S AFFILIATION NUMBER</th>
                            <th class="medi-btn">BENEFICIARY'S NAMES</th>
                            <th class="medi-btn">AMOUNT DEDUCTED</th>
                            <th class="medi-btn">EXPLANATION OF DEDUCTION</th>
                        </tr>
                        <?php foreach($consult as $tool): $i=0; $deduct = 0; $qtty = 0; $amount = 0; ?>

                        <?php 
                            
                            foreach($tool->items->verification->consultation as $veri): 
                                if($veri->amounted !=0){$i++;
                                    $qtty = $veri->item_quantity;
                                    $amount = $veri->amounted;
                                    $deduct = $qtty*$amount;
                        ?>
                        <tr class="medi-btn">
                            <td class="medi-btn text-center"><?= $i?></td>
                            <td class="medi-btn p-2"><?= $veri->date?></td>
                            <td class="medi-btn text-center"><?= $tool->insurance_code?></td>
                            <td class="medi-btn text-center p-2"><?= $tool->bene?></td>
                            <td class="medi-btn text-center"><?= $deduct ?></td>
                            <td class="medi-btn text-center" style="width: 700px ;"><?= $veri->comment ?></td>
                        </tr>
                        <?php } endforeach; ?>
                        <?php 
                            
                            foreach($tool->items->verification->medicines as $veri): 
                                if($veri->amounted !=0){$i++;
                                    $qtty = $veri->item_quantity;
                                    $amount = $veri->amounted;
                                    $deduct = $qtty*$amount;
                        ?>
                        <tr class="medi-btn">
                            <td class="medi-btn text-center"><?= $i?></td>
                            <td class="medi-btn p-2"><?= $veri->date?></td>
                            <td class="medi-btn text-center"><?= $tool->insurance_code?></td>
                            <td class="medi-btn text-center p-2"><?= $tool->bene?></td>
                            <td class="medi-btn text-center"><?= $deduct ?></td>
                            <td class="medi-btn text-center" style="width: 700px ;"><?= $veri->comment ?></td>
                        </tr>
                        <?php } endforeach; ?>
                        <?php 
                            
                            foreach($tool->items->verification->consommables as $veri): 
                                if($veri->amounted !=0){$i++;
                                    $qtty = $veri->item_quantity;
                                    $amount = $veri->amounted;
                                    $deduct = $qtty*$amount;
                        ?>
                        <tr class="medi-btn">
                            <td class="medi-btn text-center"><?= $i?></td>
                            <td class="medi-btn p-2"><?= $veri->date?></td>
                            <td class="medi-btn text-center"><?= $tool->insurance_code?></td>
                            <td class="medi-btn text-center p-2"><?= $tool->bene?></td>
                            <td class="medi-btn text-center"><?= $deduct ?></td>
                            <td class="medi-btn text-center" style="width: 700px ;"><?= $veri->comment ?></td>
                        </tr>
                        <?php } endforeach; ?>
                        <?php 
                            
                            foreach($tool->items->verification->laboratoire as $veri): 
                                if($veri->amounted !=0){$i++;
                                    $qtty = $veri->item_quantity;
                                    $amount = $veri->amounted;
                                    $deduct = $qtty*$amount;
                        ?>
                        <tr class="medi-btn">
                            <td class="medi-btn text-center"><?= $i?></td>
                            <td class="medi-btn p-2"><?= $veri->date?></td>
                            <td class="medi-btn text-center"><?= $tool->insurance_code?></td>
                            <td class="medi-btn text-center p-2"><?= $tool->bene?></td>
                            <td class="medi-btn text-center"><?= $deduct ?></td>
                            <td class="medi-btn text-center" style="width: 700px ;"><?= $veri->comment ?></td>
                        </tr>
                        <?php } endforeach; ?>
                        <?php 
                            
                            foreach($tool->items->verification->soins as $veri): 
                                if($veri->amounted !=0){$i++;
                                $qtty = $veri->item_quantity;
                                $amount = $veri->amounted;
                                $deduct = $qtty*$amount;
                                
                        ?>
                        <tr class="medi-btn">
                            <td class="medi-btn text-center"><?= $i?></td>
                            <td class="medi-btn p-2"><?= $veri->date?></td>
                            <td class="medi-btn text-center"><?= $tool->insurance_code?></td>
                            <td class="medi-btn text-center p-2"><?= $tool->bene?></td>
                            <td class="medi-btn text-center"><?= $deduct ?></td>
                            <td class="medi-btn text-center" style="width: 700px ;"><?= $veri->comment ?></td>
                        </tr>
                        <?php } endforeach; ?>
                        <?php 
                            
                            foreach($tool->items->verification->hospitalisation as $veri): 
                                if($veri->amounted !=0){$i++;
                                    $qtty = $veri->item_quantity;
                                    $amount = $veri->amounted;
                                    $deduct = $qtty*$amount;
                        ?>
                        <tr class="medi-btn">
                            <td class="medi-btn text-center"><?= $i?></td>
                            <td class="medi-btn p-2"><?= $veri->date?></td>
                            <td class="medi-btn text-center"><?= $tool->insurance_code?></td>
                            <td class="medi-btn text-center p-2"><?= $tool->bene?></td>
                            <td class="medi-btn text-center"><?= $deduct ?></td>
                            <td class="medi-btn text-center" style="width: 700px ;"><?= $veri->comment ?></td>
                        </tr>
                        <?php } endforeach; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="medi-btn text-center" style="background-color:#ccc">Total</td>
                            <td colspan="" class="medi-btn text-center" style="background-color:#ccc">
                            <?php 
                                foreach($consult as $tool): 
                                    $deductt = 0; $qty = 0; $amt = 0; $tot_amt =0;
                                    foreach($tool->items->verification->consultation as $veri):$qty = $veri->item_quantity;$amt = $veri->amounted;$deductt = $qty*$amt;$cotot_amt += $deductt;endforeach;
                                    foreach($tool->items->verification->medicines as $veri):$qty = $veri->item_quantity;$amt = $veri->amounted;$deductt = $qty*$amt;$metot_amt += $deductt;endforeach;
                                    foreach($tool->items->verification->consommables as $veri):$qty = $veri->item_quantity;$amt = $veri->amounted;$deductt = $qty*$amt;$contot_amt += $deductt;endforeach;
                                    foreach($tool->items->verification->laboratoire as $veri):$qty = $veri->item_quantity;$amt = $veri->amounted;$deductt = $qty*$amt;$latot_amt += $deductt;endforeach;
                                    foreach($tool->items->verification->soins as $veri):$qty = $veri->item_quantity;$amt = $veri->amounted;$deductt = $qty*$amt;$sotot_amt += $deductt;endforeach;
                                    foreach($tool->items->verification->hospitalisation as $veri):$qty = $veri->item_quantity;$amt = $veri->amounted;$deductt = $qty*$amt;$hotot_amt += $deductt;endforeach;
                                endforeach;
                                echo $tot_amt = $cotot_amt+$metot_amt+$contot_amt+$latot_amt+$sotot_amt+$hotot_amt; 
                            ?>
                            </td>
                            <td colspan="" class="medi-btn text-center" style="background-color:#ccc"></td>
                        </tr>
                    </table>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>