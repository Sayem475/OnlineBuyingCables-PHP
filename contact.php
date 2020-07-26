<?php include'include/header.php'; 
include 'dbconfig.php';
if(isset($_POST['send'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="INSERT INTO  `contact`(`name`, `email`, `subject`,`message`) values('$name','$email','$subject','$message')";
          
      if($conn->exec($sql))
      {
      	echo '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Congrates!</strong> Send Successfully.
          </div>';
      }
	  }
	  catch(PDOException $e) {
	            echo "Error: " . $e->getMessage();
	        }
	        $conn = null;
}
?>
<!--banner-->
	<div class="banner-top">
	<div class="container">
		<h1>Contact</h1>
		<em></em>
		<h2><a href="index.php">Home</a><label>/</label>Contact</a></h2>
	</div>
</div>	
		
			<div class="contact">
					
				<div class="contact-form">
					<div class="container">
					<div class="col-md-6 contact-left">
						<h3>At vero eos et accusamus et iusto odio dignissimos ducimus qui </h3>
						<p>Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.
						At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas. </p>
					
			
					<div class="address">
					<div class=" address-grid">
							<i class="glyphicon glyphicon-map-marker"></i>
							<div class="address1">
								<h3>Address</h3>
								<p>Bhatiary Chittagong4</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-phone"></i>
							<div class="address1">
							<h3>Our Phone:<h3>
								<p>+123456789</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-envelope"></i>
							<div class="address1">
							<h3>Email:</h3>
								<p><a href="mailto:info@example.com"> Sayem@com</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-bell"></i>
							<div class="address1">
								<h3>Open Hours:</h3>
								<p>Monday-Friday, 7AM-5PM</p>
							</div>
							<div class="clearfix"> </div>
						</div>
</div>
				</div>
				<div class="col-md-6 contact-top">
					<h3>Any suggestion</h3>
					<form action="contact.php" method="POST">
						<div>
							<span>Your Name </span>		
							<input type="text" name="name" >						
						</div>
						<div>
							<span>Your Email </span>		
							<input type="text" name="email" >						
						</div>
						<div>
							<span>Subject</span>		
							<input type="text" name="subject" >	
						</div>
						<div>
							<span>Your Message</span>		
							<textarea name="message"> </textarea>	
						</div>
						<label class="hvr-skew-backward">
								<input type="submit" name="send" value="Send" >
						</label>
</form>						
				</div>
		<div class="clearfix"></div>
		</div>
		</div>
		<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3688.0542969272747!2d91.76508101495695!3d22.426982085257926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd75ba601f0f5%3A0x2e579ae805e3a4c9!2sBhatiary%20Golf%20%26%20Country%20Club!5e0!3m2!1sen!2sbd!4v1567789830508!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
					</div>
	</div>

<!--//contact-->

			</div>
			
		</div>
	<!--//content-->
	<!--//footer-->
   <?php include'include/footer.php'; ?>
    <!--//footer-->
        
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<script src="js/simpleCart.min.js"> </script>
<!-- slide -->
<script src="js/bootstrap.min.js"></script>
 
</body>
</html>