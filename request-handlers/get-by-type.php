<?php

    require_once "../db/connection.php";

    header("Content-Type: application/json; charset=UTF-8");

    $sth = $pdo->prepare($sql_type);
    $sth->execute(array('type' => $_GET['type']));
    $products = $sth->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($products);