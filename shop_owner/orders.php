<!DOCTYPE html>

<?php include 'includes/head.php'; ?>
<?php include '../dbconfig.php'; ?>
<?php
if(isset($_POST['status'])){
  $status=$_POST['status']+1;
  $orderdetailes_id=$_POST['order_details_id'];
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="UPDATE `order_details` SET `status`='$status' where `orderdetails_id`='$orderdetailes_id'";
      //var_dump($sql);
      $stmt = $conn->prepare($sql);
      $stmt->execute();
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
                                        if(isset($_SESSION['usertype'])=='customers')
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
                
				<div class="col-sm-12" style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
					<h1 style="text-align:center">Order list</h1>
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
					       <th>Total Price</th>
					       <th>Order Date</th>
					       <th>Transection id</th>
					       <th>Status</th>
					     </tr>
					    </thead>
					    <tbody >
					    	<?php
					    	try {
							    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							    $shop_id= $_SESSION['user_id'];
							    $stmt = $conn->query("SELECT * FROM `order_details` INNER JOIN `orders` ON orders.o_id=order_details.order_id INNER JOIN `products` ON products.p_id=order_details.product_id INNER JOIN `customers` ON customers.c_id=order_details.customer_id where order_details.shop_id='$shop_id' and order_details.status<4 and orders.o_status=1"); 
							    
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
					      	<td><?php  echo $row['product_total_price']; 
					      	if($row['o_status']==1) echo '<br>(Paid)';
					      		else echo '<br>(Not Paid)';
					      	?></td>
					      	<td><?php  echo $row['date']; ?></td>
					      	<td><?php  echo $row['transection_id']; ?></td>
					      	<td><form action="orders.php" method="POST">
					      		<input type="hidden" name="order_details_id" value="<?php  echo $row['orderdetails_id']; ?>">
			                  <?php
			                    if($row['status']==1){
			                    	?>
			                      <button type="submit" class="btn btn-danger"  name="status" value="<?php echo $row['status'];?>">Not delivered
			                    </button>
			                  <?php } ?>
			                  <?php
			                    if($row['status']==2){
			                    	?>
			                      <button type="submit" class="btn btn-info"  name="status" value="<?php echo $row['status'];?>">On going
			                    </button>
			                  <?php } ?>
			                  <?php
			                    if($row['status']==3){
			                    	?>
			                      <button type="submit" class="btn btn-success"  name="status" value="<?php echo $row['status'];?>">Delivered
			                    </button>
			                  <?php } ?>
			                </form><?php  echo '('.$row['tracking_date'].')'; ?>
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

    <script type="text/javascript">
    	function change_status(id,status){
    		
		    
    	}
    </script>

</body>


</html>