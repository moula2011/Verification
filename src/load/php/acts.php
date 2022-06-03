<?php

include 'link.php';

$query = "SELECT DISTINCT act FROM acts WHERE insured = 1 AND verified = 0";

$res = $link->query($query);

echo $res->num_rows;

$link->close();

?>