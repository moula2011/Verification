<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT  SUM(orders.quantity*orders.unityp) AS tot FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND orders.period='$period'";
$res = $link->query($query);
while($row=$res->fetch_assoc()){
    if($row['tot']>0)
    {echo round($row['tot'],1);}
    else
    {echo 0;}
}

$link->close();

?>