<?php 
include('./../../link.php'); 
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

</head>
<body style="background-image: url('../../img/31.jpg');" id="bg">
    <?php 
        $consult =json_decode(file_get_contents('../../data/rugarama.json'));
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
            <div class="medi-unique top-10 flex flex-row">
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">MONTH:</label>
                    <select class="form-select px-12 py-2 border-black rounded-t-lg" v-model="selperiodes" onchange='call(this.value,<?php echo json_encode($consult); ?>)'>
                        <?php
                            $qry=mysqli_query($link,"SELECT DISTINCT period FROM orders ORDER BY period");
                            if(!$qry){ die('Error :'.mysqli_error($link)); }
                            while($row=mysqli_fetch_assoc($qry)){
                                $period=$row['period'];
                                echo '<option value="'.$period.'">'.$period.'</option>';
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

            <div class="veri h-4/5 mb-8" style="background-color:whitesmoke; height:698px; overflow: hidden;">
                <div class="check flex flex-row">
                    <div class="bg-indigo-100 mx-4 mt-2 medi-client rounded-md" style="background-color:#C9DFEC; height:680px; width: 460px; overflow: hidden;">
                        <div class="flex flex-row rounded-md ">
                            <div class="w-100">
                                <input type="search" id="search" class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">        
                            </div>
                        </div>
                        <?php $i=0; foreach($consult as $uncheck): $i++; if($uncheck->verified == 1){?>
                        <di class="flex flex-row mx-4 my-2 medi-client rounded-md bg-white" style="opacity: 0.8;">
                            <div class="w-20 flex flex-col">
                                <input type="checkbox" name="" class="rounded-xl mx-4 mt-8 " id="">
                            </div>
                            <form action="unverified.php" method="post" class="flex flex-row" style="width: 100%;">
                                <div class="flex flex-col" style="width:99%;">
                                    <div class="w-100  flex flex-row">
                                    <span class="w-6 text-1xl mr-2 ml-6 mt-2"> <b><?= $i; ?>. &nbsp;</b> </span>
                                    <span class="w-128 text-2xl ml-1 mt-2 medi_limit_span_veri"> <b><?= $uncheck->bene;  ?></b></span><br>
                                    <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;"><?= $uncheck->client_id;  ?></b></span>
                                    </div>
                                    <div class="w-100  flex flex-row">
                                    <span class="w-2/3 my-3 text-sm ml-2 bg-red-0">sex: <b class="text-md "><?= $uncheck->sex;  ?></b> age:
                                        <b><?= $uncheck->age;  ?></b> &nbsp;CAT: <b class="text-md mr-2"><?= $uncheck->cat;  ?></b></span>&nbsp;
                                    <span class="w-1/2 text-sm my-3 bg-blue-50">(Tot:<b style="color: red;">
                                    <?php 
                                        $cup=0; $lab=0; $tot=0; 
                                        $mqt=0; $mup=0; $mtot=0; 
                                        $consoqt=0; $consup=0; $consotot=0; 
                                        $soinqt=0; $soinup=0; $sointot=0; 
                                        $hospqt=0; $hospup=0; $hosptot=0; 
                        
                                        foreach($uncheck->items->consultation as $consul): $cup+=$consul->cons_u_p; endforeach;
                                        foreach($uncheck->items->laboratoire as $labo): $lab+=$labo->lab_u_p; endforeach;
                                        foreach($uncheck->items->medicines as $meds): $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; endforeach;
                                        foreach($uncheck->items->consommables as $cons): $consoqt+=$cons->conso_quantity; $consup+=$cons->conso_u_p;  endforeach;
                                        foreach($uncheck->items->soins as $soin): $soinqt+=$soin->act_med_quantity; $soinup+=$soin->act_med_u_p;  endforeach;
                                        foreach($uncheck->items->hospitalisation as $hosp): $hospqt+=$hosp->hosp_quantity; $hospup+=$hosp->hosp_u_p;  endforeach;
                        
                                        $mtot=$mqt*$mup;
                                        $consotot=$consoqt*$consup; 
                                        $sointot=$soinqt*$soinup; 
                                        $hosptot=$hospqt*$hospup; 
                        
                                        $tot=$cup+$lab+$mtot+$consotot+$sointot+$hosptot; echo $tot;
                                    ?>
                                    </b> Frw)</span>
                                    </div>

                                </div>
                                <div class="w-18  flex flex-col">
                                    <button class="pb-1 pl-2 m-2 medi-btn rounded-md"  id="verify" style="background-color:#6698FF;">
                                    <b class="m-1 text-white" >>></b>
                                    </button>
                                    <label class="text-1xl py-0 ml-3">
                                        <?php 
                                            $med=count($uncheck->items->medicines); $conso=count($uncheck->items->consommables); 
                                            $consul=count($uncheck->items->consultation); $lab= count($uncheck->items->laboratoire); 
                                            $soins=count($uncheck->items->soins);$hosp= count($uncheck->items->hospitalisation); 
                                            $tot =$med+$conso+$consul+$lab+$soins+$hosp;
                                        ?>
                                        <?= $tot?>
                                    </label>
                                </div>
                            </form>
                        </di>
                        <?php } endforeach ?>
                    </div>
                    <div class="tableveri h-auto w-3/4 m-4 medi-client rounded-md border-red-200" style="background-color:#C9DFEC; height:678px;">                        
                            <div class="bg-white flex flex-col h-auto w-90 m-4 medi-client rounded-md border-red-200" id="content">  
                                <?php 
                                    $i=0;
                                    // foreach($consult as $verify): if($verify->client_id == $cid && $verify->day == $date){ 
                                    foreach($consult as $verify): if($verify->client_id == $cid){ 
                                ?>
     
                                <table class="w-90 m-1">
                                    <thead class="bg-white ">
                                        <tr>
                                        <th colspan="7" class="h-20 ">
                                            <div class="flex flex-row w-100 text-center" id="head">
                                                <label for="" class=""> <h1 class="text-2xl text-zinc-600">
                                                    <b  class="text-red mb-4 mx-2" style="color:blue"><?=$cid?></b>: <?=$verify->bene ?></h1>
                                                </label>
                                                <form>
                                                    <button class="ml-6 p-2 w-20 rounded-md medi-btn" style="background-color: #A52A2A;color:whitesmoke" onclick="callDone(`+id+`)"><b>Done</b></button>
                                                </form>
                                                <form action="../../../muhima/form_verify.php?cod2=`+id+`&cod22=`+date+`" method="POST" target="_blank">                                            
                                                    <button class="ml-6 p-2 w-20 rounded-md med-btn"  style="background-color: #66CDAA;"><b>Form</b></button>
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
                                            <th class="h-10 medi-btn w-28">Deducted</th>
                                            <th class="h-10 medi-btn w-70">Explanations</th>
                                            <th class="h-10 medi-btn w-32"></th>
                                        </tr>
                                    </thead>
                                    <form action="unverified2.php?id=<?= $cid;?>&date=<?= $date;?>" method="post">
                                        <tbody class="medi-btn" id="body">
                                            <?php  
                                                foreach($verify->items->verification->consultation as $consul): $consulqt=$consul->item_quantity; $consulup=$consul->item_u_p; 
                                                $tot_consul =$consulqt*$consulup;
                                                if(!empty($verify->items->consultation)){ $i++;
                                            ?>
                                            <tr>
                                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                                <td class="h-10 medi-btn w-12 px-2"><?=$consul->item?></td>
                                                <script>
                                                    function consulqtt(valu){ var x,y,k; k=<?=$consul->item_u_p?>*<?=$consul->item_quantity?>; x=<?=$consul->item_u_p?>*valu;
                                                        y=k-x; document.getElementById('tot_consul').value = x; document.getElementById('ded_consul').value = y;
                                                    }
                                                    function consulprice(valu){ var x,y,k; k=<?=$consul->item_u_p?>*<?=$consul->item_quantity?>; x=<?=$consul->item_quantity?>*valu;
                                                        y=k-x; document.getElementById('tot_consul').value = x; document.getElementById('ded_consul').value = y;
                                                    }
                                                </script>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$consul->item_quantity?>" onkeyup="consulqtt(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$consul->item_u_p?>" onkeyup="consulprice(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="tot_consul" value="<?=$tot_consul?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="ded_consul" value="<?=$consul->amounted?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2 medi-btn"  type="text" value="<?=$consul->comment?>"></td>
                                                <td class="medi-btn  text-center">
                                                    <div class="w-16  flex flex-row">
                                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button> -->
                                                    </div>
                                                </td>   
                                            </tr>
                                            <?php } endforeach;?>  
                                            <?php  
                                                foreach($verify->items->verification->laboratoire as $labo): $laboqt=$labo->item_quantity; $laboup=$labo->item_u_p; 
                                                $tot_labo =$laboqt*$laboup;
                                                if(!empty($verify->items->laboratoire)){ $i++;
                                            ?>
                                            <tr>
                                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                                <td class="h-10 medi-btn w-12 px-2"><?=$labo->item?></td>
                                                <script>
                                                    function laboqtt(valu){ var x,y,k; k=<?=$labo->item_u_p?>*<?=$labo->item_quantity?>; x=<?=$labo->item_u_p?>*valu;
                                                        y=k-x; document.getElementById('tot_labo').value = x; document.getElementById('ded_labo').value = y;
                                                    }
                                                    function laboprice(valu){ var x,y,k; k=<?=$labo->item_u_p?>*<?=$labo->item_quantity?>; x=<?=$labo->item_quantity?>*valu;
                                                        y=k-x; document.getElementById('tot_labo').value = x; document.getElementById('ded_labo').value = y;
                                                    }
                                                </script>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$labo->item_quantity?>" onkeyup="laboqtt(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$labo->item_u_p?>" onkeyup="laboprice(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="tot_labo" value="<?=$tot_labo?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="ded_labo" value="<?=$labo->amounted?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2 medi-btn"  type="text" value="<?=$labo->comment?>"></td>
                                                <td class="medi-btn  text-center">
                                                    <div class="w-16  flex flex-row">
                                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button> -->
                                                    </div>
                                                </td>   
                                            </tr>
                                            <?php } endforeach;?>   
                                            <?php  
                                                foreach($verify->items->verification->medicines as $med): $medqt=$med->item_quantity; $medup=$med->item_u_p; 
                                                $tot_med =$medqt*$medup;
                                                if(!empty($verify->items->medicines)){ $i++;
                                            ?>
                                            <tr>
                                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                                <td class="h-10 medi-btn w-12 px-2"><?=$med->item?></td>
                                                <script>
                                                    function medqtt(valu){ var x,y,k; k=<?=$med->item_u_p?>*<?=$med->item_quantity?>; x=<?=$med->item_u_p?>*valu;
                                                        y=k-x; document.getElementById('tot_med').value = x; document.getElementById('ded_med').value = y;
                                                    }
                                                    function medprice(valu){ var x,y,k; k=<?=$med->item_u_p?>*<?=$med->item_quantity?>; x=<?=$med->item_quantity?>*valu;
                                                        y=k-x; document.getElementById('tot_med').value = x; document.getElementById('ded_med').value = y;
                                                    }
                                                </script>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$med->item_quantity?>" onkeyup="medqtt(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$med->item_u_p?>" onkeyup="medprice(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="tot_med" value="<?=$tot_med?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="ded_med" value="<?=$med->amounted?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2 medi-btn"  type="text" value="<?=$med->comment?>"></td>
                                                <td class="medi-btn  text-center">
                                                    <div class="w-16  flex flex-row">
                                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button> -->
                                                    </div>
                                                </td>   
                                            </tr>
                                            <?php } endforeach;?> 
                                            <?php  
                                                foreach($verify->items->verification->consommables as $conso): $consoqt=$conso->item_quantity; $consoup=$conso->item_u_p; 
                                                $tot_conso =$consoqt*$consoup;
                                                if(!empty($verify->items->consommables)){ $i++;
                                            ?>
                                            <tr>
                                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                                <td class="h-10 medi-btn w-12 px-2"><?=$conso->item?></td>
                                                <script>
                                                    function consoqtt(valu){ var x,y,k; k=<?=$conso->item_u_p?>*<?=$conso->item_quantity?>; x=<?=$conso->item_u_p?>*valu;
                                                        y=k-x; document.getElementById('tot_conso').value = x; document.getElementById('ded_conso').value = y;
                                                    }
                                                    function consoprice(valu){ var x,y,k; k=<?=$conso->item_u_p?>*<?=$conso->item_quantity?>; x=<?=$conso->item_quantity?>*valu;
                                                        y=k-x; document.getElementById('tot_conso').value = x; document.getElementById('ded_conso').value = y;
                                                    }
                                                </script>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$conso->item_quantity?>" onkeyup="consoqtt(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$conso->item_u_p?>" onkeyup="consoprice(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="tot_conso" value="<?=$tot_conso?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="ded_conso" value="<?=$conso->amounted?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2 medi-btn"  type="text" value="<?=$conso->comment?>"></td>
                                                <td class="medi-btn  text-center">
                                                    <div class="w-16  flex flex-row">
                                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button> -->
                                                    </div>
                                                </td>   
                                            </tr>
                                            <?php } endforeach;?>  
                                            <?php  
                                                foreach($verify->items->verification->soins as $soin): $soinqt=$soin->item_quantity; $soinup=$soin->item_u_p; 
                                                $tot_soin =$soinqt*$soinup;
                                                if(!empty($verify->items->soins)){ $i++;
                                            ?>
                                            <tr>
                                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                                <td class="h-10 medi-btn w-12 px-2"><?=$soin->item?></td>
                                                <script>
                                                    function soinqtt(valu){ var x,y,k; k=<?=$soin->item_u_p?>*<?=$soin->item_quantity?>; x=<?=$soin->item_u_p?>*valu;
                                                        y=k-x; document.getElementById('tot_soin').value = x; document.getElementById('ded_soin').value = y;
                                                    }
                                                    function soinprice(valu){ var x,y,k; k=<?=$soin->item_u_p?>*<?=$soin->item_quantity?>; x=<?=$soin->item_quantity?>*valu;
                                                        y=k-x; document.getElementById('tot_soin').value = x; document.getElementById('ded_soin').value = y;
                                                    }
                                                </script>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$soin->item_quantity?>" onkeyup="soinqtt(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" value="<?=$soin->item_u_p?>" onkeyup="soinprice(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="tot_soin" value="<?=$tot_soin?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2"  type="text" id="ded_soin" value="<?=$soin->amounted?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2 medi-btn"  type="text" value="<?=$soin->comment?>"></td>
                                                <td class="medi-btn  text-center">
                                                    <div class="w-16  flex flex-row">
                                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button> -->
                                                    </div>
                                                </td>   
                                            </tr>
                                            <?php } endforeach;?>                                            
                                            <?php  
                                                foreach($verify->items->verification->hospitalisation as $hosp): $hospqt=$hosp->item_quantity; $hospup=$hosp->item_u_p; 
                                                $tot_hosp =$hospqt*$hospup;
                                                if(!empty($verify->items->hospitalisation)){ $i++;
                                            ?>
                                            <tr>
                                                <td class="h-10 medi-btn w-12"><?=$i?></td>
                                                <td class="h-10 medi-btn w-12 px-2"><?=$hosp->item?></td>
                                                <script>
                                                    function hosqtt(valu){ var x,y,k; k=<?=$hosp->item_u_p?>*<?=$hosp->item_quantity?>; x=<?=$hosp->item_u_p?>*valu;
                                                        y=k-x; document.getElementById('tot_hosp').value = x; document.getElementById('ded_hosp').value = y;
                                                    }
                                                    function hosprice(valu){ var x,y,k; k=<?=$hosp->item_u_p?>*<?=$hosp->item_quantity?>; x=<?=$hosp->item_quantity?>*valu;
                                                        y=k-x; document.getElementById('tot_hosp').value = x; document.getElementById('ded_hosp').value = y;
                                                    }
                                                </script>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2" name="qtt" type="text" value="<?=$hosp->item_quantity?>" onkeyup="hosqtt(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2" name="u_p" type="text" value="<?=$hosp->item_u_p?>" onkeyup="hosprice(this.value);"></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2" name="tot_hosp" type="text" id="tot_hosp" value="<?=$tot_hosp?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2" name="deduct" type="text" id="ded_hosp" value="<?=$hosp->amounted?>" readonly></td>
                                                <td class="h-10 medi-btn w-12"><input class="m-2 w-8 p-2 medi-btn" name="comment" type="text" value="<?=$hosp->comment?>"></td>
                                                <input class="ml-6" type="hidden" name="order_id" value="<?=$hosp->item_order_id?>">
                                                <input class="ml-6" type="hidden" name="clid" value="<?=$cid?>">
                                                <input class="ml-6" type="hidden" name="item" value="<?=$hosp->item?>">

                                                <td class="medi-btn  text-center">
                                                    <div class="w-16  flex flex-row">
                                                        <button name="submit_hosp" class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                        <!-- <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button> -->
                                                    </div>
                                                </td>   
                                            </tr>
                                            <?php } endforeach;?>
                                        </tbody>
                                    </form>
                                </table>
                            <?php }endforeach ;

                                $rug = new Consult('../../data/rugarama.json');

                                if(isset($_POST['submit_hosp'])){

                                    $clid = $_POST['clid'];
                                    $oid = $_POST['order_id'];
                                    $item = $_POST['item'];
                                    $qtt = $_POST['qtt'];
                                    $up = $_POST['u_p'];
                                    $ded = $_POST['deduct'];
                                    $comment = $_POST['comment'];
                                    $today = date('Y-m-d');
                                    $time = date('Y-m-d H:m:s');


                                    foreach($consult as $unverify){
                                        foreach($unverify->items->verification->hospitalisation as $hosp):
                                        
                                            if($hosp->item_order_id == $oid){
                                                
                                                $data_veri=[["item_veri_type"=>"hospitalisation","item_order_id"=>$oid,"item_u_p"=>$up,"item_quantity"=>$qtt,"item"=>$item,"date"=>$today,"time"=>$time,"amounted"=>$ded,"comment"=>$comment]];
        
                                                echo $item;
                                                
                                                $rug->unverified($clid,'items',"hospitalisation",$data_veri,$item);

                                            }
                                        endforeach;
                                    }



                                }
                            ?>

                            </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>