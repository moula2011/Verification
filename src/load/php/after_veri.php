<?php

include 'link.php';

$query = "SELECT SUM(amountde) as deduct FROM verification";

$res = $link->query($query);

while($row=$res->fetch_assoc()){

    $deduct = $row['deduct'];
}

$query = "SELECT SUM(quantity*unityp) AS tot FROM orders WHERE verified = 1 AND musa=1";

$res = $link->query($query);

while($row=$res->fetch_assoc()){

    $verified= $row['tot'];
}

 echo $tot = round($verified- $deduct,1);
$link->close();

?>