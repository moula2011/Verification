<?php

include 'link.php';

$query = "SELECT SUM(amountde) as deduct FROM verification";

$res = $link->query($query);

while($row=$res->fetch_assoc()){

    echo round($row['deduct'],1);
}

$link->close();

?>