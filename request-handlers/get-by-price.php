<?php

    require_once "../db/connection.php";

    $from = 0;
    if(isset($_GET['from']) && is_numeric($_GET['from'])){
        $from = $_GET['from'] - 1;
    }

    $to = 0;
    if(isset($_GET['to']) && is_numeric($_GET['from'])){
        $to = $_GET['to'] + 1;
    }

    $sth = $pdo->prepare($sql_price);
    $sth->execute(array('from' => $from, 'to' => $to));
    $products = $sth->fetchAll(PDO::FETCH_OBJ);

    if (count($products) == 0) {
        echo "<p> Products not found </p>";
        return;
    }

    echo '<div class="list-group">';
    foreach ($products as $product) {
        $style = $product->quantity == 0 ? "list-group-item list-group-item-danger" : "list-group-item list-group-item-primary ";
        echo <<< PRODUCT
            <div class="$style pt-1 m-1">
                <h6>$product->name</h6>
                <table class="table table-bordered border-dark">
                  <thead>
                    <tr><th scope="col">#</th><th scope="col"> Info </th></tr>
                  </thead>
                  <tbody>
                    <tr><th scope="row"> Category   </th><td>$product->category   </td></tr>
                    <tr><th scope="row"> Vendor     </th><td>$product->vendor     </td></tr>
                    <tr><th scope="row"> Price      </th><td>$product->price      </td></tr></tr>
                    <tr><th scope="row"> Quantity   </th><td>$product->quantity   </td></tr>
                    <tr><th scope="row"> Quality    </th><td>$product->quality     </td></tr>
                  </tbody>
                </table>
            </div>
        PRODUCT;

    }
    echo '</div>';
