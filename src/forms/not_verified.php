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
    <script src="../../jquery-3.3.1.min.js"></script>
    <title>.::CBHI::.</title>
    <style>
        .medi-container {
  box-shadow: 0px 0px 3px 0px #000;
}

.border-mediblue {
  border: 1px solid #1fb6ff;
}

.medi-btn {
  border: 1px solid indigo;
  /* width: 100%; */
}

.medi-client {
  box-shadow: 0px 0px 2px 0px #000;

}

.medi-menu {
  box-shadow: 0px 0px 5px 0px #000;

}

.medi-unique {
  position: absolute;
  border-radius: 0px 200px 10px 10px;
  width: 330px;
  border: 1px solid #09F;
  height: 38px;
  background-color: #BDF;
}

.medi-magic-btn-r {
  border-left: 1px solid red;
  border-right: 1px solid red;
}

.medi-magic-btn-l {
  border-left: 1px solid #1fb6ff;
  border-right: 1px solid #1fb6ff;
}

.medi_limit_span_veri {
  display: block;
  width: 160px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.medi_limit_span_check {
  display: inline-block;
  width: 190px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.medi_list::-webkit-scrollbar { 
  width: 0 !important;
  display: none; 
}
    </style>
    <script>
        let call = (id,ben,item,qty,unitp,date) => {      
            // if(qty==''){qty='null'}else{qty=qty}            
            $('#content').html(`<table class="w-90 m-1">
                                    <thead class="bg-white ">
                                        <tr>
                                        <th colspan="7" class="h-20 ">
                                            <div class="flex flex-row w-100 text-center ">
                                            <label for="" class=""> <h1 class="text-2xl text-zinc-600">
                                                <b  class="text-red-400 mb-4 mx-2">`+id+`</b>: `+ben+`</h1>
                                            </label>
                                            <form action="#">
                                            <button class="ml-6 p-2 w-20 rounded-md medi-btn" style="background-color: #A52A2A;color:whitesmoke"><b>Done</b></button>
                                            </form>
                                            <form action="../../../muhima/form_verify.php?cod2=`+id+`&cod22=`+date+`" method="POST" target="_blank">                                            
                                            <button class="ml-6 p-2 w-20 rounded-md med-btn"  style="background-color: #66CDAA; "><b>Form</b></button>
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
                                    <tbody class="medi-btn">
                                        <tr class=" h-12">
                                            <td class="medi-btn  text-center w-12">-</td>
                                            <td class="medi-btn  text-left "> 
                                                <b class="ml-4 text-zinc-600">`+item+`</b> 
                                                <input class="ml-6" type="hidden" >
                                                <input class="ml-6" type="hidden">
                                                <input class="ml-6" type="hidden">
                                            </td>
                                            <td class="medi-btn  text-center">
                                            <input class="m-2 w-8 p-2"  type="text" placeholder="`+qty+`">
                                            </td>
                                            <td class="medi-btn  text-center">
                                            <input class="m-2 w-12 p-2" type="text" placeholder="`+unitp+`">
                                            </td>
                                            <td class="medi-btn  text-center">
                                            <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                                            </td>
                                            <td class="medi-btn  text-center">
                                            <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                                            </td>
                                            <td class="medi-btn  text-left "> 
                                            <input class="ml-6" type="text" placeholder="`+item+`">
                                            </td>
                                            <td class="medi-btn  text-center">
                                            <div class="w-16  flex flex-row">
                                                <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                                <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>`);
        }
    </script>
</head>
<body style="background-image: url('../../img/31.jpg');" id="bg">
    <?php $consult =json_decode(file_get_contents('../../data/rugarama.json'))?>
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
                    <select class="form-select px-12 py-2 border-black rounded-t-lg" onchange='call(this.value,<?php echo json_encode($consult); ?>)'>
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
                    <?php $v_c=0; $v_v=0; foreach($consult as $check): $v_c += $check->checked; $v_v += $check->verified; endforeach; $v_check =$v_c - $v_v;?>
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

            <div class="veri h-4/5 mb-8" style="background-color:#999; height:698px; overflow: hidden;">
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
                            <div class="flex flex-col" style="width: 400px;">
                                <div class="w-100  flex flex-row">
                                <span class="w-6 text-1xl mr-2 ml-6 mt-2"> <b><?= $i; ?>. &nbsp;</b> </span>
                                <span class="w-128 text-2xl ml-1 mt-2 medi_limit_span_veri"> <b><?= $uncheck->bene;  ?></b></span><br>
                                <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;"><?= $uncheck->client_id;  ?></b></span>
                                </div>
                                <div class="w-100  flex flex-row">
                                <span class="w-2/3 my-3 text-sm ml-2 bg-red-0">sex: <b class="text-md "><?= $uncheck->sex;  ?></b> age:
                                    <b><?= $uncheck->age;  ?></b> &nbsp;CAT: <b class="text-md mr-2"><?= $uncheck->cat;  ?></b></span>&nbsp;
                                <span class="w-1/2 text-sm my-3 bg-blue-50">(Tot:<b style="color: red;"><?php 
                                    foreach($uncheck->items->medicines as $cons): $qt=$meds->med_quantity; $up=$meds->med_u_p; $mtot=$qt*$up; endforeach;
                                    foreach($uncheck->items->consommables as $cons): $qt=$cons->conso_quantity; $up=$cons->conso_u_p; $ctot=$qt*$up; endforeach;
                                    $t=$mtot+$ctot; echo $t;
                                ?></b> Frw)</span>
                                </div>

                            </div>
                            <div class="w-16  flex flex-col">
                                <button class="pb-1 pl-2 m-2 medi-btn rounded-md" id="" style="background-color:#6698FF;">
                                <b class="m-1 text-white" onclick='call(<?= $uncheck->client_id; ?>,<?= json_encode($uncheck->bene); ?>,<?= json_encode($uncheck->med_item); ?>,<?= $uncheck->med_qtty; ?>,<?= $uncheck->med_u_p; ?>,<?= json_encode($uncheck->date); ?>,)'>>></b>
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
                        </di>
                        <?php }endforeach ?>
                    </div>
                    <div class="tableveri h-auto w-3/4 m-4 medi-client rounded-md border-red-200" style="background-color:#C9DFEC; height:678px;">
                        <?php //$i=0; foreach($consult as $uncheck): $i++;?>
                            <div class="bg-white flex flex-col h-auto w-90 m-4 medi-client rounded-md border-red-200" id="content">                                
                            </div>
                        <?php //endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>