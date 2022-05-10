<?php

include 'link.php';

$query = "SELECT DISTINCT client_id FROM orders WHERE checked = 0 AND musa=1 ";

$res = $link->query($query);

echo $res->num_rows;

$link->close();

?>