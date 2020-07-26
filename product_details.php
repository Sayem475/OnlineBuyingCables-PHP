<!DOCTYPE html>
<html>

<head>
    <title>Online Buying Cable</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Shopin Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <!--theme-style-->
    <link href="css/style4.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <script src="js/jquery.min.js"></script>
    <!--- start-rate---->
    <script src="js/jstarbox.js"></script>
    <link rel="stylesheet" href="css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
    <script type="text/javascript">
        jQuery(function() {
            jQuery('.starbox').each(function() {
                var starbox = jQuery(this);
                starbox.starbox({
                    average: starbox.attr('data-start-value'),
                    changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
                    ghosting: starbox.hasClass('ghosting'),
                    autoUpdateAverage: starbox.hasClass('autoupdate'),
                    buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
                    stars: starbox.attr('data-star-count') || 5
                }).bind('starbox-value-changed', function(event, value) {
                    if (starbox.hasClass('random')) {
                        var val = Math.random();
                        starbox.next().text(' ' + val);
                        return val;
                    }
                })
            });
        });

    </script>
    <!---//End-rate---->
    <link href="css/form.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
    <!--header-->
    <?php include'include/header.php'; 
    include 'dbconfig.php';

    ?>
    <?php 
    if(isset($_SESSION['user_id'])){
    $product_id=$_GET['id'];
    $customer_id=$_SESSION['user_id'];
    if(isset($_REQUEST['rate_product'])){
   
    $rating = trim($_REQUEST['rating']);

    if(empty($rating)){
      $error = "Please select stars";
    }
    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

    if(!isset($error)){
        $sql = 'SELECT * from rating where customer_id=:customer_id and product_id=:product_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
           $sql='UPDATE rating SET rating=:rating where customer_id=:customer_id and product_id=:product_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':rating', $rating);
            $stmt->execute();
          
        }else{
          $sql = "INSERT INTO rating(product_id, customer_id, rating) VALUES ( :product_id, :customer_id, :rating)";
          $insert_stmt = $db->prepare($sql);
          $insert_stmt->bindParam(':customer_id', $customer_id);
          $insert_stmt->bindParam(':product_id', $product_id);
          $insert_stmt->bindParam(':rating', $rating);

      if($insert_stmt->execute()){
        $insert_stmt = $db->prepare("SET @count = 0");
        $insert_stmt->execute();

          echo "<script>alert('Rating Added Successfully');</script>";
        }else{
          echo "<script>alert('Rating Not Added');</script>";
        }
        }
        
      
    }else{
      echo "<script>alert('Something Wrong!!!Try Again');</script>";
    }
  }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $db = null;
}
} 
    
    ?>
    <!--banner-->
    <div class="banner-top">
        <div class="container">
            <h1>Product Details</h1>
            <em></em>
            <h2><a href="index.php">Home</a><label>/</label><a href="#">Product</a></h2>
        </div>
    </div>
    <?php
    $id=$_GET['id'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_SESSION['user_id'])){
        $customer_id=$_SESSION['user_id'];
        $ratingeligibility = $conn->query("SELECT count(*) FROM `order_details` where `customer_id`='$customer_id' and `product_id`='$id'")->fetchColumn();
        }
        $stmt = $conn->query("SELECT * FROM `products` where `p_id`='$id'");
        // set the resulting array to associative
        
        $row = $stmt->fetch();
        $image=$row['product_image'];
        $product_id=$row['p_id'];
        $category=$row['category'];
        $price=$row['product_price'];
        $name=$row['product_name'];
        $description=$row['product_details'];
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    ?>
    <div class="single">

        <div class="container">
            <div class="col-md-9">
                <div class="col-md-5 grid">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="img/<?php echo $image;?>">
                                <div class="thumb-image"> <img src="img/<?php echo $image;?>" data-imagezoom="true" class="img-responsive"> </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 single-top-in">
                    <div class="span_2_of_a1 simpleCart_shelfItem">
                        <h3><?php echo $name; ?></h3>

                        <p class="in-para"> <?php echo $category;?></p>

                        <div class="price_single">
                            <span class="reducedfrom item_price"><?php echo $price;?> Tk (per meter)</span>
                            <input type="hidden" id="price" value="<?php echo $price ;?>">
                            <div class="clearfix"></div>
                        </div>
                        <h4 class="quick">Quick Overview:</h4>
                        <p class="quick_desc"> <?php  echo $description; ?> </p>
                        <div class="wish-list">
                           <!-- here will be wish list and add to compare -->
                        <div class="quantity">
                            <div class="quantity-select">
                                <div class="entry value-minus">&nbsp;</div>
                                <div class="entry value"><span>1</span></div>
                                <input type="hidden" name="quantity1" id="quantity1" value="1">
                                <div class="entry value-plus active">&nbsp;</div>
                            </div>
                        </div>
                        <!--quantity-->
                        <script>
                            $('.value-plus').on('click', function() {
                                var divUpd = $(this).parent().find('.value'),
                                    newVal = parseInt(divUpd.text(), 10) + 1;
                                divUpd.text(newVal);
                                document.getElementById('quantity1').value=newVal;
                            });

                            $('.value-minus').on('click', function() {
                                var divUpd = $(this).parent().find('.value'),
                                    newVal = parseInt(divUpd.text(), 10) - 1;
                                if (newVal >= 1) divUpd.text(newVal);
                                document.getElementById('quantity1').value=newVal;
                            });

                        </script>
                        <!--quantity-->

                        <a href="#" class="add-to item_add hvr-skew-backward" onclick="add_to_cart(<?php echo $id; ?>)">Add to cart</a>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="">
                        <form action="" method="post">
                            <?php  
                            if(isset($ratingeligibility) && $ratingeligibility>0){
                            ?>
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" name="rating" value=".5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset> 
                            <?php
                            }
                            ?>
                            <!--show rating  -->
                            
                            <?php
                                     try {
                                    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt_rat = $db->prepare('SELECT AVG(rating) as avg_rat from rating WHERE product_id = :product_id');
                                    $stmt_rat->bindParam(':product_id', $product_id);
                                    $stmt_rat->execute();
                                    $r = $stmt_rat->fetch(PDO::FETCH_ASSOC);
                                        
                                    
                                    $stmt_rat = $db->prepare('SELECT * from rating WHERE product_id = :product_id');
                                    $stmt_rat->bindParam(':product_id', $product_id);
                                    $stmt_rat->execute();
                                    $stmt_rat->fetch(PDO::FETCH_ASSOC);
                                    $total_row = $stmt_rat->rowCount();
                                         
                                ?>
                                   <p style="margin-left:20px; padding-left:140px; padding-top:8px;margin-top:10px;">Rating: 
                                                
                                         <?php if($r['avg_rat'] == 0){
                                            echo "5 (Not Rated yet)";
                                        }else{
                                            echo round($r['avg_rat'],2)." (".$total_row." person rated)";
                                        }
                                     }catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                        ?>
                                    </p>
                            <!--show rating  -->
                            <?php  
                            if(isset($ratingeligibility) && $ratingeligibility>0){
                                ?>
                            <br>
                            <br>
                            <input class="btn btn-info text-left" type="submit" name="rate_product" value="Submit" />
                            <?php
                            }
                            ?>
                        </form>

                     </div>

                </div>
                <div class="clearfix"> </div>
                <script type="text/javascript">
                    function add_to_cart(id){
                        var quantity=$("#quantity1").val();
                        var price=$("#price").val();
                        var total= document.getElementById('cart_total').innerHTML;
                        var sub_total= Number(price)*Number(quantity);
                        document.getElementById('cart_total').innerHTML= Number(total)+sub_total;
                        alert("Product add in cart!");
                        $.post("action/cart.php", { id: id , quantity: quantity},
                        function(data) {
                            
                        });
                    }
                </script>
                <!---->
               
            </div>
           

           
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <!--//footer-->
    
    <?php include'include/footer.php'; ?>

    <!--//footer-->
    <script src="js/imagezoom.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script defer src="js/jquery.flexslider.js"></script>
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

    <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });

    </script>

    <script src="js/simpleCart.min.js"> </script>
    <!-- slide -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
