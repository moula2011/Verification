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



