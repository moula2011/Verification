<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT SUM(amountde) as deduct FROM verification WHERE  period ='$period'";
$res = $link->query($query);
while($row=$res->fetch_assoc()){
    $deduct = $row['deduct'];
}

$query = "SELECT SUM(orders.quantity*orders.unityp) AS tot FROM orders, clients WHERE orders.client_id=clients.client_id AND clients.insurance='MUSA' AND verified = 1 AND orders.period='$period'";
$res = $link->query($query);
while($row=$res->fetch_assoc()){
    $verified= $row['tot'];
}

if($verified > 0)
{
    $percentage = round(($deduct*100)/$verified,2);
    echo $percentage;
}else
{echo 0;}

$link->close();

?>