<?php 

"SELECT orders.client_id 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";

//=======================

"UPDATE `orders` SET `musa`= 1 WHERE client_id = (
SELECT  client_id 
FROM  clients 
WHERE insurance='MUSA' AND period='May-2022');";


//=================
"UPDATE `orders` AS o
JOIN clients AS c
ON o.client_id= c.client_id
SET o.`musa`= c.musa ;";

//=========================
"UPDATE `orders` SET `musa`=1 WHERE `verified`=1;";

//========================================
"SELECT DISTINCT client_id FROM orders WHERE musa = 1 AND period ='May-2022'";