<?php
$username  = 'root';
$password  = 'root';
try {
  $dbconn = new PDO('mysql:host=localhost;dbname=test', $username, $password);
   $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // some queries
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$result = 0;
echo $id = intval($_POST['pid']);

if(intval($id)){
  $stmt = $dbconn->prepare("DELETE FROM tbl_products WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  if($stmt->execute()){
    $result = 1;
  }
}
 echo $result;
 $dbconn = null;