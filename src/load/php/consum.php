<?php

include 'link.php';

$query = "SELECT DISTINCT name_consommable FROM consommables WHERE insured = 1 AND qtty > 0";

$res = $link->query($query);

echo $res->num_rows;

$link->close();

?>