<!DOCTYPE html>
<html>
<?php  
	include 'includes/head.php';
	include 'includes\header.php'; 
?>

<?php
include '../dbconfig.php';
if(isset($_POST['submit'])){
	$id= $_POST['id'];
	$message= $_POST['message'];

	try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="INSERT INTO  `warning`(`shop_id`,`message`) values('$id','$message')";
          
    $conn->exec($sql);
	}
	
  	catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        header('Location:shop.php');
        exit;
}
?>
<body>
    <section class="body">
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
					<h3>warning Message</h>
					<h4>Shop name:<?php echo $_GET['name'] ?></h4>
					<form action="warning.php" method="POST">
						<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
						<div class="from-group">
						<h4>Message:</h4>
						<textarea class="form-control" name="message" ></textarea>
						</div>
						<div class="from-group">
						<input type="submit" class="btn btn-success" name="submit">
						</div>
					</form>
				</div>
					          
            </section>
           
        </div>


    </section>
   
    <div class="footerarea">
        <center>
            <p>Copyright©
                <?php echo date("Y"); ?> Developed by <a href="#">Md 
                Sayem Uddin</a></p>
        </center>

    </div>
</body>


</html>

</html>
