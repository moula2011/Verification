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
                    <select class="form-select px-12 py-2 border-black rounded-t-lg" v-model="selperiodes">
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
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; <b class="text-3xl text-center" id="unchecked">0</b> &nbsp;Unchecked</div>
                </a>                
                <a href="not_verified.php">
                    <div class="medi-magic medi-magic-btn my-2 mx-2 p-1 bg-gradient-to-r bg-gray-light rounded-md">&nbsp; <b class="text-3xl text-center" id="unverified">0</b> &nbsp;Not Verified</div>
                </a>
            </div>
            <hr style="border-top: 1px solid #52dcff;">

            <!-- ===================body itangirira hano =========================== -->

            <div class="tableveri h-auto w-3/4 m-4 medi-client rounded-md border-red-200" style="background-color:#C9DFEC; height:678px;">
                <?php $i=0; foreach($consult as $uncheck): $i++;?>
                    <div class="bg-white flex flex-col h-auto w-90 m-4 medi-client rounded-md border-red-200">
                        <table class="w-90 m-1">
                            <thead class="bg-white ">
                                <tr>
                                <th colspan="7" class="h-20 ">
                                    <div class="flex flex-row w-100 text-center ">
                                    <label for="" class=""> <h1 class="text-2xl text-zinc-600">
                                        <b  class="text-red-400 mb-4 mx-2"><?= $uncheck->client_id;?></b>: <?= $uncheck->bene;  ?></h1>
                                    </label>
                                    <button class="ml-6 p-2 w-20 rounded-md medi-btn" style="background-color: #A52A2A;color:whitesmoke"><b>Done</b></button>
                                    <button class="ml-6 p-2 w-20 rounded-md med-btn"  style="background-color: #66CDAA; "><b>Form</b></button>
                                    </div>
                                </th>
                                </tr>
                                <tr class=" bg-gray-200 medi-btn">
                                <th class="h-10 medi-btn w-12">N <sup><u>o</u></sup></th>
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
                                    <td class="medi-btn  text-center w-12"><?= $i;?></td>
                                    <td class="medi-btn  text-left "> 
                                        <b class="ml-4 text-zinc-600"><?= $uncheck->med_item;?></b> 
                                        <input class="ml-6" type="hidden" >
                                        <input class="ml-6" type="hidden">
                                        <input class="ml-6" type="hidden">
                                    </td>
                                    <td class="medi-btn  text-center">
                                    <input class="m-2 w-8 p-2"  type="text" placeholder="<?= $uncheck->med_qtty;?>">
                                    </td>
                                    <td class="medi-btn  text-center">
                                    <input class="m-2 w-12 p-2" type="text" placeholder="<?= $uncheck->med_u_p;?>">
                                    </td>
                                    <td class="medi-btn  text-center">
                                    <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                                    </td>
                                    <td class="medi-btn  text-center">
                                    <input class="m-2 w-12 p-2" type="text" placeholder="34.4">
                                    </td>
                                    <td class="medi-btn  text-left "> 
                                    <input class="ml-6" type="text" placeholder="<?= $uncheck->med_item;?>">
                                    </td>
                                    <td class="medi-btn  text-center">
                                    <div class="w-16  flex flex-row">
                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#800000 ; color:whitesmoke; opacity:0.8;">+</button>
                                        <button class="p-1 px-3 m-2 medi-btn rounded-md" style="background-color:#66CDAA ; color:whitesmoke;">&#10003;</button>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>