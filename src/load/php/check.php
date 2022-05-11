<?php

include 'link.php';

// $query = "SELECT DISTINCT client_id FROM orders WHERE checked = 0 AND musa=1 AND period ='May-2022'";

$query = "SELECT DISTINCT orders.client_id 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND checked = 0 AND orders.period='May-2022'";

$res = $link->query($query);

echo $res->num_rows;

$link->close();

?>