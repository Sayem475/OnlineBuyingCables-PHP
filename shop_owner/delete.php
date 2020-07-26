<?php
ob_start();
include '../dbconfig.php';

$id=$_GET['id'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "DELETE FROM products WHERE p_id='$id'";

    // use exec() because no results are returned
    $conn->exec($sql);
    
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

header("Location:add_product.php");

?>