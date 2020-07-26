<!DOCTYPE html>
<html>
<?php   include 'includes/head.php';
?>
<?php
include '../dbconfig.php';?>
<body>
    <section class="body">

        <!-- start: header -->
        <?php include 'includes\header.php'; ?>
        <!-- end: header -->
        <?php

        if(isset($_POST['status'])){
			  $status=$_POST['status']+1;
			  $orderid=$_POST['orderid'];
			  try {
			      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			      // set the PDO error mode to exception
			      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			      $sql ="UPDATE `orders` SET `o_status`='$status' where `o_id`='$orderid'";
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
                
            	
				<div class="col-sm-12" style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
					<h1 style="text-align:center">Payment Confirmation</h1>
					<table id="onlinetable" class="table table-striped table-bordered " cellspacing="0" width="100%">
					   <thead>
					     <tr>
			   	           <th>SL</th>
			   	           <th>Customer Name</th>
			   	           <th>Mobile no</th>
			   	           <th>Address</th>
						   <th>Total Price</th>
					       <th>Order Date</th>
					       <th>Transection id</th>
					       <th>Status</th>
					       <th>Action</th>
					     </tr>
					    </thead>
					    <tbody >
					    	<?php
					    	try {
							    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							    $stmt= $conn->query("SELECT * FROM `orders` INNER JOIN `customers` ON customers.c_id=orders.customer_id where `o_status`=0 and `invalid`=0 order by o_id DESC"); 
							    
							    // set the resulting array to associative
							    $sl=1;
							    while ($row = $stmt->fetch()) {
					    	?>
					      <tr>
					      	<td><?php  echo $sl++; ?></td>
					      	<td><?php  echo $row['name']; ?></td>
					      	<td><?php  echo $row['phone']; ?></td>
					      	<td><?php  echo $row['shipping_address']; ?></td>
					      	<td><?php  echo $row['total_amount']; ?></td>
					      	<td><?php  echo $row['date']; ?></td>
					      	<td><?php  echo $row['transection_id']; ?></td>
					      	<td><form action="payment.php" method="POST">
					      		<input type="hidden" name="orderid" value="<?php  echo $row['o_id']; ?>">
			                  
			                      <button type="submit" class="btn btn-danger"  name="status" value="<?php echo $row['o_status'];?>">Confirm
			                    </button>
			                  
			                </form>
			            	</td>
			            	<td>
			            		<a href="delete.php?id=<?php echo $row['o_id'];?>&type=payment"><button class="btn btn-danger">Delete</button></a>
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
    <script src="http://code.jquery.com/jquery-1.11.0.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript">
	$(document).ready( function () {
    $('#onlinetable').DataTable();
		} );
</script>
    
    <div class="footerarea">
        <center>
            <p>Copyright©
                <?php echo date("Y"); ?> Developed by <a href="#">Md Sayem Uddin</a></p>
        </center>

    </div>
</body>


</html>