<?php

include 'link.php';

// $query = "SELECT DISTINCT date FROM orders WHERE verified = 0 AND musa=1 AND period ='May-2022'";

$query = "SELECT DISTINCT orders.date 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 0 AND orders.period='May-2022';";

$res = $link->query($query);

echo $res->num_rows;

$link->close();

?>