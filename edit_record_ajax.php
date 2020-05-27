<?php

  require_once('dbconn.php');

  $product  = trim($_POST["product"]);
  $price    = trim($_POST["price"]);
  $category = trim($_POST["category"]);
  $prod_id  = trim($_POST["prod_id"]);
// prepare sql and bind parameters
    $stmt = $dbconn->prepare("UPDATE tbl_products set product_name = :product, price = :price , category = :category where id = :id");
    $stmt->bindParam(':product', $product);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':id', $prod_id);
    // insert a row
    if($stmt->execute()){
      $result =1;
    }
    echo $result;
    $dbconn = null;