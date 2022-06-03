<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/medi-style.css">
    <link rel="icon" href="../../img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>.::CBHI::.</title>
</head>
<body style="background-image: url('../../img/31.jpg');" id="bg">
    <?php
        $consult =json_decode(file_get_contents('../../data/rugarama.json'));
        $data ='../../data/rugarama.json';
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
            <?php 
                // echo'<pre>';
                // print_r($consult) ;
                // echo '</pre>'
            ?>
            <?php $v_c=0; $v_v=0; foreach($consult as $check): $v_c += $check->checked; $v_v += $check->verified; endforeach; $v_check =$v_c - $v_v; echo $v_check;?>
            <?php $cup=0; foreach($consult as $check): $v_c = $check->checked;$v_v += $check->verified; 
                foreach($check->items->consultation as $consul): $cup+=$consul->cons_u_p; endforeach;
            
            endforeach; $v_chek =$v_v; echo $cup;?>
            <?php //echo $t= $uncheck->client_id; $r=$t+$uncheck->client_id ?><br>

            <div class="m-6" style="background-color:#aaa; color:black;">
                <input type="text" id="search" name="search" placeholder="Search..." class="w-100 rounded-md p-2 m-4 medi-btn" >
            </div>
            

            <div  class="m-6" style="background-color:#aaa; color:black;"> 
                <ul id="result"></ul>
            </div>

        </div>
    </section >
    <script src="load/js/load.js"></script>
</body>
</html>
    <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
                $('#result').html('');
                var searchField = $('#search').val()
                var expression = new RegExp(searchField,"i")
                $.getJSON('../../data/rugarama.json',function(data){
                    $.each(data,function(key,value){
                        if(value.bene.search(expression) !=1){
                            $('#result').append('<div>'+value.bene+'</div>')
                        }
                    })
                })
            })
        });
    </script>