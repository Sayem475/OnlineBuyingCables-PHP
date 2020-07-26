<?php  ob_start(); 
session_start();
?>
<h1 style="text-align:center">Completed order list</h1>
<table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
<thead>
 <tr>
       <th>SL</th>
       <th>Customer Name</th>
       <th>Mobile no</th>
       <th>Address</th>
       <th>Product name</th>
       <th>Image</th>
       <th>Category</th>
       <th>Quantity</th>
       <th>Order Date</th>
       <th>Total Price</th>
 </tr>
</thead>
<tbody >
	<?php
	include '../dbconfig.php'; 
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $shop_id= $_SESSION['user_id'];
	    $from_date= $_POST['from_date'];
	    $to_date= $_POST['to_date'];
	    $stmt = $conn->query("SELECT * FROM `order_details` INNER JOIN `products` ON products.p_id=order_details.product_id INNER JOIN `customers` ON customers.c_id=order_details.customer_id INNER JOIN `orders` ON orders.o_id=order_details.order_id where order_details.shop_id='$shop_id' and order_details.status>2 and orders.date>='$from_date' and orders.date<='$to_date' and orders.o_status=1 "); 
	    
	    // set the resulting array to associative
	    $sl=1;
	    //var_dump("SELECT * FROM `order_details` INNER JOIN `products` ON products.p_id=order_details.product_id where `customer_id`='$customer_id'");
	    while ($row = $stmt->fetch()) {
	?>
  <tr>
  	<td><?php  echo $sl++; ?></td>
  	<td><?php  echo $row['name']; ?></td>
  	<td><?php  echo $row['phone']; ?></td>
  	<td><?php  echo $row['shipping_address']; ?></td>
  	<td><?php  echo $row['product_name']; ?></td>
  	<td><img src="../img/<?php  echo $row['product_image']; ?>" height="50px;" width="50px;"></td>
  	<td><?php  echo $row['category']; ?></td>
  	<td><?php  echo $row['product_quantities']; ?></td>
    <td><?php  echo $row['date']; ?></td>
  	<td><?php  echo $row['product_total_price']; ?></td>
    </form>
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
