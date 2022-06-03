<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT SUM(amountde) as deduct FROM verification WhERE period ='$period'";

// $query = "SELECT orders.client_id 
// FROM orders, clients 
// WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='May-2022'";

$res = $link->query($query);
while($row=$res->fetch_assoc()){
    $deduct = $row['deduct'];
}

// $query = "SELECT SUM(quantity*unityp) AS tot FROM orders WHERE verified = 1 AND musa=1  AND period ='May-2022'";

$query = "SELECT SUM(orders.quantity*orders.unityp) AS tot FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 1 AND orders.period='$period'";
$res = $link->query($query);
while($row=$res->fetch_assoc()){
    $verified= $row['tot'];
}

 echo $tot = round($verified- $deduct,1);
$link->close();

?>