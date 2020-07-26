<!DOCTYPE html>
<?php include'include/header.php';?>
<html>
<head>
<title>Online buying cable</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shopin Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--theme-style-->
<link href="css/style4.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<script src="js/jquery.min.js"></script>
<!--- start-rate---->
<script src="js/jstarbox.js"></script>
	<link rel="stylesheet" href="css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		
<!---//End-rate---->
</head>
<body>
<!--header-->
<?php 
$session_id=session_id(); 
    include 'dbconfig.php';
    if(isset($_POST['checkout'])){
    	$cart_id=$_POST['cart_id'];
    	$quantity=$_POST['quantity'];
    	$unit_price=$_POST['unit_price'];
    	$total=0;
    	$customer_id=$_SESSION['user_id'];
    	$date= date('Y-m-d');
    	$transection_id= $_POST['transection_id'];


    	foreach ($quantity as $n => $k) {
    		$total= $total + $quantity[$n]*$unit_price[$n];
    	}
    	try {
	      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	      // set the PDO error mode to exception
	      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	if($_SESSION['usertype']=="shop_owner"||$_SESSION['usertype']=="customers"){
    		if($_SESSION['usertype']=="shop_owner")
    			$customer_id="-".$customer_id;
    		
    		$sql ="INSERT INTO  `orders`(`customer_id`,`total_amount`,`date`,`tracking_date`,`transection_id`) values('$customer_id','$total','$date','$date','$transection_id')";
    	
          // use exec() because no results are returned
          $conn->exec($sql);
          $last_id = $conn->lastInsertId();

          foreach ($quantity as $n => $key) {
          $subtotal=$quantity[$n]*$unit_price[$n];
          $stmt = $conn->query("SELECT * FROM `cart` INNER JOIN `products` ON products.p_id=cart.product_id where cart.cart_id='$cart_id[$n]'");
	      
	      $row = $stmt->fetch();
	      $shop_id= $row['shop_id'];
	      $product_id= $row['p_id'];

          $sql1="INSERT INTO  `order_details`(`customer_id`, `shop_id`, `product_id`, `product_quantities`, `product_total_price`, `order_id`,`status`) values('$customer_id','$shop_id','$product_id','$quantity[$n]','$subtotal','$last_id','1')";
          $result= $conn->exec($sql1);

          if($result){
          	$sql2 = "DELETE FROM  cart WHERE cart_id='$cart_id[$n]'";

              // use exec() because no results are returned
              $conn->exec($sql2);
          } 

      }
      	header('Location:customers/invoice.php?id='.$last_id);
    	}
    	else {

    	foreach ($quantity as $key => $n) {
    		$sql = "UPDATE `cart` SET `quantity`='$quantity[$n]' where `cart_id`='$cart_id[$n]'";

    	// Prepare statement
    	$stmt = $conn->prepare($sql);

    	// execute the query
    	$stmt->execute();
    	}
    	header('Location:login.php');
	  }
   }
	catch(PDOException $e) {
	        echo "Error: " . $e->getMessage();
	    }
	    $conn = null;	
    }
    ?>
			
			
						<!----->
			</div>
			<div class="clearfix"></div>
		</div>	
	</div>	
</div>
<!--banner-->


<div class="banner-top">
	<div class="container">
		<h1>Checkout</h1>
		<em></em>
		<h2><a href="index.html">Home</a><label>/</label>Checkout</h2>
	</div>
</div>
<!--login-->
	

