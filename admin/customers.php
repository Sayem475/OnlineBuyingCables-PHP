<!DOCTYPE html>
<html>
<?php
	include 'includes/head.php';
?>
<?php
include '../dbconfig.php';?>
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
                
            	
				<div class="col-sm-12" style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
					<h1 style="text-align:center">Customer List</h1>
					<table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
					   <thead>
					     <tr>
			   	           <th>SL</th>
				           <th>Name</th>
					       <th>Phone</th>
					       <th>Email Address</th>
					       <th>Address</th>
					       <th>Shipping Address</th>
					       <th>Action</th>
					     </tr>
					    </thead>
					    <tbody >
					    	<?php
					    	try {
							    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							    $stmt= $conn->query("SELECT * FROM `customers`"); 
							    
							    // set the resulting array to associative
							    $sl=1;
							    while ($row = $stmt->fetch()) {
					    	?>
					      <tr>
					      	<td><?php  echo $sl++; ?></td>
					      	<td><?php  echo $row['name']; ?></td>
					      	<td><?php  echo $row['phone']; ?></td>
					      	<td><?php  echo $row['email']; ?></td>
					      	<td><?php  echo $row['address']; ?></td>
					      	<td><?php  echo $row['shipping_address']; ?></td>
					      	<td style="padding:0;width:60px">
					          <a href="delete.php?id=<?php echo  $row['c_id']; ?>&type=customers">
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