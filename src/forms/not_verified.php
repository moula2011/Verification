<?php 
include('./../../link.php'); 
$calender =json_decode(file_get_contents('../../data/calender.json'));
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
        let ded = (int,typ,item) => {
            let amountbefore = document.getElementById(item+'_tot_b').value;
            let qty = document.getElementById(item+'_quantity').value; 
            let total = qty * int;
            let res = amountbefore-total;
            let totaled = document.getElementById(item+'_total').innerHTML=`<input class="m-2 w-12 p-2" type="text" id="`+item+`_totaled" value="`+total+`" disabled="disabled"/>`;            
            let amounted = document.getElementById(item+'_amount').innerHTML=`<input class="m-2 w-12 p-2" type="text" id="`+item+`_amounted" value="`+res+`" disabled="disabled"/>`;            
        }

        let quan = (int,typ,item) => {
            let qtybefore = document.getElementById(item+'_qty_b').value;
            let up = document.getElementById(item+'_u_p').value;
            let qty = document.getElementById(item+'_quantity').value;
            let totalbefore = qtybefore * up;
            let total = int * up;
            let res = totalbefore-total;
            let totaled = document.getElementById(item+'_total').innerHTML=`<input class="m-2 w-12 p-2" type="text" id="`+item+`_totaled" value="`+total+`" disabled="disabled"/>`;            
            let amounted = document.getElementById(item+'_amount').innerHTML=`<input class="m-2 w-12 p-2" type="text" id="`+item+`_amounted" value="`+res+`" disabled="disabled"/>`;            
        }

        let callDone = (id) => {
            $.ajax({
                url: "verifadd.php",
                type: "POST",
                data: "cid="+id,
                success: function (data) {
                    console.log(data);                    
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }				
            }); // AJAX 
        }

        let callDate = (date,data) => {              
             let i = 0; 
             let consul = 0;
             let labo = 0;
             let meds = 0;
             let conso = 0;
             let soins = 0;
             let hosp = 0;
             let tot_items = 0;

             $.get('../load/php/check/check.php?date='+date,function(data){
                $('#checked').html(data);
            });  

            $.get('../load/php/check/verify.php?date='+date,function(data){
                    $('#unverified').html(data); 
                });
            $.get('../load/php/check/checklist.php?date='+date,function(data){
                $('#checklist').html(data); 
            });   

             $('#datez').html('');         
             $.map(data,(dat) => {
                    consul = dat.items.consultation.length;
                    labo = dat.items.laboratoire.length;
                    meds = dat.items.medicines.length;
                    conso = dat.items.consommables.length;
                    soins = dat.items.soins.length;
                    hosp = dat.items.hospitalisation.length;
                    tot_items = consul+labo+meds+conso+soins+hosp;
                 if(dat.day===date && dat.done===0 && tot_items!==0){
                     /////
                     let tconso = 0;
                     let tlab = 0;
                     let tmed = 0;
                     let tcons = 0;
                     let tsoin = 0;
                     let thosp = 0;
                     let gt = 0;
                     $.map(dat.items.consommables,(conso)=>{
                         tconso += conso.conso_u_p*conso.conso_quantity;                        
                     });
                     $.map(dat.items.laboratoire,(lab)=>{
                         tlab += lab.lab_u_p*lab.lab_quantity;                        
                     });
                     $.map(dat.items.medicines,(med)=>{
                         tmed += med.med_u_p*med.med_quantity;                        
                     });
                     $.map(dat.items.consultation,(cons)=>{
                         tcons += cons.cons_u_p*cons.cons_quantity;                        
                     });
                     $.map(dat.items.soins,(soin)=>{
                         tsoin += soin.act_med_u_p*soin.act_med_quantity;                        
                     });
                     $.map(dat.items.hospitalisation,(hosp)=>{
                         thosp += hosp.hosp_u_p*hosp.hosp_quantity;                        
                     });

                     gt = tconso+tlab+tmed+tcons+tsoin+thosp;
                    //  console.log(gt)
                     /////
                    
                    i++;                    
                    $('#datez').append(`<div class="flex flex-row mx-4 my-2 medi-client rounded-md bg-white" style="opacity: 0.8;">
                            <div class="w-20 flex flex-col">
                                <input type="checkbox" name="" class="rounded-xl mx-4 mt-8 " id="">
                            </div>
                            <div class="flex flex-col" style="width: 400px;">
                                <div class="w-100  flex flex-row">
                                <span class="w-6 text-1xl mr-2 ml-6 mt-2"> <b>`+dat.voucher_no+` &nbsp;</b> </span>
                                <span class="w-128 text-2xl ml-1 mt-2 medi_limit_span_veri"> <b>`+dat.bene+`</b></span><br>
                                <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;">`+dat.client_id+`</b></span>
                                </div>
                                <div class="w-100  flex flex-row">
                                <span class="w-2/3 my-3 text-sm ml-2 bg-red-0">sex: <b class="text-md ">`+dat.sex+`</b> age:
                                    <b>`+dat.age+`</b> &nbsp;CAT: <b class="text-md mr-2">`+dat.cat+`</b></span>&nbsp;
                                <span class="w-1/2 text-sm my-3 bg-blue-50">(Tot:<b style="color: red;">`+gt+`</b> Frw)</span>
                                </div>

                            </div>
                            <div class="w-16  flex flex-col">
                                <button class="pb-1 pl-2 m-2 medi-btn rounded-md" id="" style="background-color:#6698FF;">
                                <b class="m-1 text-white" onclick='call(`+dat.client_id+`,`+dat.insurance_code+`,`+JSON.stringify(dat.bene)+`,`+JSON.stringify(dat.day)+`,`+JSON.stringify(dat.items.verification)+`)'>>></b>
                                </button>
                                <label class="text-1xl py-0 ml-3">`+tot_items+`</label>
                            </div>
                        </div>`);
                 }               
            });
        }

        let change = (tem,typ) => {
            let id = document.getElementById('id').value;
            let insu = document.getElementById('insu').value;
            let qtty = document.getElementById(tem+'_quantity').value;
            let item = document.getElementById(tem+'_item').value;
            let oid = document.getElementById(tem+'_oid').value;
            let up = document.getElementById(tem+'_u_p').value;
            let date = document.getElementById(typ+'_date').value;
            let type = document.getElementById(typ+'_veri_type').value;
            let amounted = document.getElementById(item+'_amounted').value;
            let comment = document.getElementById(item+'_comment').value;
            let tot = qtty * up;
            let t = new Date();
            let hours = t.getHours();
            let minutes = t.getMinutes();
            let seconds = t.getSeconds();
            let day = (t.getDate() > 9) ? t.getDate() : '0' + t.getDate();
            let month = ((t.getMonth()+1) > 9) ? t.getMonth()+1 : '0' + (t.getMonth()+1);
            let year = t.getFullYear();
            let time = year+"-"+month+"-"+day+" "+hours+":"+minutes+":"+seconds;
        
            $.ajax({
                url: "verifadd.php",
                type: "POST",
                data: "id="+id+"&item="+item+"&qtty="+qtty+"&date="+date+"&up="+up+"&type="+type+"&amountde="+amounted+"&comment="+comment+"&time="+time+"&oid="+oid+"&insu="+insu,
                success: function (data) {
                    console.log(data);
                    // if(data){alert('Saved Successfully !!!');}
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }				
            }); // AJAX 
        }

        let call = (id,insu,ben,date,items) => {      
            $('#head').html(`<label for="" class=""> <h1 class="text-2xl text-zinc-600">
                <b  class="text-red mb-4 mx-2" style="color:blue">`+id+`</b>: `+ben+`</h1>
                </label>
                <form>
                <button class="ml-6 p-2 w-20 rounded-md medi-btn" style="background-color: #A52A2A;color:whitesmoke" onclick="callDone(`+id+`)"><b>Done</b></button>
                </form>
                <form action="../../../rugarama/form_verify.php?cod2=`+id+`&cod22=`+date+`" method="POST" target="_blank">                                            
                <button class="ml-6 p-2 w-20 rounded-md med-btn"  style="background-color: #66CDAA;"><b>Form</b></button>
                </form>                                                                          
                <input type="text" id="myInput" onkeyup='tableSearch()' class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off" style="position:absolute;right:100px;">
                        `);
            $('#body').html('');

            $.map(items,(item,i) => { 
                if(i==='consultation'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').append(`<tr class=" h-12">                    
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" id="`+it.item+`_quantity" onkeyup="quan(this.value,'`+i+`','`+it.item+`')" value="`+it.item_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_u_p" onkeyup="ded(this.value,'`+i+`','`+it.item+`')" value="`+it.item_u_p+`">
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_total">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_totaled" value="`+it.item_quantity * it.item_u_p+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_amount">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_amounted" value="`+it.amounted+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="m-2 medi-btn" type="text" id="`+it.item+`_comment" value="`+it.comment+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_item" value="`+it.item+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_oid" value="`+it.item_order_id+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_tot_b" value="`+it.item_quantity * it.item_u_p+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_qty_b" value="`+it.item_quantity+`">
                        <input class="ml-6" type="hidden" id="`+i+`_date" value="`+date+`">
                        <input class="ml-6" type="hidden" id="id" value="`+id+`">
                        <input class="ml-6" type="hidden" id="insu" value="`+insu+`">
                        <input class="ml-6" type="hidden" id="`+i+`_veri_type" value="`+i+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;" id="`+it.item+`" onclick="change(this.id,'`+i+`')">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );        
                });
                } 

                if(i==='laboratoire'){
                    $.map(item,(it,ind)=>{                         
                    $('#body').append(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" id="`+it.item+`_quantity" onkeyup="quan(this.value,'`+i+`','`+it.item+`')" value="`+it.item_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_u_p" onkeyup="ded(this.value,'`+i+`','`+it.item+`')" value="`+it.item_u_p+`">
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_total">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_totaled" value="`+it.item_quantity * it.item_u_p+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_amount">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_amounted" value="`+it.amounted+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="m-2 medi-btn" type="text" id="`+it.item+`_comment" value="`+it.comment+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_item" value="`+it.item+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_oid" value="`+it.item_order_id+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_tot_b" value="`+it.item_quantity * it.item_u_p+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_qty_b" value="`+it.item_quantity+`">
                        <input class="ml-6" type="hidden" id="`+i+`_date" value="`+date+`">
                        <input class="ml-6" type="hidden" id="id" value="`+id+`">
                        <input class="ml-6" type="hidden" id="insu" value="`+insu+`">
                        <input class="ml-6" type="hidden" id="`+i+`_veri_type" value="`+i+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;" id="`+it.item+`" onclick="change(this.id,'`+i+`')">+</button>
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
                            <b class="ml-4 text-zinc-600">`+it.item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" id="`+it.item+`_quantity" onkeyup="quan(this.value,'`+i+`','`+it.item+`')" value="`+it.item_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_u_p" onkeyup="ded(this.value,'`+i+`','`+it.item+`')" value="`+it.item_u_p+`">
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_total">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_totaled" value="`+it.item_quantity * it.item_u_p+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_amount">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_amounted" value="`+it.amounted+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="m-2 medi-btn" type="text" id="`+it.item+`_comment" value="`+it.comment+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_item" value="`+it.item+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_oid" value="`+it.item_order_id+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_tot_b" value="`+it.item_quantity * it.item_u_p+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_qty_b" value="`+it.item_quantity+`">
                        <input class="ml-6" type="hidden" id="`+i+`_date" value="`+date+`">
                        <input class="ml-6" type="hidden" id="id" value="`+id+`">
                        <input class="ml-6" type="hidden" id="insu" value="`+insu+`">
                        <input class="ml-6" type="hidden" id="`+i+`_veri_type" value="`+i+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;" id="`+it.item+`" onclick="change(this.id,'`+i+`')">+</button>
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
                            <b class="ml-4 text-zinc-600">`+it.item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" id="`+it.item+`_quantity" onkeyup="quan(this.value,'`+i+`','`+it.item+`')" value="`+it.item_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_u_p" onkeyup="ded(this.value,'`+i+`','`+it.item+`')" value="`+it.item_u_p+`">
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_total">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_totaled" value="`+it.item_quantity * it.item_u_p+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_amount">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_amounted" value="`+it.amounted+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="m-2 medi-btn" type="text" id="`+it.item+`_comment" value="`+it.comment+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_item" value="`+it.item+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_oid" value="`+it.item_order_id+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_tot_b" value="`+it.item_quantity * it.item_u_p+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_qty_b" value="`+it.item_quantity+`">
                        <input class="ml-6" type="hidden" id="`+i+`_date" value="`+date+`">
                        <input class="ml-6" type="hidden" id="id" value="`+id+`">
                        <input class="ml-6" type="hidden" id="insu" value="`+insu+`">
                        <input class="ml-6" type="hidden" id="`+i+`_veri_type" value="`+i+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;" id="`+it.item+`" onclick="change(this.id,'`+i+`')">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );
                });
                }

                if(i==='soins'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').append(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" id="`+it.item+`_quantity" onkeyup="quan(this.value,'`+i+`','`+it.item+`')" value="`+it.item_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_u_p" onkeyup="ded(this.value,'`+i+`','`+it.item+`')" value="`+it.item_u_p+`">
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_total">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_totaled" value="`+it.item_quantity * it.item_u_p+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_amount">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_amounted" value="`+it.amounted+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="m-2 medi-btn" type="text" id="`+it.item+`_comment" value="`+it.comment+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_item" value="`+it.item+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_oid" value="`+it.item_order_id+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_tot_b" value="`+it.item_quantity * it.item_u_p+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_qty_b" value="`+it.item_quantity+`">
                        <input class="ml-6" type="hidden" id="`+i+`_date" value="`+date+`">
                        <input class="ml-6" type="hidden" id="id" value="`+id+`">
                        <input class="ml-6" type="hidden" id="insu" value="`+insu+`">
                        <input class="ml-6" type="hidden" id="`+i+`_veri_type" value="`+i+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;" id="`+it.item+`" onclick="change(this.id,'`+i+`')">+</button>
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                        </div>
                        </td>
                    </tr>`
                    );
                });
                }

                if(i==='hospitalisation'){
                    $.map(item,(it,ind)=>{ 
                    $('#body').append(`<tr class=" h-12">
                        <td class="medi-btn  text-center w-12">-</td>
                        <td class="medi-btn  text-left "> 
                            <b class="ml-4 text-zinc-600">`+it.item+`</b> 
                            <input class="ml-6" type="hidden" >
                            <input class="ml-6" type="hidden">
                            <input class="ml-6" type="hidden">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-8 p-2"  type="text" id="`+it.item+`_quantity" onkeyup="quan(this.value,'`+i+`','`+it.item+`')" value="`+it.item_quantity+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_u_p" onkeyup="ded(this.value,'`+i+`','`+it.item+`')" value="`+it.item_u_p+`">
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_total">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_totaled" value="`+it.item_quantity * it.item_u_p+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-center" id="`+it.item+`_amount">
                        <input class="m-2 w-12 p-2" type="text" id="`+it.item+`_amounted" value="`+it.amounted+`" disabled="disabled"/>
                        </td>
                        <td class="medi-btn  text-left "> 
                        <input class="m-2 medi-btn" type="text" id="`+it.item+`_comment" value="`+it.comment+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_item" value="`+it.item+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_oid" value="`+it.item_order_id+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_tot_b" value="`+it.item_quantity * it.item_u_p+`">
                        <input class="ml-6" type="hidden" id="`+it.item+`_qty_b" value="`+it.item_quantity+`">
                        <input class="ml-6" type="hidden" id="`+i+`_date" value="`+date+`">
                        <input class="ml-6" type="hidden" id="id" value="`+id+`">
                        <input class="ml-6" type="hidden" id="insu" value="`+insu+`">
                        <input class="ml-6" type="hidden" id="`+i+`_veri_type" value="`+i+`">
                        </td>
                        <td class="medi-btn  text-center">
                        <div class="w-16  flex flex-row">
                            <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;" id="`+it.item+`" onclick="change(this.id,'`+i+`')">+</button>
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
            <div class="medi-unique flex flex-row" style="top: 25px; height: 50px; width: 720px;">
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">DATE:</label>
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style="width: 172px; height: 30px;" onchange='callDate(this.value,<?php echo json_encode($consult); ?>)'>
                        <?php
                            echo '<option value="">select date...</option>';
                            foreach($calender->dates as $date):                              
                                    echo '<option value="'.$date.'">'.$date.'</option>';                                
                            endforeach ; 
                        ?>                        
                    </select>
                </div>
                <div class="uppercase tracking-wide text-md text-black-500 ">
                    <label for="" class="m-2">Holidays:</label>
                    <select class="form-select mt-2 px-12 py-2 medi-btn rounded-md" style=" height: 30px; width:320px;">
                    <?php
                            echo '<option value="">select holidays...</option>';
                            foreach($calender->holidays as $holiday):                                    
                                echo '<option value="'.$holiday.'">'.$holiday.'</option>';
                            endforeach ;   
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

            <!-- ================== ni hano boby itangirira ===================================-->

            <div class="veri h-4/5 mb-8" style="background-color:#999; height:698px; overflow: hidden;">
                <div class="check flex flex-row">
                    <div class="bg-indigo-100 mx-4 mt-2 medi-client rounded-md" style="background-color:#C9DFEC; height:680px; width: 460px; overflow: hidden;">
                        <div class="flex flex-row rounded-md">
                            <div class="w-100">
                                <!-- <input type="text" class="search-btn" id="myInput" onkeyup='tableSearch()' placeholder="search client by code"> -->
                                <!-- <input type="search" id="myInput" onkeyup='tableSearch()' class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">        -->
                            </div>
                        </div>
                        <div id="datez">
                        <?php //$i=0; foreach($consult as $uncheck): $i++; if($uncheck->done == 0 && $uncheck->day == date('Y-m-d')){?>
                        <!-- <div class="flex flex-row mx-4 my-2 medi-client rounded-md bg-white" style="opacity: 0.8;background-color:#f00;">
                            <div class="w-20 flex flex-col">
                                <input type="checkbox" name="" class="rounded-xl mx-4 mt-8 " id="">
                            </div>
                            <div class="flex flex-col" style="width: 400px;">
                                <div class="w-100  flex flex-row">
                                <span class="w-6 text-1xl mr-2 ml-6 mt-2"> <b><?= $i; ?>. &nbsp;</b> </span>
                                <span class="w-128 text-2xl ml-1 mt-2 medi_limit_span_veri"> <b><?= $uncheck->bene; ?></b></span><br>
                                <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;"><?= $uncheck->client_id; ?></b></span>
                                </div>
                                <div class="w-100  flex flex-row">
                                <span class="w-2/3 my-3 text-sm ml-2 bg-red-0">sex: <b class="text-md "><?= $uncheck->sex; ?></b> age:
                                    <b><?= $uncheck->age; ?></b> &nbsp;CAT: <b class="text-md mr-2"><?= $uncheck->cat; ?></b></span>&nbsp;
                                <span class="w-1/2 text-sm my-3 bg-blue-50">(Tot:<b style="color: red;">
                                <?php 
                                    // $cup=0; $lab=0; $tot=0; 
                                    // $mqt=0; $mup=0; $mtot=0; 
                                    // $consoqt=0; $consup=0; $consotot=0; 
                                    // $soinqt=0; $soinup=0; $sointot=0; 
                                    // $hospqt=0; $hospup=0; $hosptot=0; 
                    
                                    // foreach($uncheck->items->consultation as $consul): $cup+=$consul->cons_u_p; endforeach;
                                    // foreach($uncheck->items->laboratoire as $labo): $lab+=$labo->lab_u_p; endforeach;
                                    // foreach($uncheck->items->medicines as $meds): $mqt+=$meds->med_quantity; $mup+=$meds->med_u_p; endforeach;
                                    // foreach($uncheck->items->consommables as $cons): $consoqt+=$cons->conso_quantity; $consup+=$cons->conso_u_p;  endforeach;
                                    // foreach($uncheck->items->soins as $cons): $soinqt+=$cons->act_med_quantity; $soinup+=$cons->act_med_u_p;  endforeach;
                                    // foreach($uncheck->items->hospitalisation as $cons): $hospqt+=$cons->hosp_quantity; $hospup+=$cons->hosp_u_p;  endforeach;
                    
                                    // $mtot=$mqt*$mup;
                                    // $consotot=$consoqt*$consup; 
                                    // $sointot=$soinqt*$soinup; 
                                    // $hosptot=$hospqt*$hospup; 
                    
                                    // $tot=$cup+$lab+$mtot+$consotot+$sointot+$hosptot; echo $tot;
                                ?>
                                </b> Frw)</span>
                                </div>

                            </div>
                            <div class="w-16  flex flex-col">
                                <button class="pb-1 pl-2 m-2 medi-btn rounded-md" id="" style="background-color:#6698FF;">
                                <b class="m-1 text-white" onclick='call(<?= $uncheck->client_id; ?>,<?= $uncheck->insurance_code; ?>,<?= json_encode($uncheck->bene); ?>,<?= json_encode($uncheck->day); ?>,<?= json_encode($uncheck->items->verification); ?>)'>>></b>
                                </button>
                                <label class="text-1xl py-0 ml-3">
                                    <?php 
                                        // $med=count($uncheck->items->medicines); $conso=count($uncheck->items->consommables); 
                                        // $consul=count($uncheck->items->consultation); $lab= count($uncheck->items->laboratoire); 
                                        // $soins=count($uncheck->items->soins);$hosp= count($uncheck->items->hospitalisation); 
                                        // $tot =$med+$conso+$consul+$lab+$soins+$hosp;
                                    ?>
                                    <?= $tot?>
                                </label>
                            </div>
                        </div> -->
                        <?php //} endforeach ?>
                        </div>
                    </div>
                    <div class="tableveri h-auto w-3/4 m-4 medi-client rounded-md border-red-200" style="background-color:#C9DFEC; height:678px;">                        
                            <div class="bg-white flex flex-col h-auto w-90 m-4 medi-client rounded-md border-red-200" id="content">       
                            <table class="w-90 m-1" id="myTable">
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
    <script type="application/javascript">
        $('Document').ready(function(){ callDate(<?php echo json_encode(date('Y-m-d')); ?>,<?php echo json_encode($consult); ?>);});
        function tableSearch() {
            let input, filter, table, tr, td, txtValue;

            //Intialising Variables
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (let i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

        }
    </script>
</body>
</html>