<div class="container">
	<div class="check-out">
	<form action="checkout.php" method="POST">
	<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
    	    <table class="table-heading simpleCart_shelfItem">
		  <tr>
			<th class="table-grid">Item</th>
					
			<th>Price</th>
			<th width="10%">Quantity </th>
			<th>Subtotal</th>
			<th>Action</th>
		  </tr>
		  	<tbody id= "checkout_body">
		  	<?php 
		  		try {
			      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			      // set the PDO error mode to exception
			      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			      //$session_id=session_id();
			      $stmt = $conn->query("SELECT * FROM `cart` INNER JOIN `products` ON products.p_id=cart.product_id where cart.session_id='$session_id'");
			      $stmt1 = $conn->query("SELECT * FROM `cart` INNER JOIN `products` ON products.p_id=cart.product_id where cart.session_id='$session_id'");
			      $sl=0;
			      $total=0;
			      while($row1 = $stmt->fetch()){
			      	$total+=($row1['product_price']*$row1['quantity']);
			      }
			      while($row = $stmt1->fetch()){
			      	++$sl;
			      	?><input type="hidden" id="c_total" value="<?php echo $total;?>">
			      	<tr class="cart-header<?php echo $sl;?>">
			      	<input type="hidden" name="cart_id[]" id="cart_id<?php echo $sl;?>" value="<?php echo $row['cart_id']; ?>">
			      	<td class="ring-in">
			      	
			      	<img src="img/<?php echo $row['product_image']; ?>" class="img-responsive" alt="" width="50px" height="50px">
					<div class="sed">
						<h5><a href="single.html"><?php echo $row['product_name']; ?></a></h5>
						<p>Category: <?php echo $row['category'] ?> </p>
						<div id="m"></div>
					
					</div>
					<!-- <div class="clearfix"> </div> -->
					
					<td><?php echo $row['product_price']; ?>
						<input type="hidden" name="unit_price[]" id="unit_price<?php echo $sl;?>" value="<?php echo $row['product_price']; ?>">
					</td>
					<td><input class="form-control" onmouseup="calculate(<?php echo $sl;?>)" type="number" name="quantity[]" id="quantity<?php echo $sl;?>" value="<?php echo $row['quantity']; ?>" ></td>
					<td class="item_price"><div id="sub_total<?php echo $sl; ?>"><?php echo $row['quantity']*$row['product_price']; ?></div>
						
					</td>
					<td><input type="button"  class="btn btn-danger" onclick="close1(<?php echo $sl;?> ,<?php echo $row['cart_id'];?>)" value="Delete">
						
					</td>
				  </tr>
				  
				  <?php
			      }
			      //$sql ="INSERT INTO  `cart`(`product_id`, `quantity`, `session_id`) values('$product_id','$quantity','$session_id')";
			          
			      //$conn->exec($sql);
			    }
			catch(PDOException $e) {
			        echo "Error: " . $e->getMessage();
			    }
			    $conn = null;
		  	?>
		</tbody>
	</table>
	</div>
	</div>
	<!-- <div class="form-group col-sm-2">
	<label>Paid Amount</label>
	<input type="text" class="form-control" id="paid" name="paid" placeholder="0.00">
	</div>
	<div class="form-group col-sm-2">
	<label>Due</label>
	<input type="text" class="form-control" id="due" name="due" placeholder="0.00">
	</div> -->
	<div class="pull-right"><h4><label>Total Amount:</label> <div id=total1_amount><?php  echo $total;?></div></h4></div>
	<div class="produced" id="checkout">
	<?php 
        if(isset($_SESSION['usertype'])){
        ?>
	<input type="button" class="btn btn-danger" name="checkout" onclick="cart1()" value="Payment">
	<?php
        }
        else {
            ?>
            <input type="submit" class="btn btn-danger" name="checkout"  value="Payment">
    <?php
        }
        ?>
	 </div>
	</form>
    </div>
</div>

<script type="text/javascript">
	function cart1(){
		var html='<p>Please bkash total amount to marchent account: 01711111111.</p><div class="form-group"><label>Transection id: <label><input type="text" class="form-control col-sm-4"  name="transection_id"></div><div ><input type="submit" class="btn btn-danger" name="checkout"  value="Checkout"></div>';
		$('#checkout').empty();
	    $("#checkout").append(html);
	}
	function calculate(id){
		 var unit_price=$("#unit_price"+id).val();
		 var quantity=$("#quantity"+id).val();
		 var c_total=$("#c_total").val();
		 var c_id=$("#cart_id"+id).val();
		 var sub_total= document.getElementById("sub_total"+id).innerHTML;
		 var subtotal= unit_price*quantity;
		 var increment= Number(subtotal)-Number(sub_total);
		document.getElementById("sub_total"+id).innerHTML = subtotal;
		document.getElementById('cart_total').innerHTML= Number(document.getElementById('cart_total').innerHTML) + increment;
		document.getElementById('total1_amount').innerHTML = document.getElementById('cart_total').innerHTML;
		$.post("action/item_quantity_change.php", { c_id: c_id, quantity: quantity},
		    function(data) {
		   		
		    });
	}
	function close1(sl,id){
		
		var sub_total= document.getElementById("sub_total"+sl).innerHTML;
		document.getElementById('cart_total').innerHTML= Number(document.getElementById('cart_total').innerHTML) - Number(sub_total);
		document.getElementById('total1_amount').innerHTML = document.getElementById('cart_total').innerHTML;
		alert("Product delete from cart!");
		$('.cart-header'+sl).remove();
		$.post("action/item_delete.php", { id: id},
		    function(data) {
		   		
		    });

		
	}
	
	
</script>

<!--//login-->
<!--brand-->
		
	<!--//content-->
	<!--//footer-->
	<?php include'include/footer.php'; ?>
		<!--//footer-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	
<!-- slide -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="js/bootstrap.min.js"></script>
 
</body>
</html>