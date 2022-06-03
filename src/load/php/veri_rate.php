<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT orders.item FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='$period'";
$res = $link->query($query);
$tot= $res->num_rows;

$query1 = "SELECT orders.item FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 1 AND orders.period='$period'";
$res1 = $link->query($query1);
$veri= $res1->num_rows;

if($tot>0 ){
$percentage = round(($veri*100)/$tot,1);
echo $percentage;}
else echo 0;

$link->close();

?>