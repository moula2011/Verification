<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT DISTINCT orders.client_id FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND checked = 0 AND orders.period='$period'";
$res = $link->query($query);
echo $res->num_rows;
 
$link->close();

?>