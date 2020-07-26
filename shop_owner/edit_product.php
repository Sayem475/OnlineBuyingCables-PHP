<html>
<?php include 'includes/head.php';?>
<?php
include '../dbconfig.php';
$shop_id= $_SESSION['user_id'];
$id=$_GET['id'];
if(isset($_POST['edit_products']))
{
$id=$_POST['id'];
$name=$_POST['name'];
$category=$_POST['category'];
$price=$_POST['price'];
$length=$_POST['length'];
$description=$_POST['description'];
if(empty($_FILES["image"]["name"])){
    $image=$_POST['image'];
}
else{
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image=$_FILES["image"]["name"];
}
try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="UPDATE `products` SET `product_name`='$name', `product_price`='$price', `product_details`='$description',`category`='$category', `shop_id`='$shop_id', `product_image`='$image', `product_quantity`='$length' where `p_id`='$id'";
      //var_dump($sql);
      $stmt = $conn->prepare($sql);
      if($stmt->execute())
      {
        header('Location:add_product.php');
      }
  }
  catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
}
?>

<body>
    <section class="body">

        <!-- start: header -->
        <?php include 'includes\header.php'; ?>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php include 'includes\sidebar.php' ; ?>

            <!-- end: sidebar -->
             <section role="main" class="content-body">
                <header class="page-header">
                    <table>
                        <tbody class="text-center">
                         
                            <tr>
                                <th>
                                    <h2>
                                        <?php 
                                        if(isset($_SESSION['usertype'])=='shop_owner')
                                            {echo $_SESSION['name'];}
                                        else {
                                            header('Location:../login.php');
                                            exit;
                                        }
                                        ?>
                                    </h2>
                                </th>
                            </tr>
                            
                        </tbody>
                    </table>
                </header>


<?php


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT * FROM `products` where p_id='$id'"); 
    
    $row = $stmt->fetch(); 
    ?>
    <form action="edit_product.php" method="post" enctype="multipart/form-data">
    
    <input type="text" name="id" value="<?php echo $row['p_id'];?>" style="display:none" />
    <div class="form-group col-sm-6">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" value="<?php  echo $row['product_name']; ?>" name="name">
      </div>
      <div class="form-group col-sm-6">
        <label for="category">Category</label>
        <select class="form-control" name="category">
            <option value="cat1">Cat1</option>
            <option value="cat2">Cat2</option>
            <option value="cat3">Cat3</option>
            <option value="cat4">Cat4</option>
            <option value="cat5">Cat5</option>
            <option value="cat6">Cat6</option>
        </select>
      </div>
      <div class="form-group col-sm-6">
        <label for="price">Product Price(Per meter)</label>
        <input type="text" class="form-control" id="price" value="<?php  echo $row['product_price']; ?>" name="price">
      </div>
      <div class="form-group col-sm-6">
        <label for="length">Length(m)</label>
        <input type="text" class="form-control" id="length" value="<?php  echo $row['product_quantity']; ?>" name="length">
      </div>
      <div class="form-group col-sm-6">
        <label for="description">Product description</label>
        <textarea type="text" class="form-control" id="description" name="description"><?php  echo $row['product_details']; ?></textarea>>
      </div>
      <div class="form-group col-sm-6">
        <div id="editimage">
        <label for="image">Product image</label>
        <img src="../img/<?php  echo $row['product_image']; ?>" height="50px;" width="50px;">
        <input type="hidden" class="form-control" id="image" value="<?php  echo $row['product_image']; ?>" name="image">
        <a onclick="file()">Change</a>
        </div>
        
      </div>
      <script type="text/javascript">
        function file() {
            var html='<label for="image">Upload product image</label><input type="file"  class="form-control" name="image" >';
            $('#editimage').empty();
            $("#editimage").append(html);
        }
      </script>
      <div class="form-group">
        <button type="submit" class="btn btn-success" name="edit_products">Update</button>
      </div>  
      </form>
<?php

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
<div class="footerarea">
        <center>
            <p>Copyright©
                <?php echo date("Y"); ?> Developed by <a href="#">Md Sayem Uddin</a></p>
        </center>

    </div>
</body>

</html>

