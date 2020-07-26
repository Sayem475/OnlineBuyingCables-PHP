
<html>
<?php include 'includes/head.php';?>
<?php
include '../dbconfig.php';
$shop_id= $_SESSION['user_id'];
if(isset($_POST['add_products'])){

$name=$_POST['name'];
$category=$_POST['category'];
$price=$_POST['price'];
$length=$_POST['length'];
$description=$_POST['description'];
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
$image=$_FILES["image"]["name"];

try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="INSERT INTO  `products`(`product_name`, `product_price`, `product_details`,`category`, `shop_id`, `product_image`, `product_quantity`) values('$name','$price','$description','$category','$shop_id','$image','$length')";
          
      if($conn->exec($sql))
      {
      	echo '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Congrates!</strong> Added Successfully.
          </div>';
      }
  }
  catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
}

if(isset($_POST['edit_products']))
{

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

      $sql ="INSERT INTO  `products`(`product_name`, `product_price`, `product_details`,`category`, `shop_id`, `product_image`, `product_quantity`) values('$name','$price','$description','$category','$shop_id','$image','$length')";
          
      if($conn->exec($sql))
      {
      	echo '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Congrates!</strong> Added Successfully.
          </div>';
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
                
            	<form action="add_product.php" method="POST"  enctype="multipart/form-data">
				  <div class="form-group col-sm-6">
				    <label for="name">Product Name</label>
				    <input type="text" class="form-control" id="name" placeholder="Product Name" name="name">
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
				    <input type="text" class="form-control" id="price" placeholder="Product price" name="price">
				  </div>
				  <div class="form-group col-sm-6">
				    <label for="length">Length(m)</label>
				    <input type="text" class="form-control" id="length" placeholder="Length(m)" name="length">
				  </div>
				  <div class="form-group col-sm-6">
				    <label for="description">Product description</label>
				    <input type="text" class="form-control" id="description" placeholder="Product description" name="description">
				  </div>
				  <div class="form-group col-sm-6">
				    <label for="image">Upload product image</label>
				    <input type="file"  class="form-control" name="image" >
				  </div>
				  <div class="form-group">
				  	<button type="submit" class="btn btn-success" name="add_products">ADD</button>
				  </div>
				</form>
				<div class="col-sm-12" style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
					<h1 style="text-align:center">Products List</h1>
					<table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
					   <thead>
					     <tr>
			   	           <th>SL</th>
				           <th>Product name</th>
					       <th>Image</th>
					       <th>Category</th>
					       <th>Unit Price</th>
					       <th>Available length</th>
					       <th>Description</th>
					       <th colspan="2">Action</th>
					     </tr>
					    </thead>
					    <tbody >
					    	<?php
					    	try {
							    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							    $stmt = $conn->query("SELECT * FROM `products` where `shop_id`='$shop_id'"); 
							    
							    // set the resulting array to associative
							    $sl=1;
							    while ($row = $stmt->fetch()) {
					    	?>
					      <tr>
					      	<td><?php  echo $sl++; ?></td>
					      	<td><?php  echo $row['product_name']; ?></td>
					      	<td><img src="../img/<?php  echo $row['product_image']; ?>" height="50px;" width="50px;"></td>
					      	<td><?php  echo $row['category']; ?></td>
					      	<td><?php  echo $row['product_price']; ?></td>
					      	<td><?php  echo $row['product_quantity']; ?></td>
					      	<td><?php  echo $row['product_details']; ?></td>
					      	<td style="padding:0;width:60px">
					          <a   href="edit_product.php?id=<?php echo  $row['p_id']; ?>" >  
					      		<button  class="btn btn-info" type="reset" >
					      		<i class="fa fa-pencil-square-o"></i>Edit</button> </a>  </td>


					        <td style="padding:0;width:60px">
					          <a href="delete.php?id=<?php echo  $row['p_id']; ?>">
					        	<button type="reset" class=" btn btn-danger" >
					            <i class="fa fa-trash-o"></i>  Delete</button></a>
					        </td>
					      </tr>
					      <?php
					  		}
					  		 }
						  catch(PDOException $e) {
						            echo "Error: " . $e->getMessage();
						        }
						        $conn = null;
					      ?>
					    </tbody>
					</table>
				</div>
					          
            </section>
           
        </div>


    </section>


	

    <div class="footerarea">
        <center>
            <p>Copyright©
                <?php echo date("Y"); ?> Developed by <a href="#">Md Sayem Uddin</a></p>
        </center>

    </div>
</body>
</html>

<!-- <script type="text/javascript">
  
  // function products(id) {
  
  // $.post("edit_product.php", { id : id },

  // function(data){
  //     $('#editproduct').empty();
  //     $("#editproduct").append(data);
  //   });
  
  
  // }

</script>
 -->