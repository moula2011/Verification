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
        width: 120px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        }
        .medi_list::-webkit-scrollbar {  
        width: 0 !important;
        display: none; 
        }
    </style>
</head>
<body style="background-image: url('../../img/31.jpg');" id="bg">
    <?php 
        $consult =json_decode(file_get_contents('../../data/rugarama.json'));

        require('consult.class.php');

        $cashFile ='../../data'.DIRECTORY_SEPARATOR.'verifications.json';
        $data = array(); 
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
                    <select class="form-select px-12 py-2 border-black rounded-t-lg" >
                        <option value="">May-2022</option>
                        <option value="">June-2022</option>
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
                    <?php $v_v=0; foreach($consult as $check): $v_v += $check->verified; endforeach; $v_check =$v_v;?>
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; 
                        <b class="text-3xl text-center" id="unverified"><?= $v_check;  ?></b> &nbsp;Not Verified
                    </div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">
            <!-- ========================================igihimba gitangirira aha=========================================== -->
            <div class="check flex flex-row mb-8" style="height: 700px;">
                <div class="h-auto w-2/3 m-4 medi-client rounded-md border-red-200 medi_list" style="background-color:#C9DFEC; height:675px; overflow: hidden;">
                    <div class="flex flex-row rounded-md">
                        <div class="w-100">
                            <input type="search" id="search" class="w-100 rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="Searching..." autocomplete="off">
                        </div>
                    </div>
                    <?php foreach($consult as $uncheck): if($uncheck->verified == 0){ ?>
                        <form action="check.php" method="post">
                    <div class="flex flex-row h-20 w-90 m-4 medi-client rounded-md border-red-200">
                        <div class="w-16 bg-white rounded-md mr-2">
                            <input value=""  type="checkbox" class="mx-4 mt-8 ">
                        </div>
                        <div class="flex flex-col" style="width: 806px; background-color:#E3E4FA;opacity:0.8;">
                            <div class="w-100  flex flex-row">
                                <span class="w-6 text-1xl ml-6 mt-2"> <b></b></span>
                                <span class="w-128 text-2xl ml-1 mt-2"> <b><?= $uncheck->bene;  ?></b></span><br>
                                <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> <b style="color: blue;"><?php $jid= $uncheck->client_id; echo $jid ?></b></span>
                            </div>
                            <div class="w-100 flex flex-row" style="background-color:#D5D6EA;opacity:0.8;">
                                <div>
                                                
                                        <?php if($uncheck->checked != 0){ ; foreach($uncheck->items->medicines as $meds):
                                            // if($meds->checked == 0){ 
                                                ?>
                                            <input type="checkbox" name="item[]" value="" class="py-2 ml-2 mr-1 my-1" id="med_item">
                                            <label for="med_item" class="w-70 text-md mt-2 medi_limit_span_check" >
                                            <?= $meds->med_item;  ?>
                                            </label>
                                            <label for="chkp" class="w-28 text-sm mt-2 ml-3 ">
                                                (<b><?=($meds->med_quantity);?></b>) (<b style="color: red;">U-P:<?= $meds->med_u_p;  ?></b> Frw)
                                            </label>
                                        
                                            <?php  endforeach;  }else{echo 0;}?>
                                        <?php if($uncheck->checked != 0){ foreach($uncheck->items->consommables as $cons):?>
                                        <input type="checkbox" name="item[]" value="" class="py-2 ml-2 mr-1 my-1" id="chkp">
                                        <label for="chkp" class="text-md mt-2 text-black medi_limit_span_check ">
                                            <?= $cons->conso_item;  ?> 
                                        </label>
                                        <label for="chkp" class="text-sm mt-2 ml-3 ">
                                            (<b><?= $cons->conso_quantity;  ?></b>) (<b style="color: red;">U-P:<?= $cons->conso_u_p;  ?></b> Frw)
                                        </label>
                                        <?php endforeach;}else{echo 0;}?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="flex flex-col rounded-md bg-white" style="opacity: 0.8; width: 80px;">
                                <input type="checkbox" name="" value="special" class="py-2 ml-6 my-4" id="">
                                <!-- <div class="flex flex-row"> -->
                                <button type="submit" name="submit" class="text-sm p-1 mx-2 medi-btn rounded-md"> <?= count($uncheck->items->medicines);  ?><i class="text-sm"> -- </i> <?= count($uncheck->items->consommables);?>
                                </button>
                                <!-- </div> -->
                            </div>
                        </div>
                    </form>
                    <?php 
                    
                        } 
                        endforeach ; 
                        if(isset($_POST['submit'])){                        
                            $code = $uncheck->client_id;
                            $items = $_POST['item'];

                            foreach($items as $key=>$item){
                                $rug = new Consult('../../data/rugarama.json');
                                // echo $item;
                                $rug->updatechecked($code,"checked",2,"items",$item);
                            }
                        }

                    ?>

                </div>
                <div class="h-auto w-1/2 m-4 medi-client rounded-md border-red-200" style="background-color:#C9DFEC; height:675px; overflow: hidden;">
                    <div class="bg-white flex flex-row h-20 w-90 m-4 medi-client rounded-md border-red-200">
                        <div class="w-100">
                            <span class="w-128 text-2xl m-3 text-zinc-500"> <b>Suspicious Items Mostly used </b></span>
                            <input type="text" name="" class="rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="search by name" id="">
                            <!-- <input type="text" name="" class="rounded-md p-2 m-4 bg-indigo-50 medi-btn" placeholder="search by name" id=""> -->
                        </div>
                    </div>
                    <div class="bg-white flex flex-row h-20 w-90 m-4 medi-client rounded-md border-red-200">
                        <div class="w-20">
                            <input type="checkbox" name="" class="rounded-xl m-8 " id="">
                        </div>
                        <div class="w-8/12 bg-indigo-50 flex flex-row">
                            <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> Monthly (<b>5/12jrs</b>)</span>
                            <span class="w-128 text-2xl ml-1 mt-2 text-zinc-600"> <b>HYDROCORTISONE COLLY</b></span><br>
                            <label class="w-16 text-2xl ml-6 mt-2"> 5</label>
                        </div>
                        <div class="w-50 bg-indigo-50 flex flex-col">
                            <span class="w-100 text-1xl pr-2 ml-6 mt-2 text-blue-800"> Curr-P: (<b class="text-red-600">2450</b>
                                Frw)</span>
                            <span class="w-100 text-1xl ml-6 mt-2 text-blue-800"> Prev-P: (<b class="text-red-600">2450</b> Frw)</span>

                        </div>
                    </div>
                    <div class="bg-white flex flex-row h-20 w-90 m-4 medi-client rounded-md border-red-200">
                        <div class="w-20">
                            <input type="checkbox" name="" class="rounded-xl m-8 " id="">
                        </div>
                        <div class="w-8/12 bg-indigo-50 flex flex-row">
                            <span class="w-16 text-1xl ml-6 mt-2 text-blue-800"> Monthly (<b>23/ jrs</b>)</span>
                            <span class="w-128 text-2xl ml-1 mt-2 text-zinc-600"> <b>Vitamine B complexe cp</b></span><br>
                            <label class="w-16 text-2xl ml-6 mt-2"> 15</label>
                        </div>
                        <div class="w-50 bg-indigo-50 flex flex-col">
                            <span class="w-100 text-1xl pr-2 ml-6 mt-2 text-blue-800"> Curr-P: (<b class="text-red-600">2450</b>
                                Frw)</span>
                            <span class="w-100 text-1xl ml-6 mt-2 text-blue-800"> Prev-P: (<b class="text-red-600">2450</b> Frw)</span>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section >
    <script src="load/js/load.js"></script>
</body>
</html>