<?php

include 'link.php';

$query = "SELECT DISTINCT description FROM products WHERE insured = 1 AND qtty > 0";

$res = $link->query($query);

echo $res->num_rows;

$link->close();

?>