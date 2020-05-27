<?php

  require_once('dbconn.php');

  $product  = trim($_POST["product"]);
  $price    = trim($_POST["price"]);
  $category = trim($_POST["category"]);

// prepare sql and bind parameters
    $stmt = $dbconn->prepare("INSERT INTO tbl_products(product_name, price, category)
    VALUES (:product, :price, :category)");
    $stmt->bindParam(':product', $product);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    // insert a row
    if($stmt->execute()){
      $result =1;
    }

    echo $result;
    $dbconn = null;
