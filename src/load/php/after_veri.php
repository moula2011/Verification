<?php

include 'link.php';

$query = "SELECT SUM(quantity*unityp) AS tot FROM orders WHERE verified = 1 AND musa=1";

$res = $link->query($query);

while($row=$res->fetch_assoc()){

    echo round($row['tot'],1);
}

$link->close();

?>