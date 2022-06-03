<?php 

"SELECT orders.client_id 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";
//=================
"UPDATE `orders` AS o JOIN clients AS c ON o.client_id= c.client_id SET o.`musa`= c.musa ;";

//=================
"UPDATE `verification` AS v JOIN orders AS o ON v.orders_id= o.order_id SET v.comfirm= 1 WHERE o.`musa`= 1;";

//=========================
"UPDATE `orders` SET `musa`=1 WHERE `verified`=1 AND period ='May-2022';";

//========================================
"SELECT DISTINCT client_id FROM orders WHERE musa = 1 AND period ='May-2022'";

//=====================
"UPDATE orders SET done =1 AND musa = 1 WHERE client_id = 10;";

//=================
"SELECT orders.* 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";
//========================




   
"WITH itariki(tarehe) as (SELECT DISTINCT evaluations_old.date 
FROM evaluations_old  ORDER BY evaluations_old.date ASC ) 
SELECT DISTINCT ev.client_id,cl.beneficiary,cl.chef,cl.age,cl.sex,it.tarehe 
FROM clients as cl,evaluations_old as ev, itariki as it
WHERE ev.client_id=cl.client_id AND ev.date=it.tarehe AND cache=0 
ORDER BY ev.id ASC LIMIT 10 ";

//=======================
"SELECT DISTINCT orders.date, row_number() over(PARTITION BY date) as rn 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 1 AND orders.period='May-2022';
";

"

";

// ==================================================

$qly=mysqli_query($link,"SELECT DISTINCT client_id FROM orders WHERE period = '$period' ");
if(!$qly){ die('Error :'.mysqli_error($link)); }
while($roww=mysqli_fetch_assoc($qly)){
    $id = $roww['client_id'];

    if(file_exists($cashFile)){
        // if($insurance=="MUSA"){
            
            $data=["period"=>$period,"client_id"=> $id,"checked"=>0,"verified"=>0];

            $consult = new Consult('data/urugero.json');

            $consult->insertNewClient($data);
        // }
    }else{
        $data[]=["id"=>1,"period"=>$period,"client_id"=> $id,"checked"=>0,"verified"=>0];
        $json = json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        $fh = fopen($cashFile, 'w');
        fwrite($fh,$json);
        fclose($fh);
        echo $json;
    }
}


//====================================================================================================================

$name = $uncheck->bene; $code = $uncheck->client_id; $day = $uncheck->day; $age = $uncheck->age; 
$cat = $uncheck->cat; $sex = $uncheck->sex; $insurance = $uncheck->insurance; $age = $uncheck->age;
$conso_qtty = $uncheck->conso_quantity; $med_qtty = $uncheck->med_qtty; $med_u_p = $uncheck->med_u_p; 
$conso_u_p = $uncheck->conso_u_p;

if(file_exists($cashFile)){
        
    $data=["client_id"=> $code,"day"=>$day,"bene"=>$name,"age"=>$age,"cat"=>$cat,
    "sex"=>$sex,"insurance"=>$insurance,"conso_quantity"=>$conso_qtty,"med_qtty"=>$med_qtty,
    "med_u_p"=>$med_u_p,"conso_u_p"=>$conso_u_p,
    "checked"=>0,"verified"=>0
    ];

    $consult = new Consult('../../data/verifications.json');

    $consult->insertNewClient($data);
}else{
    $data[]=["id"=>1,"client_id"=> $code,"day"=>$day,"bene"=>$name,"age"=>$age,"cat"=>$cat,
    "sex"=>$sex,"insurance"=>$insurance,"conso_quantity"=>$conso_qtty,"med_qtty"=>$med_qtty,
    "med_u_p"=>$med_u_p,"conso_u_p"=>$conso_u_p,
    "checked"=>0,"verified"=>0
    ];
    $json = json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    $fh = fopen($cashFile, 'w');
    fwrite($fh,$json);
    fclose($fh);
    echo $json;
}                    


//====================================================================================================

foreach($verify as $check):
    $v_check = $check->checked;
    $v_code = $check->client_id;
endforeach ; 


// if($uncheck->checked == 1){
    $name = $uncheck->bene; $code = $uncheck->client_id; $day = $uncheck->day; 
    $med_item=$uncheck->med_item;$conso_item=$uncheck->conso_item; 
    $data=["client_id"=> $code,"med_item"=>$med_item,"conso_item"=>$conso_item];
    if($v_check == 0 && $check->client_id == $code)
    {   
        $consult = new Consult('../../data/verifications.json');

        $consult->updateClient($code,"med_item",$med_item,"conso_item",$conso_item,"checked",1,"verified",1);
    }else{}

//======================================================================================================

function display($json_rec){
    if($json_rec){
        foreach($json_rec as $value){
            if(is_array($value)){
                display($value);
            }else{
                echo $value;
            }
        }
    }
}

