<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT SUM(orders.quantity*orders.unityp) AS tot FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 1 AND orders.period='$period'";
$res = $link->query($query);
while($row=$res->fetch_assoc()){
    $verified= $row['tot'];
}

 echo round($verified,1);
$link->close();

?>