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
        let call = (id,ben,date,items) => {      
            // if(item.consultation){console.log('consu')}else{console.log('non consu')}                        
            // console.log(item);      
            // $.map(items,(item,i) => console.log(i,item));            
            // $.map(items,(item,i) => {
            //     if(i==='laboratory'){                    
            //         $.map(item,(it,ind)=>{ console.log(ind,it)  })
            //     }
            // });

            $('#head').html(`<label for="" class=""> <h1 class="text-2xl text-zinc-600">
                                <b  class="text-red-400 mb-4 mx-2">`+id+`</b>: `+ben+`</h1>
                                </label>
                                <form action="#">
                                <button class="ml-6 p-2 w-20 rounded-md medi-btn" style="background-color: #A52A2A;color:whitesmoke"><b>Done</b></button>
                                </form>
                                <form action="../../../muhima/form_verify.php?cod2=`+id+`&cod22=`+date+`" method="POST" target="_blank">                                            
                                <button class="ml-6 p-2 w-20 rounded-md med-btn"  style="background-color: #66CDAA; "><b>Form</b></button>
                                </form>                                                                                                                            
                                        `);

            $.map(items,(item,i) => { 
                if(i==='consultation'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').html(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.cons_item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" value="`+it.cons_qtty+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="`+it.cons_u_p+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="34.4">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="34.4">
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="ml-6" type="text" value="`+it.cons_item+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button `+onclick()+` class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );        
                });
                } 

                if(i==='laboratory'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').append(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.lab_item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" value="`+it.lab_qtty+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="`+it.lab_unityp+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="34.4">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="34.4">
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="ml-6" type="text" value="`+it.lab_item+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );
                     });
                }

                if(i==='medicines'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').append(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.med_item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" value="`+it.med_qtty+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="`+it.med_u_p+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="ml-6" type="text" value="`+it.med_item+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );
                });
                }

                if(i==='consommables'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').append(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.conso_item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" value="`+it.conso_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" value="`+it.conso_u_p+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="ml-6" type="text" value="`+it.conso_item+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );
                });
                }
            });            
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
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; <b class="text-3xl text-center" id="unchecked">0</b> &nbsp;Unchecked</div>
                </a>                
                <a href="not_verified.php">
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; <b class="text-3xl text-center" id="unverified">0</b> &nbsp;Not Verified</div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">

            <!-- ================== ni hano boby itangirira ===================================-->

            <div class="veri h-4/5 mb-8" style="background-color:#999; height:700px; overflow: hidden;">
                <div class="check flex flex-row">
                    <div class="bg-indigo-100 m-4 medi-client rounded-md" style="background-color:#C9DFEC; height:678px; width: 400px;">
                        <div class="bg-white flex flex-row h-20 w-90 m-4 medi-client rounded-md border-red-200">
                            <div class="w-100">
                                <input type="search" id="search" class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">        
                            </div>
                        </div>
                        <?php $i=0; foreach($consult as $uncheck): $i++;?> 
                        <di class="bg-white flex flex-row h-20 w-90 m-4 medi-client rounded-md border-red-200">
                            <div class="w-20 flex flex-col">
                                <input type="checkbox" name="" class="rounded-xl mx-8 mt-8 " id="">
                            </div>
                            <div class="w-10/12 bg-indigo-50 flex flex-col">
                                <div class="w-100  flex flex-row">
                                <span class="w-6 text-1xl ml-6 mt-2"> <b><?= $i; ?></b> </span>
                                <span class="w-128 text-2xl ml-1 mt-2 medi_limit_span_veri"> <b><?= $uncheck->bene;  ?></b></span><br>
                                <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b><?= $uncheck->client_id;  ?></b></span>
                                </div>
                                <div class="w-100  flex flex-row">
                                <span class="w-2/3 my-3 text-sm ml-2 bg-red-0">sex: <b class="text-md "><?= $uncheck->sex;  ?></b> age:
                                    <b><?= $uncheck->age;  ?></b> &nbsp;CAT: <b class="text-md "><?= $uncheck->cat;  ?></b></span><br>
                                <span class="w-1/2 text-sm my-3 bg-blue-50">(Tot:<b class="text-red-600"><?= $uncheck->med_u_p;  ?></b> Frw)</span>
                                </div>

                            </div>
                            <div class="w-16  flex flex-col">
                                <button class="pb-1 pl-2 m-2 medi-btn rounded-md" id="" style="background-color:#6698FF;">
                                <b class="m-1 text-white" onclick='call(<?= $uncheck->client_id; ?>,<?= json_encode($uncheck->bene); ?>,<?= json_encode($uncheck->day); ?>,<?= json_encode($uncheck->items); ?>)'>>></b>
                                </button>
                                <label class="text-1xl py-0 ml-3"> 0<i class="text-sm"> -- </i> 5</label>
                            </div>
                        </di>
                        <?php endforeach ?>
                    </div>
                    <div class="tableveri h-auto w-3/4 m-4 medi-client rounded-md border-red-200" style="background-color:#C9DFEC; height:678px;">                        
                            <div class="bg-white flex flex-col h-auto w-90 m-4 medi-client rounded-md border-red-200" id="content">       
                            <table class="w-90 m-1">
                                    <thead class="bg-white ">
                                        <tr>
                                        <th colspan="7" class="h-20 ">
                                            <div class="flex flex-row w-100 text-center" id="head"></div>
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
                                    <tbody class="medi-btn" id="body">
                                        
                                    </tbody>
                                </table>
                            </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>