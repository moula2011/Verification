<?php 
    include('./../../link.php'); 
    $consult =json_decode(file_get_contents('../../data/rugarama.json'));
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
            <div class=" check flex flex-row mb-8" style="background-color:whitesmoke; width:auto; height: 700px;">
                <div id="checklist" class="h-auto w-3/5 m-4 medi-client rounded-md medi_list" style="background-color:#C9DFEC; height:675px; overflow: hidden;">
                    <div class="flex flex-row rounded-md">
                        <div class="w-100">
                            <input type="search" id="search" class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">
                        </div>
                    </div>
                        <?php  foreach($consult as $uncheck): if($uncheck->day == $today && $uncheck->checked == 1){ ?>
                            <form action="check.php" method="post">
                                <div class="flex flex-row h-auto w-90 m-4 medi-client rounded-md border-red-200">
                                    <div class="w-16 bg-white rounded-md mr-2">
                                        <input value="<?= $uncheck->client_id?>"  type="checkbox" class="mx-4 mt-8 " name="checku[]" id="checkall">
                                    </div>
                                    <div class="flex flex-col" style="width: 806px; background-color:#E3E4FA;opacity:0.8;">
                                        <div class="w-100  flex flex-row">
                                            <span class="w-6 text-1xl ml-6 mt-2"> <b></b></span>
                                            <span class="w-128 text-2xl ml-1 mt-2"> <b><?= $uncheck->bene;  ?></b></span><br>
                                            <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;"><?php $jid= $uncheck->client_id; echo $jid ?></b></span>
                                        </div>
                                        <div class="w-100 flex flex-row" style="background-color:#D5D6EA;opacity:0.8;">
                                            <table>
                                                <tr class="">
                                                    <td>
                                                        <?php 
                                                            $k=0;$k=0;
                                                            foreach($uncheck->items->consultation as $consu): 
                                                                if($uncheck->checked == 1 && $consu->insured == 1){
                                                                    $k++;
                                                                    echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$consu->cons_item.'" class="ml-2" id="'.$consu->cons_item.'">
                                                                    <b> '.$k.'-</b>
                                                                    <label style="width: 196px; height: 20px;" for="'.$consu->cons_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
                                                                    echo $consu->cons_item; 
                                                                    echo '</label>';
                                                                    echo '<label for="'.$consu->cons_item.'" class="w-28 text-md my-2 ml-3 ">
                                                                    (<b>U-P: </b><b style="color: red;">'.$consu->cons_u_p.'</b> Rwf)
                                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                    echo'<br>';

                                                                }else{echo 0;}
                                                            endforeach;
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($uncheck->checked == 1){
                                                                foreach($uncheck->items->medicines as $meds): 
                                                                    // if($meds->checked == 1){ 
                                                                        $k++;
                                                                    echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$meds->med_item.'" class="ml-2" id="'.$meds->med_item.'">
                                                                    <b> '.$k.'-</b>
                                                                    <label style="width: 196px; height: 20px;" for="'.$meds->med_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
                                                                    echo $meds->med_item; 
                                                                    echo '</label>';
                                                                    echo '<label for="'.$meds->med_item.'" class="w-28 text-md my-2 ml-3 ">
                                                                    (<b>'.$meds->med_quantity.'</b>) (<b>U-P: </b><b style="color: red;">'.$meds->med_u_p.'</b> Rwf)
                                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                    // }
                                                                echo'<br>';

                                                                endforeach;
                                                            }else{echo 0;}
                                                        ?>                                                                                
                                                    </td>
                                                </tr >
                                                <tr class="">
                                                    <td class="">
                                                        <?php 
                                                            foreach($uncheck->items->consommables as $consoms): 
                                                                if($uncheck->checked == 1 && $consoms->insured == 1){
                                                                    $k++;
                                                                    echo '<input type="hidden" name="checkup[]" value="'.$consoms->conso_item.'" class="ml-2 mr-1 my-1" id="'.$consoms->conso_item.'">
                                                                    <b> '.$k.'-</b>
                                                                    <label for="'.$consoms->conso_item.'" class="text-md ml-2 mt-2 text-black medi_limit_span_check ">';
                                                                    echo $consoms->conso_item; 
                                                                    echo '</label>';
                                                                    echo '<label for="'.$consoms->conso_item.'" class="text-md mt-2 ml-3 ">
                                                                    (<b>'.$consoms->conso_quantity.'</b>) (<b>U-P: </b><b style="color: red;">'.$consoms->conso_u_p.'</b> Rwf)
                                                                    </label>';
                                                                    echo'<br>';
                                                                }
                                                            endforeach;
                                                        ?>
                                                    </td>
                                                    <td class="">
                                                        <?php 
                                                            if($uncheck->checked == 1){
                                                                foreach($uncheck->items->laboratoire as $labo): 
                                                                    // if($labo->checked == 1){ 
                                                                        $k++;
                                                                    echo '<input type="hidden" name="checkup[]" value="'.$labo->lab_item.'" class="ml-2 mr-1 my-1" id="'.$labo->lab_item.'">
                                                                    <b> '.$k.'-</b>
                                                                    <label for="'.$labo->lab_item.'" class="text-md ml-2 mt-2 text-black medi_limit_span_check ">';
                                                                    echo $labo->lab_item; 
                                                                    echo '</label>';
                                                                    echo '<label for="'.$labo->lab_item.'" class="text-md mt-2 ml-3 ">
                                                                    (<b>U-P: </b><b style="color: red;">'.$labo->lab_u_p.'</b> Rwf)
                                                                </label>';
                                                            // }
                                                                echo'<br>';
                                                                endforeach;
                                                            }else{echo 0;}
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td class="">
                                                        <?php 
                                                            if($uncheck->checked == 1){
                                                                foreach($uncheck->items->soins as $soins): 
                                                                    // if($soins->checked == 1){ 
                                                                        $k++;
                                                                    echo '<input type="hidden" name="checkup[]" value="'.$soins->act_med_item.'" class="ml-2 mr-1 my-1" id="'.$soins->act_med_item.'">
                                                                    <b> '.$k.'-</b>
                                                                    <label for="'.$soins->act_med_item.'" class="text-md ml-2 mt-2 text-black medi_limit_span_check ">';
                                                                    echo $soins->act_med_item; 
                                                                    echo '</label>';
                                                                    echo '<label for="'.$soins->act_med_item.'" class="text-md mt-2 ml-3 ">
                                                                    (<b>'.$soins->act_med_quantity.'</b>) (<b>U-P: </b><b style="color: red;">'.$soins->act_med_u_p.'</b> Rwf)
                                                                </label>';
                                                            // }
                                                                echo'<br>';

                                                                endforeach;
                                                            }else{echo 0;}
                                                        ?>
                                                    </td>
                                                    <td class="">
                                                        <?php 
                                                            if($uncheck->checked == 1){
                                                                foreach($uncheck->items->hospitalisation as $hosp): 
                                                                    // if($hosp->checked == 1){ 
                                                                        $k++;
                                                                    echo '<input type="hidden" name="checkup[]" value="'.$hosp->hosp_item.'" class="ml-2 mr-1 my-1" id="'.$hosp->hosp_item.'">
                                                                    <b> '.$k.'-</b>
                                                                    <label for="'.$hosp->hosp_item.'" class="text-md ml-2 mt-2 text-black medi_limit_span_check ">';
                                                                    echo $hosp->hosp_item; 
                                                                    echo '</label>';
                                                                    echo '<label for="'.$hosp->hosp_item.'" class="text-md mt-2 ml-3 ">
                                                                    (<b>'.$hosp->hosp_quantity.'</b>)(<b>U-P: </b><b style="color: red;">'.$hosp->hosp_u_p.'</b> Rwf)
                                                                </label>';
                                                            // }
                                                                echo'<br>';
                                                                endforeach;
                                                            }else{echo 0;}
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                            
                                    </div>
                                    <div class="flex flex-col rounded-md bg-white" style="opacity: 0.8; width: 80px;">
                                        <input type="checkbox" name="md" value="special" class="py-2 ml-6 mt-4" id="">
                                        <button type="submit" name="submit" class="text-1xl p-1 m-2 medi-btn rounded-md">
                                            <?php 
                                                if($uncheck->checked == 1 && $meds->insured == 1){$med=count($uncheck->items->medicines);}
                                                if($uncheck->checked == 1 && $consoms->insured == 1){$conso= count($uncheck->items->consommables); }
                                                if($uncheck->checked == 1 && $consu->insured == 1){$consul=count($uncheck->items->consultation); }
                                                if($uncheck->checked == 1 && $labo->insured == 1){$lab= count($uncheck->items->laboratoire); }
                                                if($uncheck->checked == 1 && $soins->insured == 1){$soins=count($uncheck->items->soins);}
                                                if($uncheck->checked == 1 && $hosp->insured == 1){$hosp= count($uncheck->items->hospitalisation);}
                                                $tot =$med+$conso+$consul+$lab+$soins+$hosp;
                                            ?>
                                            <?= $tot?>                                            
                                            <i class="text-sm"> -- </i> 
                                            <?= 0; ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php //$code = $uncheck->client_id; echo $code;?>
                        <?php 
                            }
                            endforeach ;                     
                            if(isset($_POST['submit'])){  
                                
                                $items = $_POST['checku'];
                                
                                $md = $_POST['md'];
                                
                                $code = $_POST['checkup']; 

                                foreach($items as $key=>$item){
                                    // echo $item;
                                    $rug = new Consult('../../data/rugarama.json');
                                    if($md == 'special'){

                                        $rug->updatecheckedspecial($item,"special",1);
                                        $rug->updatechecked($item,"checked",0);
                                    }
                                    else
                                    $rug->updatechecked($item,"checked",0);

                                    $cache=$link -> query("UPDATE `orders` SET `checked`=1 WHERE client_id=$item ");

                                }
                            }
                        ?>
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