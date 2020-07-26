<?php
include '../dbconfig.php';
session_start();
$session_id=session_id();
$product_id=$_POST['id'];
$quantity=$_POST['quantity'];

try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="INSERT INTO  `cart`(`product_id`, `quantity`, `session_id`) values('$product_id','$quantity','$session_id')";
          
      $conn->exec($sql);
    }
catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

?>
