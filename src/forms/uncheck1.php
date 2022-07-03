<?php 
    include('./../../link.php'); 
    $consult =json_decode(file_get_contents('../../data/rugarama.json'));
    error_reporting(1|0);
    $cid=$_GET['id'];
    $date=$_GET['date'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/medi-style.css">
    <link rel="icon" href="../../img/favicon.ico">
    <script src="../../jquery-3.3.1.min.js"></script>
    <title>.::CBHI::.</title>
    <style>
        .medi-container {box-shadow: 0px 0px 3px 0px #000;}
        .border-mediblue {border: 1px solid #1fb6ff;}
        .medi-btn {border: 1px solid indigo;/* width: 100%; */}
        .medi-client {box-shadow: 0px 0px 2px 0px #000;}
        .medi-menu {box-shadow: 0px 0px 5px 0px #000;}
        .medi-unique {position: absolute;border-radius: 0px 200px 10px 10px;width: 330px;border: 1px solid #09F;height: 38px;background-color: #BDF;}
        .medi-magic-btn-r {border-left: 1px solid red;border-right: 1px solid red;}
        .medi-magic-btn-l {border-left: 1px solid #1fb6ff;border-right: 1px solid #1fb6ff;}
        .medi_limit_span_veri {display: block;width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
        .medi_limit_span_check {display: inline-block;width: 190px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
        .medi_list::-webkit-scrollbar {width: 0 !important;display: none;}
    </style>
    <script>
        let call = (day,data) => {            

            $.get('../load/php/check/check.php?date='+day,function(data){
                $('#checked').html(data);
            });  

            $.get('../load/php/check/verify.php?date='+day,function(data){
                    $('#unverified').html(data); 
                });
            $.get('../load/php/check/checklist.php?date='+day,function(data){
                $('#checklist').html(data); 
            });   
        }
    </script>
</head>
<body style="background-image: url('../../img/31.jpg');" id="bg">
    <?php 
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
                    <label for="" class="m-2">DATE:</label>
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style="width: 172px; height: 30px;" onchange='call(this.value,<?php echo json_encode($consult); ?>)'>
                        <?php
                            echo '<option value="">select date...</option>';
                            $qry=mysqli_query($link,"SELECT DISTINCT date FROM orders WHERE checked=0 ORDER BY date");
                            if(!$qry){ die('Error :'.mysqli_error($link)); }
                            while($row=mysqli_fetch_assoc($qry)){
                                $day=$row['date'];
                                echo '<option value="'.$day.'">'.$day.'</option>';
                            } 
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
        <?php $today = date('Y-m-d');?>

        <div class="medi-container absolute inset-x-12 top-28 bg-white rounded-xl overflow-hidden md:w-100">
            <div class="flex flex-row w-3/5 " style="border-top: 1px solid #52dcff;">
            <a href="../../cbhi.php" class="mt-4 mx-4 text-2xl">Dashboard</a>
                <a href="check.php">
                    <?php $v_c=0; foreach($consult as $check): $v_c += $check->checked;$v_v += $check->verified; endforeach; $v_check =$v_c;?>
                    <?php $v_c_today=0; foreach($consult as $check): if($check->day == $today && $check->checked ==1){$v_c_today += $check->checked;$v_v_today += $check->verified; } endforeach; $c_today =$v_c_today;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="checked"><?= $c_today ?></b> &nbsp;Unchecked
                    </div> 
                </a>                 
                <a href="not_verified.php">
                    <?php $v_v=0; foreach($consult as $check): $v_c = $check->checked;$v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <?php $v_v_today=0; foreach($consult as $check): if($check->day == $today && $check->done ==0){$v_c_today = $check->checked;$v_v_today += $check->verified; } endforeach; $v_today =$v_v_today;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unverified"><?= $v_today ?></b> &nbsp;Not Verified
                    </div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">

            <!-- ========================================igihimba gitangirira aha=========================================== -->
            <div class="check flex flex-row mb-8" style="background-color:whitesmoke; width:auto; height: 700px;">
                <div class="h-auto w-3/5 m-4 medi-client rounded-md medi_list" style="background-color:#C9DFEC; height:675px; overflow: hidden;">
                    <?php 
                        $i=0; foreach($consult as $verify): if($verify->client_id == $cid){ 
                    ?>
                    <table class="w-90 m-1">
                        <thead class="bg-white ">
                            <tr>
                                <th colspan="7" class="h-20 ">
                                    <div class="flex flex-row w-100 text-center" id="head">
                                        <label for="" class=""> <h1 class="text-2xl text-zinc-600">
                                            <b  class="text-red mb-4 mx-2" style="color:blue"><?=$cid?></b>: <?=$verify->bene ?></h1>
                                        </label>
                                        <form action="uncheck.php">
                                            <button class="ml-6 p-2 w-20 rounded-md medi-btn" style="background-color: #A52A2A;color:whitesmoke" onclick="callDone(`+id+`)"><b>check</b></button>
                                        </form>
                                    </div>
                                </th>
                            </tr>
                            <tr class=" bg-gray-200 medi-btn">
                                <th class="h-10 medi-btn w-12">N<sup><u>o</u></sup></th>
                                <th class="h-10 medi-btn w-50">Item</th>
                                <th class="h-10 medi-btn w-20">Qtty</th>
                                <th class="h-10 medi-btn w-20">U-P	</th>
                                <th class="h-10 medi-btn w-28">Tot-P</th>
                            </tr>
                        </thead>
                        <tbody class="medi-btn bg-white" id="body">
                            <?php  
                                foreach($verify->items->consultation as $consul): $consqt=$consul->cons_quantity; $consup=$consul->cons_u_p; 
                                if(!empty($verify->items->consultation)){$i++;
                                    $tot_cons =$consqt*$consup; 
                            ?>
                            <tr>
                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                <td class="h-10 medi-btn w-12 px-2"><?=$consul->cons_item?></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$consul->cons_quantity?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$consul->cons_u_p?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_cons?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_cons?>"></td>  
                            </tr>
                            <?php } endforeach;?>
                            <?php  
                                foreach($verify->items->laboratoire as $labo): $labqt=$labo->lab_quantity; $labup=$labo->lab_u_p; 
                                if(!empty($verify->items->laboratoire)){ $i++;
                                    $tot_labo =$labqt*$labup;
                                    $t_labo+=$tot_labo;
                            ?>
                            <tr>
                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                <td class="h-10 medi-btn w-12 px-2"><?=$labo->lab_item?></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$labo->lab_quantity?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$labo->lab_u_p?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_labo?>"></td>
                            </tr>
                            <?php } endforeach;?>
                            <?php  
                                foreach($verify->items->medicines as $meds): $mqt=$meds->med_quantity; $mup=$meds->med_u_p; 
                                if(!empty($verify->items->medicines)){$i++;
                                    $tot_med =$mqt*$mup;
                                    $t_med+=$tot_med;
                            ?>
                            <tr>
                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                <td class="h-10 medi-btn w-12 px-2"><?=$meds->med_item?></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$meds->med_quantity?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$meds->med_u_p?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_med?>"></td>   
                            </tr>
                            <?php } endforeach;?>
                            <?php  
                                foreach($verify->items->consommables as $conso): $consoqt=$conso->conso_quantity; $consoup=$conso->conso_u_p; 
                                if(!empty($verify->items->consommables)){ $i++;
                                    $tot_conso =$consoqt*$consoup;
                                    $t_conso+=$tot_conso;
                            ?>
                            <tr>
                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                <td class="h-10 medi-btn w-12 px-2"><?=$conso->conso_item?></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$conso->conso_quantity?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$conso->conso_u_p?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_conso?>"></td>  
                            </tr>
                            <?php } endforeach;?>
                            <?php  
                                foreach($verify->items->soins as $soin): $soinqt=$soin->act_med_quantity; $soinup=$soin->act_med_u_p; 
                                if(!empty($verify->items->soins)){ $i++;
                                    $tot_soin =$soinqt*$soinup;
                                    $t_soin+=$tot_soin ;
                            ?>
                            <tr>
                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                <td class="h-10 medi-btn w-12 px-2"><?=$soin->act_med_item?></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$soin->act_med_quantity?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$soin->act_med_u_p?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_soin?>"></td>
                            </tr>
                            <?php } endforeach;?>
                            <?php  
                                foreach($verify->items->hospitalisation as $hosp): $hospqt=$hosp->hosp_quantity; $hospup=$hosp->hosp_u_p; 
                                if(!empty($verify->items->hospitalisation)){ $i++;
                                    $tot_hosp =$hospqt*$hospup;
                                    $t_hosp+=$tot_hosp;
                            ?>
                            <tr>
                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                <td class="h-10 medi-btn w-12 px-2"><?=$hosp->hosp_item?></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$hosp->hosp_quantity?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$hosp->hosp_u_p?>"></td>
                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$tot_hosp?>"></td>   
                            </tr>
                            <?php } endforeach;?>
                            <tr>
                                <td colspan="4" class="h-10 medi-btn w-12" style="background-color:whitesmoke ;">Total</td>
                                <td class="text-center"><?=$gt=$tot_cons+$t_labo+$t_med+$t_conso+$t_soin+$t_hosp?></td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <?php }endforeach ?>
                </div>
                <div class="h-auto w-2/5 m-4 medi-client rounded-md " style="background-color:#C9DFEC; height:675px; overflow: hidden;">
                    <div class="flex flex-row h-20 w-90 m-4  rounded-md border-red-200">
                        <div class="w-100">
                            <span class="w-128 text-2xl m-3" style="color: #666;"> <b>Suspicious Items Mostly used </b></span>
                            <input type="text" name="" class="rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="search by name" id="">
                        </div>
                    </div>
                    <div class="bg-white flex flex-row h-auto w-90 m-4 medi-client rounded-md ">
                        <div class="w-20 flex flex-col" style="width: 50px;">
                            <input type="checkbox" name="" class="mt-8 mx-4" id="">
                            <label class="m-2 " for="" style="opacity: 0.6;">Med..</label>
                        </div>
                        <div class="w-8/12 flex flex-row" style="width: 620px;background-color:#E3E4FA;opacity:0.8;">
                            <span class="w-16 text-md ml-6 mt-2 "> Monthly <br>(<b style="color: blue;">5/12jrs</b>)</span>
                            <span class="w-128 text-xl ml-4 mt-2 text-zinc-600"> <b>HYDROCORTISONE COLLY</b></span><br>
                            <label class="w-16 text-xl ml-6 mt-2"> 5</label>
                        </div>
                        <div class="w-50 bg-indigo-50 flex flex-col" style="width: 210px;">
                            <span class="w-100 text-sm pr-2 ml-6 mt-2 "> Curr-P:  (<b style="color: red;">2450</b>Frw)</span>
                            <span class="w-100 text-sm ml-6 mt-2 "> Prev-P:  (<b style="color: red;">2450</b> Frw)</span>
                        </div>
                    </div>
                    <div class="bg-white flex flex-row h-auto w-90 m-4 medi-client rounded-md border-red-200">
                        <div class="w-20 flex flex-col" style="width: 50px;">
                            <input type="checkbox" name="" class="mt-8 mx-4" id="">
                            <label class="m-2" for="" style="opacity: 0.6;">Cons..</label>
                        </div>
                        <div class="w-8/12 flex flex-row" style="width: 620px; background-color:#E3E4FA; opacity:0.8;">
                            <span class="w-16 text-md ml-6 mt-2 "> Monthly <br> (<b style="color: blue;">23/ jrs</b>)</span>
                            <span class="w-128 text-xl ml-4 mt-2 text-zinc-600"> <b>Vitamine B complexe cp</b></span><br>
                            <label class="w-16 text-xl ml-6 mt-2"> 15</label>
                        </div>
                        <div class="w-70 bg-indigo-50 flex flex-col" style="width: 210px;">
                            <span class="w-100 text-sm pr-2 ml-6 mt-2 "> Curr-P:  (<b style="color: red;">2450</b>Frw)</span>
                            <span class="w-100 text-sm ml-6 mt-2 "> Prev-P:  (<b style="color: red;">2450</b> Frw)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section >
    <script src="load/js/load.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#checkall').change(function(){
                if($(this).is(':checked')){
                    $('input[name="checkup[]"]').prop('checked',true)
                }else{
                    $('input[name="checkup[]"]').each(function(){
                        $(this).prop('checked',false)
                    })
                }
            })
        })
    </script>
</body>
</html>