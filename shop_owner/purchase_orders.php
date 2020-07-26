<!DOCTYPE html>
<html>

<?php include 'includes/head.php';?>

<?php
include '../dbconfig.php';

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
					<h1 style="text-align:center">Purchase order list</h1>
					<table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
					   <thead>
					     <tr>
			   	           <th>SL</th>
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
					    	try {
							    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							    $customer_id= $_SESSION['user_id'];
							    $customer_id='-'.$customer_id;
							    $stmt = $conn->query("SELECT * FROM `order_details` INNER JOIN `orders` ON orders.o_id=order_details.order_id INNER JOIN `products` ON products.p_id=order_details.product_id where order_details.customer_id ='$customer_id'"); 
							    
							    // set the resulting array to associative
							    $sl=1;
							    //var_dump("SELECT * FROM `order_details` INNER JOIN `products` ON products.p_id=order_details.product_id where `customer_id`='$customer_id'");
							    while ($row = $stmt->fetch()) {
					    	?>
					      <tr>
					      	<td><?php  echo $sl++; ?></td>
					      	<td><?php  echo $row['product_name']; ?></td>
					      	<td><img src="../img/<?php  echo $row['product_image']; ?>" height="50px;" width="50px;"></td>
					      	<td><?php  echo $row['category']; ?></td>
					      	<td><?php  echo $row['product_quantities']; ?></td>
					      	<td><?php  echo $row['product_total_price']; ?></td>
					      	<td><?php if($row['status']==1) echo "Not delivered"; if($row['status']==2) echo "On going"; if($row['status']==3|| $row['status']==4) echo "Delivered"; ?>  <?php  echo '('.$row['tracking_date'].')';?></td>
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



</html>