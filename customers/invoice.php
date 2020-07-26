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
                <header class="page-header" style="margin-bottom:-2%;">
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

                <!-- end: sidebar -->
                <div class="container">
                    <section role="main" class="content-body">

                        <div class="col-sm-10" style="overflow-x:auto; -webkit-overflow-scrolling: touch; margin-left:-5%;">
                            <?php
					try {
				    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$order_id= $_GET['id'];
					$stmt1 = $conn->query("SELECT * FROM `orders` INNER JOIN `customers` ON customers.c_id=orders.customer_id  where orders.o_id='$order_id'"); 
					$row1 = $stmt1->fetch();

					?>

                            <table style="text-align:left;" width="100%">
                                <caption>
                                    <h1 style="text-align:center">Invoice</h1>
                                </caption>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>:</th>
                                    <th>
                                        <?php echo $row1['name']; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Present Address</th>
                                    <th>:</th>
                                    <th>
                                        <?php echo $row1['address']; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Shipping Address</th>
                                    <th>:</th>
                                    <th>
                                        <?php echo $row1['shipping_address']; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <th>:</th>
                                    <th>
                                        <?php echo $row1['date']; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Transection id</th>
                                    <th>:</th>
                                    <th>
                                        <?php echo $row1['transection_id']; ?>
                                    </th>
                                </tr>
                            </table>

                            <h1 style="text-align:center">Shopping products list</h1>
                            <table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%" border="1">
                                <thead>
                                    <tr>
                                        <th style="padding: 20px;">Invoice id</th>
                                        <th style="padding: 20px;">Shop name</th>
                                        <th style="padding: 20px;">Product name</th>
                                        <th style="padding: 20px;">Image</th>
                                        <th style="padding: 20px;">Category</th>
                                        <th style="padding: 20px;">Quantity</th>
                                        <th style="padding: 20px;">Total Price</th>
                                        <th style="padding: 20px;">Order Tracking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					    	
							    $total=0;
							    $stmt = $conn->query("SELECT * FROM `order_details` INNER JOIN `shop_owner` ON shop_owner.id=order_details.shop_id INNER JOIN `orders` ON orders.o_id=order_details.order_id  INNER JOIN `products` ON products.p_id=order_details.product_id where order_details.order_id='$order_id'"); 
							    
							    // set the resulting array to associative
							    $sl=1;
							    //var_dump("SELECT * FROM `order_details` INNER JOIN `products` ON products.p_id=order_details.product_id where `customer_id`='$customer_id'");
							    while ($row = $stmt->fetch()) {
					    	?>
                                    <tr>
                                        <td style="padding: 20px;">
                                            <?php  echo "#".$row['order_id']; ?>
                                        </td>
                                        <td style="padding: 20px;">
                                            <?php  echo $row['shop_name']; ?>
                                        </td>
                                        <td style="padding: 20px;">
                                            <?php  echo $row['product_name']; ?>
                                        </td>
                                        <td style="padding: 20px;"><img src="../img/<?php  echo $row['product_image']; ?>" height="50px;" width="50px;"></td>
                                        <td style="padding: 20px;">
                                            <?php  echo $row['category']; ?>
                                        </td>
                                        <td style="padding: 20px;">
                                            <?php  echo $row['product_quantities']; ?>
                                        </td>
                                        <td style="padding: 20px;">
                                            <?php  echo $row['product_total_price']; 
					      	$total+=$row['product_total_price'];
					      	?> BDT
                                        </td>

                                        <td style="padding: 20px;">
                                            <?php if($row['status']==1) echo "Not delivered"; if($row['status']==2) echo "On going"; if($row['status']==3|| $row['status']==4) echo "Delivered"; ?>
                                            <?php  echo '('.$row['tracking_date'].')';?>
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
                                <tbody>
                                    <tr>
                                        <td colspan="8">
                                            <h4>Total Amount:
                                                <?php echo $total ;?> BDT
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </section>
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



    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>


</html>
