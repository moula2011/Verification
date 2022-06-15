<?php

include 'link.php';

$period=$_REQUEST['period'];
$query1 = "SELECT  DISTINCT orders.date FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 0 AND orders.period='june-2022'";
$res1 = $link->query($query1);
$appeal= $res1->num_rows; 

$query = "SELECT DISTINCT orders.date FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='june-2022'";
$res = $link->query($query);
$veri= $res->num_rows;
$days=$veri-$appeal;

echo $days;    

$link->close();

?>