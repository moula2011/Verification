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
                    <label for="" class="m-2">MONTHS:</label>
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
                    <?php $v_c=0; $v_v=0; foreach($consult as $check): $v_c += $check->checked; $v_v += $check->verified; endforeach; $v_check =$v_c;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp;
                        <b class="text-3xl text-center" id="unchecked"><?= $v_check; ?></b> &nbsp;Unchecked
                    </div>
                </a>
                <a href="not_verified.php">
                    <?php $v_v=0; foreach($consult as $check): $v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp;
                        <b class="text-3xl text-center" id="unverified"><?= $v_check; ?></b> &nbsp;Not Verified
                    </div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">

            <!-- ========================================igihimba gitangirira aha=========================================== -->

            <div class=" check flex flex-row mb-8" style="background-color:whitesmoke; width:auto; height: 700px;">
                <div class="h-auto w-3/5 m-4 medi-client rounded-md medi_list" style="background-color:#C9DFEC; height:675px; overflow: hidden;">
                    <div class="flex flex-row rounded-md">
                        <div class="w-100">
                            <input type="search" id="search" class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">
                        </div>
                    </div>
                    <?php foreach($consult as $uncheck): if($uncheck->checked == 1){ ?>
                        <form action="check.php" method="post">
                            <div class="flex flex-row h-auto w-90 m-4 medi-client rounded-md border-red-200">
                                <div class="w-16 bg-white rounded-md mr-2">
                                    <input value="<?= $uncheck->client_id ?>"  type="checkbox" class="mx-4 mt-8 " name="checku[]" id="checkall">
                                </div>
                                <div class="flex flex-col" style="width: 806px; background-color:#E3E4FA;opacity:0.8;">
                                    <div class="w-100  flex flex-row">
                                        <span class="w-6 text-1xl ml-6 mt-2"> <b></b></span>
                                        <span class="w-128 text-2xl ml-1 mt-2"> <b><?= $uncheck->bene; ?></b></span><br>
                                        <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;"><?php $jid= $uncheck->client_id; echo $jid ?></b></span>
                                    </div>
                                    <div class="w-100 flex flex-row" style="background-color:#D5D6EA;opacity:0.8;">
                                        <div>
                                            <?php
                                                $k=0;$y=0;
                                                if($uncheck->checked != 0){
                                                    foreach($uncheck->items->medicines as $meds):
                                                        if($meds->checked == 1){ $k++;
                                                        echo '&nbsp;<input type="hidden" name="checkup[]" value="'.$meds->med_item.'" class="ml-2" id="'.$meds->med_item.'">
                                                        <b> '.$k.'-</b>
                                                        <label style="width: 196px; height: 20px;" for="'.$meds->med_item.'" class="text-md ml-2 mt-3 text-black medi_limit_span_check">';
                                                        echo $meds->med_item;
                                                        echo '</label>';
                                                        echo '<label for="'.$meds->med_item.'" class="w-28 text-md my-2 ml-3">
                                                        (<b>'.$meds->med_quantity.'</b>) (<b>U-P: </b><b style="color: red;">'.$meds->med_u_p.'</b> Rwf)
                                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                        }
                                                    // break;
                                                    endforeach;
                                                }else{echo 0;}
                                            ?>

                                            <?php
                                                if($uncheck->checked != 0){
                                                    foreach($uncheck->items->consommables as $consoms):
                                                        if($consoms->checked == 1){ $y++;
                                                        echo '<input type="hidden" name="checkup[]" value="'.$consoms->conso_item.'" class="ml-2 mr-1 my-1" id="'.$consoms->conso_item.'">
                                                        <b> '.$y.'-</b>
                                                        <label for="'.$consoms->conso_item.'" class="text-md ml-2 mt-2 text-black medi_limit_span_check">';
                                                        echo $consoms->conso_item;
                                                        echo '</label>';
                                                        echo '<label for="'.$consoms->conso_item.'" class="text-md mt-2 ml-3">
                                                        (<b>'.$consoms->conso_quantity.'</b>) (<b>U-P: </b><b style="color: red;">'.$consoms->conso_u_p.'</b> Rwf)
                                                    </label>';}
                                                    // break;
                                                    endforeach;
                                                }else{echo 0;}
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="flex flex-col rounded-md bg-white" style="opacity: 0.8; width: 80px;">
                                    <input type="checkbox" name="md" value="special" class="py-2 ml-6 mt-4" id="">
                                    <button type="submit" name="submit" class="text-1xl p-1 m-2 medi-btn rounded-md">
                                        <?php $ch=0; foreach($uncheck->items->medicines as $meds): $ch += $meds->checked; endforeach; echo $ch;?>
                                        <i class="text-sm"> -- </i>
                                        <?php $vr=0; foreach($uncheck->items->consommables as $consoms): $vr += $consoms->checked; endforeach; echo $vr;?>
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
    <script src="../../jquery-3.3.1.min.js"></script>
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