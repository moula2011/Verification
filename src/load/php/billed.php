<?php

include 'link.php';

// $query = "SELECT SUM(quantity*unityp) AS tot FROM orders WHERE musa=1 AND period ='May-2022'";

$query = "SELECT  SUM(orders.quantity*orders.unityp) AS tot
FROM orders, clients 
WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";

$res = $link->query($query);

while($row=$res->fetch_assoc()){
    if($row['tot']>0)
    echo round($row['tot'],1);
    else
    echo 0;
}

$link->close();

?>