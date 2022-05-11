<?php

include 'link.php';

$query = "SELECT SUM(amountde) as deduct FROM verification WHERE period ='May-2022'";

$res = $link->query($query);

while($row=$res->fetch_assoc()){

    echo round($row['deduct'],1);
}

$link->close();

?>