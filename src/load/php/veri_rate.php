<?php

include 'link.php';

// $query = "SELECT DISTINCT client_id FROM orders WHERE musa=1 AND period ='May-2022'";

$query = "SELECT DISTINCT orders.client_id 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";

$res = $link->query($query);

$tot= $res->num_rows;

// $query1 = "SELECT DISTINCT client_id FROM orders WHERE verified = 1 AND musa=1 AND period ='May-2022'";

$query1 = "SELECT DISTINCT orders.client_id 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 1 AND orders.period='May-2022'";

$res1 = $link->query($query1);

$veri= $res1->num_rows;

if($tot>0 ){
$percentage = round(($veri*100)/$tot,1);
echo $percentage;}
else echo 0;

$link->close();

?>