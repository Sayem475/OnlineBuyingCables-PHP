<?php include '../dbconfig.php';?>
<table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
   <thead>
     <tr>
       <th>Order id</th>
       <th>Product name</th>
       <th>Image</th>
       <th>Category</th>
       <th>Quantity</th>
       <th>Total Price</th>
       <th>Order Tracking</th>
     </tr>
    </thead>
    <tbody >
    	<?php
    	$order_id=$_POST['id'];
    	try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //$customer_id= $_SESSION['user_id'];
		    $stmt = $conn->query("SELECT * FROM `order_details` INNER JOIN `products` ON products.p_id=order_details.product_id where `order_id`='$order_id'"); 
		    
		    // set the resulting array to associative
		    $sl=1;
		    //var_dump("SELECT * FROM `order_details` INNER JOIN `products` ON products.p_id=order_details.product_id where `customer_id`='$customer_id'");
		    while ($row = $stmt->fetch()) {
    	?>
      <tr>
      	<td><a onclick="invoice(<?php  echo $row['order_id']; ?>)"><?php  echo "#".$row['order_id']; ?></a></td>
      	<td><?php  echo $row['product_name']; ?></td>
      	<td><img src="../img/<?php  echo $row['product_image']; ?>" height="50px;" width="50px;"></td>
      	<td><?php  echo $row['category']; ?></td>
      	<td><?php  echo $row['product_quantities']; ?></td>
      	<td><?php  echo $row['product_total_price']; ?></td>
      	<td><?php if($row['status']==1) echo "Not delivered"; if($row['status']==2) echo "On going"; if($row['status']==3|| $row['status']==4) echo "Delivered"; ?></td>
      	
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