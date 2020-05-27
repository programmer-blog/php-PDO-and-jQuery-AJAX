<?php
  require_once('dbconn.php');

   $id  = trim($_GET["id"]);

  // prepare sql and bind parameters
    $stmt = $dbconn->prepare("select * from tbl_products where id = :id");
    $stmt->bindParam(':id', $id);
    // insert a row
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
    $dbconn = null;
