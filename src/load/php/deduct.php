<?php

include 'link.php';

$period=$_REQUEST['period'];
$query = "SELECT SUM(amountde) as deduct FROM verification WHERE period ='$period'";
$res = $link->query($query);
while($row=$res->fetch_assoc()){
    echo round($row['deduct'],1);
}

$link->close();

?>