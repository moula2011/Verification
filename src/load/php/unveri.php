<?php
error_reporting(1|0);

include 'link.php';

// $query = "SELECT SUM(quantity*unityp) AS tot FROM orders WHERE verified = 0 AND musa=1 AND period ='May-2022'";

$query = "SELECT SUM(orders.quantity*orders.unityp) AS tot 
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 0 AND orders.period='May-2022'";

$res = $link->query($query);

while($row=$res->fetch_assoc()){

    $verified= $row['tot'];
}

 echo round($verified,1);
$link->close();

?>