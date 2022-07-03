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
        $consums =json_decode(file_get_contents('../../data/consums.json'));
        require('consult.class.php');

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
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unchecked"><?= $v_check; ?></b> &nbsp;Unchecked
                    </div>
                </a>                
                <a href="not_verified.php">
                    <?php $v_v=0; foreach($consult as $check): $v_c = $check->checked;$v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unverified"><?= $v_check;  ?></b> &nbsp;Not Verified
                    </div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">

            <!-- ================== ni hano boby itangirira ===================================-->

            <div class="tableveri h-auto w-3/4 m-4 medi-client rounded-md flex flex-row" style="background-color:#C9DFEC; height:678px;">
                <div class="bg-white flex flex-col m-4 medi-client rounded-md border-red-200" style="width: 850px; height:657px; overflow: auto;">
                    <label for="" class="m-2 ml-6" style="opacity: 0.7;">
                        <b class=" text-2xl">NOT VERIFIED CONSUMABLES  </b>
                        <?php $num=0; foreach($consums as $consum): if($consum->verified == 0){ $num +=1;} ?>
                        <?php  endforeach?>
                        <b class=" text-2xl ml-6" style="color: red;"><?= $num?></b> CONSUMABLE<?php if($num > 1){ echo"S";}?>
                    </label>       
                    <form action="consum.php" method="post">           
                    <table class="w-90 m-2 medi-btn">
                        <thead class="bg-white ">
                            <tr class="medi-btn" style="background-color:#CCC; height: 50px;">
                                <th class="h-10 medi-btn w-12">No</th>
                                <th class="h-10 medi-btn w-50">DESIGNATION</th>
                                <th class="h-10 medi-btn w-20">INSURED ?</th>
                                <th class="h-30 medi-btn">PRIX PRECEDENT	</th>
                                <th class="h-10 medi-btn w-20">PRIX ACTUEL	</th>
                                <th>Verify</th>
                            </tr>
                        </thead >
                        <?php $i=0; foreach($consums as $consum): if($consum->verified == 0){ $i++; ?>
                            <tbody class="medi-btn">
                                <?php if($i%2==0)
                                echo'<tr>';
                                else
                                echo'<tr style="background-color:#C9DFEC;">';
                                ?>
                                    <td class=""><?= $i.' .'?></td>
                                    <td class=""><?= $consum->description?></td>
                                    <td class="text-center"><?php if($consum->insured == 1){ echo "Yes";}else{echo "NOT";}?></td>
                                    <td class="text-center"><?= $consum->unit_price?></td>
                                    <td class="text-center"><?= $consum->unit_price?></td>
                                    <input class="ml-6" type="hidden" name="consid" value="<?=$consum->item_id ?>">

                                    <td class="medi-btn">
                                        <button name="consum" class="p-1 px-3 m-2 medi-btn rounded-md" style=" background-color:#66CDAA ; color:whitesmoke;">+</button>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } endforeach; ?>
                </table>
                </form>  
                </div>
                <?php
                    $rug = new Consult('../../data/consums.json');

                    if(isset($_POST['consum'])){  
                        $drid = $_POST['consid'];
                        foreach($consums as $consum){
                            echo $consum->item_id;
                            foreach($drug as $hosp):
                            
                                if($drug->prod_id == $drid){
                                    // echo $drid;
                                    // $rug->updateprice($drid,"verified",1);
                                }
                            endforeach;
                        }

                    }
                ?>
                <div class="bg-white flex flex-col m-4 medi-client rounded-md border-red-200" style="width: 850px; height:657px; overflow: auto;">
                    <label for="" class="m-2 ml-6" style="opacity: 0.7;">
                        <b class=" text-2xl">VERIFIED CONSUMABLES  </b>
                        <?php $num=0; foreach($consums as $consum): if($consum->verified == 1){ $num +=1;} ?>
                        <?php  endforeach?>
                        <b class=" text-2xl ml-6" style="color: blue;"><?= $num?></b> CONSUMABLE<?php if($num > 1){ echo"S";}?>
                    </label>                    
                    <table class="w-90 m-2 medi-btn">
                        <thead class="bg-white ">
                            <tr class="medi-btn" style="background-color:#CCC; height: 50px;">
                                <th class="h-10 medi-btn w-12">No</th>
                                <th class="h-10 medi-btn w-50">DESIGNATION</th>
                                <th class="h-10 medi-btn w-20">INSURED ?</th>
                                <th class="h-30 medi-btn">PRIX PRECEDENT	</th>
                                <th class="h-10 medi-btn w-20">PRIX ACTUEL	</th>
                                <th>Verify</th>
                            </tr>
                        </thead >
                        <?php $i=0; foreach($consums as $consum): if($consum->verified == 1){ $i++; ?>
                            <tbody class="medi-btn">
                                <?php if($i%2==0)
                                echo'<tr>';
                                else
                                echo'<tr style="background-color:#C9DFEC;">';
                                ?>
                                    <td class=""><?= $i.' .'?></td>
                                    <td class=""><?= $consum->description?></td>
                                    <td class="text-center"><?php if($consum->insured == 1){ echo "Yes";}else{echo "NOT";}?></td>
                                    <td class="text-center"><?= $consum->unit_price?></td>
                                    <td class="text-center"><?= $consum->unit_price?></td>
                                    <td class="medi-btn">
                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style=" background-color:#66CDAA ; color:whitesmoke;">+</button> -->
                                    </td>
                                </tr>
                            </tbody>
                        <?php } endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>