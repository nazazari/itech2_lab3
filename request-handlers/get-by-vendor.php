<?php

    require_once "../db/connection.php";

    header("Content-type: text/xml; charset=utf-8");

    $sth = $pdo->prepare($sql_vendor);
    $sth->execute(array('vendor' => $_GET['vendor']));

    $result = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $result .= "<products>";

    foreach ($sth->fetchAll(PDO::FETCH_OBJ) as $product){
        $result .= <<< PRODUCT
            
                <product>
                    <name>$product->name</name>
                    <category>$product->category</category>
                    <vendor>$product->vendor</vendor>
                    <price>$product->price</price>
                    <quantity>$product->quantity</quantity>
                    <quality>$product->quality</quality>
                </product>
            PRODUCT;
    }
    $result .= "\n</products>";
    echo $result;