<?php
ob_start();
include '../dbconfig.php';

$id=$_GET['id'];
$type=$_GET['type'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($type=='shop_owner'){
        $sql = "DELETE FROM shop_owner WHERE id='$id'";
        $destination= 'shop.php';
    }
    if($type=='customers'){
        $sql = "DELETE FROM customers WHERE c_id='$id'";
        $destination= 'customers.php';
    }
    if($type=='staff'){
        $sql = "DELETE FROM staff WHERE id='$id'";
        $destination= 'staff.php';
    }
    if($type=='contact'){
        $sql = "DELETE FROM contact WHERE id='$id'";
        $destination= 'contact.php';
    }
    if($type=='warning'){
        $sql = "DELETE FROM warning WHERE id='$id'";
        $destination= 'warning_message.php';
    }
    if($type=='payment'){
        
        $sql ="UPDATE `orders` SET `invalid`='1' where `o_id`='$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $destination= 'payment.php';
    }
    // sql to delete a record
    

    // use exec() because no results are returned
    $conn->exec($sql);
    
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

header("Location:".$destination);

?>