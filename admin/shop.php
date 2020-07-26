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
					<h1 style="text-align:center">Shop List</h1>
					<table id="onlinetable" class="table table-striped table-bordered " cellspacing="0" width="100%">
					   <thead>
					     <tr>
			   	           <th>SL</th>
				           <th>Shop name</th>
					       <th>Owner name</th>
					       <th>Location</th>
					       <th>Phone</th>
					       <th>Email Address</th>
					       <th>NID Image</th>
					       <th>NID no</th>
					       <th>Action</th>
					       <th>Warning</th>
					     </tr>
					    </thead>
					    <tbody >
					    	<?php
					    	try {
							    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							    $stmt= $conn->query("SELECT * FROM `shop_owner`"); 
							    
							    // set the resulting array to associative
							    $sl=1;
							    while ($row = $stmt->fetch()) {
					    	?>
					      <tr>
					      	<td><?php  echo $sl++; ?></td>
					      	<td><?php  echo $row['shop_name']; ?></td>
					      	<td><?php  echo $row['name']; ?></td>
					      	<td><?php  echo $row['address']; ?></td>
					      	<td><?php  echo $row['phone']; ?></td>
					      	<td><?php  echo $row['email']; ?></td>
					      	<td><img src="../img/<?php  echo $row['nid_image']; ?>" height="50px;" width="50px;"></td>
					      	<td><?php  echo $row['nid_no']; ?></td>
					      	<td style="padding:0;width:60px">
					          <a href="delete.php?id=<?php echo  $row['id']; ?>&type=shop_owner">
					        	<button type="reset" class=" btn btn-danger" >
					            <i class="fa fa-trash-o"></i>  Delete</button></a>
					        </td>
					        <td style="padding:0;width:60px">
					          <a href="warning.php?id=<?php echo  $row['id']; ?>&name=<?php echo $row['shop_name'];?>" style="color:red;">
					            warning message
					        </a>
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