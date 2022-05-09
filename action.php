<?php
    $connect = new PDO("mysql:host=localhost;dbname=rugarama","root","raymond1");

    $received_data = json_decode(file_get_contents("php://input"));

    if($received_data->postRequest == 'periode')
    {
        $query = "SELECT DISTINCT period FROM orders ORDER BY date DESC";
    }

    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

        $data = $row;
    }
    echo json_encode($data);
?>