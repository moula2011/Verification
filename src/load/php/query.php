<?php 

"SELECT orders.client_id 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";
//=================
"UPDATE `orders` AS o JOIN clients AS c ON o.client_id= c.client_id SET o.`musa`= c.musa ;";

//=================
"UPDATE `verification` AS v JOIN orders AS o ON v.orders_id= o.order_id SET v.comfirm= 1 WHERE o.`musa`= 1;";

//=========================
"UPDATE `orders` SET `musa`=1 WHERE `verified`=1;";

//========================================
"SELECT DISTINCT client_id FROM orders WHERE musa = 1 AND period ='May-2022'";

//=====================
"UPDATE orders SET done =1 AND musa = 1 WHERE client_id = 10;";