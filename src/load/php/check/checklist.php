<?php
    error_reporting(1|0);
    $consult =json_decode(file_get_contents('../../../../data/rugarama.json'));

    $date=$_REQUEST['date'];
    
?>

<div class="flex flex-row rounded-md">
    <div class="w-100">
        <input type="search" id="search" class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">
    </div>
</div>
<?php  foreach($consult as $uncheck): if($uncheck->day == $date && $uncheck->checked == 1){ ?>
    <form action="check.php" method="post">
        <div class="flex flex-row h-auto w-90 m-4 medi-client rounded-md border-red-200">
            <div class="w-16 bg-white rounded-md mr-2">
                <input value="<?= $uncheck->client_id?>"  type="checkbox" class="mx-4 mt-8 " name="checku[]" id="checkall">
            </div>
            <div class="flex flex-col" style="width: 806px; background-color:#E3E4FA;opacity:0.8;" onclick='showData(<?php echo $uncheck->client_id; ?>,<?php echo json_encode($uncheck->items); ?>)'>
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
                                    $k=0;
                                    foreach($uncheck->items->consultation as $consu): endforeach; 
                                    if($uncheck->checked == 1 && $consu->insured == 1){
                                        $k++;
                                        echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$consu->cons_item.'" class="ml-2" id="'.$consu->cons_item.'">
                                        <b> '.$k.'-</b>
                                        <label style="width: 86px; height: 20px;" for="'.$consu->cons_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
                                        if($uncheck->checked == 1 && $consu->insured == 1){$consul=count($uncheck->items->consultation); }
                                        echo 'Consult...:<b class="text-md ml-2">'.$consul; 
                                        echo '</b></label>';
                                        echo '<label for="'.$consu->cons_item.'" class="w-8 text-md my-2 ">
                                        (<b>Tot: </b><b style="color: red;">'.$consu->cons_u_p.'</b> Rwf)
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                        echo'<br>';

                                    }
                                    
                                ?> 
                            </td>
                            <td>
                                <?php 
                                    foreach($uncheck->items->medicines as $meds): endforeach;
                                    if($uncheck->checked == 1 && $meds->insured == 1){$med=count($uncheck->items->medicines);
                                        $k++;
                                        echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$meds->med_item.'" class="ml-2" id="'.$meds->med_item.'">
                                        <b> '.$k.'-</b>
                                        <label style="width: 86px; height: 20px;" for="'.$meds->med_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
                                        echo'Medic...:<b class="text-md ml-2">'.$med; 
                                        echo '</label>';
                                        echo '<label for="'.$meds->med_item.'" class="w-28 text-md my-2 ml-3 ">
                                        (<b>Tot: </b><b style="color: red;">'.$meds->med_u_p.'</b> Rwf)
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                        echo'<br>';
                                    }
                                ?>                                                                                
                            </td>

                            <td class="">
                                <?php 
                                    foreach($uncheck->items->consommables as $consoms): endforeach;
                                        if($uncheck->checked == 1 && $consoms->insured == 1){$conso= count($uncheck->items->consommables);
                                            $k++;
                                            echo '<input type="hidden" name="checkup[]" value="'.$consoms->conso_item.'" class=" mr-1 my-1" id="'.$consoms->conso_item.'">
                                            <b> '.$k.'-</b>
                                            <label style="width: 86px; height: 20px;" for="'.$consoms->conso_item.'" class="text-md mt-2 text-black medi_limit_span_check ">';
                                            echo'Consom...:<b class="text-md ml-2">'.$conso;
                                            echo '</label>';
                                            echo '<label for="'.$consoms->conso_item.'" class="text-md mt-2 ml-3 ">
                                            (<b>Tot: </b><b style="color: red;">'.$consoms->conso_u_p.'</b> Rwf)
                                            </label>';
                                            echo'<br>';
                                        }
                                    
                                ?>
                            </td>
                        </tr >
                        <tr class="">
                            <td>
                                <?php 
                                    $k=0;$k=0;
                                    foreach($uncheck->items->laboratoire as $labo): endforeach; 
                                    if($uncheck->checked == 1 && $labo->insured == 1){$lab= count($uncheck->items->laboratoire);
                                        $k++;
                                        echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$labo->lab_item.'" class="ml-2" id="'.$labo->lab_item.'">
                                        <b> '.$k.'-</b>
                                        <label style="width: 86px; height: 20px;" for="'.$labo->lab_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
                                        echo 'labo...:<b class="text-md ml-2">'.$lab; 
                                        echo '</b></label>';
                                        echo '<label for="'.$labo->lab_item.'" class="w-8 text-md my-2 ">
                                        (<b>Tot: </b><b style="color: red;">'.$labo->lab_u_p.'</b> Rwf)
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                        echo'<br>';

                                    }
                                    
                                ?> 
                            </td>
                            <td>
                                <?php 
                                    foreach($uncheck->items->soins as $soins):  endforeach;
                                    if($uncheck->checked == 1 && $soins->insured == 1){$soin=count($uncheck->items->soins);
                                        $k++;
                                        echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$soins->act_med_item.'" class="ml-2" id="'.$soins->act_med_item.'">
                                        <b> '.$k.'-</b>
                                        <label style="width: 86px; height: 20px;" for="'.$soins->act_med_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
                                        echo'soin...:<b class="text-md ml-2">'.$soin; 
                                        echo '</label>';
                                        echo '<label for="'.$soins->act_med_item.'" class="w-28 text-md my-2 ml-3 ">
                                        (<b>Tot: </b><b style="color: red;">'.$soins->act_med_u_p.'</b> Rwf)
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                        echo'<br>';
                                    }
                                ?>                                                                                
                            </td>

                            <td class="">
                                <?php 
                                    foreach($uncheck->items->hospitalisation as $hosp): endforeach;
                                        if($uncheck->checked == 1 && $hosp->insured == 1){$hosps= count($uncheck->items->hospitalisation);
                                            $k++;
                                            echo '<input type="hidden" name="checkup[]" value="'.$hosp->hosp_item.'" class=" mr-1 my-1" id="'.$hosp->hosp_item.'">
                                            <b> '.$k.'-</b>
                                            <label style="width: 86px; height: 20px;" for="'.$hosp->hosp_item.'" class="text-md mt-2 text-black medi_limit_span_check ">';
                                            echo'hospi...:<b class="text-md ml-2">'.$hosps;
                                            echo '</label>';
                                            echo '<label for="'.$hosp->hosp_item.'" class="text-md mt-2 ml-3 ">
                                            (<b>Tot: </b><b style="color: red;">'.$hosp->hosp_u_p.'</b> Rwf)
                                            </label>';
                                            echo'<br>';
                                        }
                                    
                                ?>
                            </td>
                        </tr >
                    </table>
                </div>
                    
            </div>
            <div class="flex flex-col rounded-md bg-white" style="opacity: 0.8; width: 80px;">
                <input type="checkbox" name="md" value="special" class="py-2 ml-6 mt-4" id="">
                <button type="submit" name="submit" class="text-1xl p-1 m-2 medi-btn rounded-md">
                    <?php
                        $med=0;$conso=0;$consul=0;$lab=0;$soins=0;$hosp=0; 
                        foreach($uncheck->items->medicines as $meds):if($uncheck->checked == 1 && $meds->insured == 1){$med=count($uncheck->items->medicines);}endforeach;
                        foreach($uncheck->items->consommables as $consoms):if($uncheck->checked == 1 && $consoms->insured == 1){$conso= count($uncheck->items->consommables); }endforeach;
                        foreach($uncheck->items->consultation as $consu):if($uncheck->checked == 1 && $consu->insured == 1){$consul=count($uncheck->items->consultation); }endforeach;
                        foreach($uncheck->items->laboratoire as $labo):if($uncheck->checked == 1 && $labo->insured == 1){$lab= count($uncheck->items->laboratoire); }endforeach;
                        foreach($uncheck->items->soins as $soins):if($uncheck->checked == 1 && $soins->insured == 1){$soins=count($uncheck->items->soins);}endforeach;
                        foreach($uncheck->items->hospitalisation as $hosp):if($uncheck->checked == 1 && $hosp->insured == 1){$hosp= count($uncheck->items->hospitalisation);}endforeach;
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
            echo $item;
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
<script>
    let showData = (id,items) => {
        // console.log(id,items);
        $('#con').html('');
        $.map(items,(item,i) => { 
                if(i==='consultation'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.cons_item+` (Tot:<b style="color: red;">`+it.cons_u_p+`</b> Rwf)<br>`
                        );                       
                    })
                }

                if(i==='laboratoire'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.lab_item+` (Tot:<b style="color: red;">`+it.lab_u_p+`</b> Rwf)<br>`
                        );                       
                    })
                }

                if(i==='medicines'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.med_item+` (Tot:<b style="color: red;">`+it.med_u_p+`</b> Rwf)<br>`
                        );                       
                    })
                }

                if(i==='consommables'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.conso_item+` (Tot:<b style="color: red;">`+it.conso_u_p+`</b> Rwf)<br>`
                        );                        
                    })
                }

                if(i==='soins'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.act_med_item+` (Tot:<b style="color: red;">`+it.act_med_u_p+`</b> Rwf)<br>`
                        );                        
                    })
                }

                if(i==='hospitalisation'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.hosp_item+` (Tot:<b style="color: red;">`+it.hosp_u_p+`</b> Rwf)<br>`
                        );                        
                    })
                }

                if(i==='ambulance'){
                    $.map(item,(it,ind)=>{ 
                        $('#con').append(
                            `<b>`+i+`:</b>&nbsp;`+it.ambu_item+` (Tot:<b style="color: red;">`+it.ambu_u_p+`</b> Rwf)<br>`
                        );                        
                    })
                }
            });
        //     $('#con').append(`<div class="w-100 flex flex-row" style="background-color:#D5D6EA;opacity:0.8;">                                            
        //         <tr class="">
        //             <td class="p-1">
        //                 <?php 
        //                     // $k=0;$k=0;
        //                     // foreach($uncheck->items->consultation as $consu):endforeach; 
        //                     // if($uncheck->checked == 1 && $consu->insured == 1){
        //                     //     if($uncheck->checked == 1 && $consu->insured == 1){$consul=count($uncheck->items->consultation); }
        //                     //     echo '(Tot:<b style="color: red;">'.$consu->cons_u_p.'</b> Rwf)';
        //                     // }else
        //                     // {
        //                     //     echo '(Tot:<b style="color: red;">0</b> Rwf)';
        //                     // }
        //                 ?> 
        //             </td>
        //             <td>
        //                 <?php 
        //                     $k=0;$k=0;
        //                     foreach($uncheck->items->laboratoire as $labo):  endforeach; 
        //                     if($uncheck->checked == 1 && $labo->insured == 1){$lab= count($uncheck->items->laboratoire);
        //                         $k++;
        //                         echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$labo->lab_item.'" class="ml-2" id="'.$labo->lab_item.'">
        //                         <b> '.$k.'-</b>
        //                         <label style="width: 86px; height: 20px;" for="'.$labo->lab_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
        //                         echo 'labo...:<b class="text-md ml-2">'.$lab; 
        //                         echo '</b></label>';
        //                         echo '<label for="'.$labo->lab_item.'" class="w-8 text-md my-2 ">
        //                         (<b>Tot: </b><b style="color: red;">'.$labo->lab_u_p.'</b> Rwf)
        //                         </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        //                         echo'<br>';

        //                     }
                            
        //                 ?> 
        //             </td>
        //             <td class="p-1">
        //                 <?php 
        //                     foreach($uncheck->items->medicines as $meds): endforeach;
        //                     if($uncheck->checked == 1 && $meds->insured == 1){$med=count($uncheck->items->medicines);
        //                         echo '(<b>'.$med.'</b>)(Tot:<b style="color: red;">'.$meds->med_u_p.'</b> Rwf)';
        //                     }else
        //                     {
        //                         echo '(Tot:<b style="color: red;">0</b> Rwf)';
        //                     }
        //                 ?>                                                                                
        //             </td>

        //             <td class="">
        //                 <?php 
        //                     foreach($uncheck->items->consommables as $consoms): endforeach;
        //                         if($uncheck->checked == 1 && $consoms->insured == 1){$conso= count($uncheck->items->consommables);
        //                             $k++;
        //                             echo '<input type="hidden" name="checkup[]" value="'.$consoms->conso_item.'" class=" mr-1 my-1" id="'.$consoms->conso_item.'">
        //                             <b> '.$k.'-</b>
        //                             <label style="width: 86px; height: 20px;" for="'.$consoms->conso_item.'" class="text-md mt-2 text-black medi_limit_span_check ">';
        //                             echo'Consom...:<b class="text-md ml-2">'.$conso;
        //                             echo '</label>';
        //                             echo '<label for="'.$consoms->conso_item.'" class="text-md mt-2 ml-3 ">
        //                             (<b>Tot: </b><b style="color: red;">'.$consoms->conso_u_p.'</b> Rwf)
        //                             </label>';
        //                             echo'<br>';
        //                         }
                            
        //                 ?>
        //             </td>

        //             <td>
        //                 <?php 
        //                     foreach($uncheck->items->soins as $soins):  endforeach;
        //                     if($uncheck->checked == 1 && $soins->insured == 1){$soin=count($uncheck->items->soins);
        //                         $k++;
        //                         echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$soins->act_med_item.'" class="ml-2" id="'.$soins->act_med_item.'">
        //                         <b> '.$k.'-</b>
        //                         <label style="width: 86px; height: 20px;" for="'.$soins->act_med_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check ">';
        //                         echo'Medic...:<b class="text-md ml-2">'.$soin; 
        //                         echo '</label>';
        //                         echo '<label for="'.$soins->act_med_item.'" class="w-28 text-md my-2 ml-3 ">
        //                         (<b>Tot: </b><b style="color: red;">'.$soins->act_med_u_p.'</b> Rwf)
        //                         </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        //                         echo'<br>';
        //                     }
        //                 ?>                                                                                
        //             </td>

        //             <td class="">
        //                 <?php 
        //                     foreach($uncheck->items->hospitalisation as $hosp): endforeach;
        //                         if($uncheck->checked == 1 && $hosp->insured == 1){$hosps= count($uncheck->items->hospitalisation);
        //                             $k++;
        //                             echo '<input type="hidden" name="checkup[]" value="'.$hosp->hosp_item.'" class=" mr-1 my-1" id="'.$hosp->hosp_item.'">
        //                             <b> '.$k.'-</b>
        //                             <label style="width: 86px; height: 20px;" for="'.$hosp->hosp_item.'" class="text-md mt-2 text-black medi_limit_span_check ">';
        //                             echo'Consom...:<b class="text-md ml-2">'.$hosps;
        //                             echo '</label>';
        //                             echo '<label for="'.$hosp->hosp_item.'" class="text-md mt-2 ml-3 ">
        //                             (<b>Tot: </b><b style="color: red;">'.$hosp->hosp_u_p.'</b> Rwf)
        //                             </label>';
        //                             echo'<br>';
        //                         }
                            
        //                 ?>
        //             </td>
        //             <td class="">
        //                 <?php 
        //                     foreach($uncheck->items->ambulance as $ambu): endforeach;
        //                         if($uncheck->checked == 1 && $ambu->insured == 1){$ambus= count($uncheck->items->ambulance);
        //                             echo '('.$ambu->ambu_quantity.'KM )(<b>Tot: </b><b style="color: red;">'.$ambu->ambu_u_p.'</b> Rwf)';
        //                         }
                            
        //                 ?>
        //             </td>
        //         </tr >
        //     </table>
        // </div>`);
                            }
</script>