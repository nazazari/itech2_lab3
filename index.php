<?php

    require_once "db/connection.php";

    $vendors = $pdo->query("select `name` from `VENDORS`")->fetchAll(PDO::FETCH_COLUMN);
    $types = $pdo->query("select `name` from `CATEGORY`")->fetchAll(PDO::FETCH_COLUMN);

    require "header.html"
?>
<script src="index.js"></script>
<div class="container">
    <div class="row">
        <div class="col">

            <div class="row">
                <div class="shadow-sm p-3 mb-5 bg-body rounded col">
                    <label >
                        Vendor:
                        <select class="form-select" id="vendor-select">
                            <?php
                            foreach ($vendors as $vendor){
                                echo "<option value='$vendor'> $vendor</option>";
                            }
                            ?>
                        </select>
                    </label>
                    <div class="p-2 mt-1"><button type="button" onclick="getProductsByVendor()" class="btn btn-success"> Get products </button></div>
                </div>

                <div class="shadow-sm p-3 mb-5 bg-body rounded col">
                    <label>
                        Type:
                        <select class="form-select" id="type-select">
                            <?php
                            foreach ($types as $type){
                                echo "<option value='$type'>$type</option>";
                            }
                            ?>
                        </select>
                    </label>
                    <div class="p-2 mt-1"><button type="button" onclick="getProductsByType()" class="btn btn-success"> Get products </button></div>
                </div>



                <div class="shadow-sm p-3 mb-5 bg-body rounded col">
                    <div class=" form-group row">
                        <div class="form-group col">
                            <label for="from" class="col-sm-2 col-form-label"> From </label>
                            <div class="col-sm-10">
                                <input type="number" name="from" class="form-control" id="from">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="to" class="col-sm-2 col-form-label"> To </label>
                            <div class="col-sm-10">
                                <input type="number" name="to" class="form-control" id="to">
                            </div>
                        </div>
                    </div>
                    <div class="p-2 mt-1">
                        <button type="button" class="btn btn-success" onclick="getProductsByPrice()"> Get products</button>
                    </div>
                </div>
            </div>

            <div id="content"></div>

        </div>
    </div>
</div>

<?php require "footer.html"?>
