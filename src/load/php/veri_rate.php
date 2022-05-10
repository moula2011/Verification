<?php

include 'link.php';

$query = "SELECT DISTINCT client_id FROM orders WHERE musa=1";

$res = $link->query($query);

$tot= $res->num_rows;

$query1 = "SELECT DISTINCT client_id FROM orders WHERE verified = 1 AND musa=1";

$res1 = $link->query($query1);

$veri= $res1->num_rows;

$percentage = round(($veri*100)/$tot,1);
echo $percentage;

$link->close();

?>