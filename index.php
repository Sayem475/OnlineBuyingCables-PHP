<?php include'include/header.php'; 
include 'dbconfig.php';
?>
   <!--banner-->
<div class="banner-top">
    <div class="container">
        <h1>Online Buying Cables</h1>
        <em></em>
        <h2><a href="index.php">Home</a></h2>
    </div>
</div>
    <!--content-->
    <div class="content">
        <div class="container">
            <!--products-->
            <div class="content-mid">
               <?php
                
                if(isset($_GET['shopname'])){
                    $shop_name=$_GET['shopname'];
                    echo '<h3>'.$shop_name.'</h3>';
                }
                else{
                ?>
                <h3>Trending Items</h3>
                <?php  
                }
                ?>
                <label class="line"></label>
                <div class="mid-popular">
                    <?php
                        try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    $stmt = $conn->query("SELECT * FROM `products` where `shop_id`='$id'");
                                }
                                else {
                                    $stmt = $conn->query("SELECT * FROM `products`"); 
                                }
                                
                                
                                // set the resulting array to associative
                                
                                while ($row = $stmt->fetch()) {
                                    $image=$row['product_image'];
                                    $product_id=$row['p_id'];
                                    $category=$row['category'];
                                    $price=$row['product_price'];
                                    $name=$row['product_name'];
                        ?>
                    
                       <div class="col-md-4 item-grid simpleCart_shelfItem" style="height: 400px; ">
                        <a href="product_details.php?id=<?php echo $product_id;?>">
                        <div class=" mid-pop" style="height: 90%;">
                            <center><div class="pro-img" style="height: 180px;">
                                <img src="img/<?php echo $image;?>" class="img-responsive"  height="180px" width="180px" alt="">
                                <div class="zoom-icon ">
                                    <a class="picture" href="img/<?php echo $image;?>" rel="title" class="b-link-stripe b-animate-go  thickbox"><i class="glyphicon glyphicon-search icon "></i></a>
                                    <a href="product_details.php?id=<?php echo $product_id;?>"><i class="glyphicon glyphicon-menu-right icon"></i></a>
                                </div>
                            </div></center>
                            <div class="mid-1" >
                                <div class="women">
                                    <div class="women-top">
                                        <span><?php echo $category; ?></span>
                                        <h6 ><a href="product_details.php?id=<?php echo $product_id;?>"><?php echo $name; ?></a></h6>
                                    </div>
                                    <div class="img item_add">
                                        <a href="product_details.php?id=<?php echo $product_id;?>"><img src="images/ca.png" alt=""></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="mid-2">
                                    <p><em class="item_price"><?php echo $price;?>Tk(per meter)</em></p>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>

                                    
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                           </a>
                        
                    </div>
                    
                     
                    <?php
                        }
                            }catch(PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                $conn = null;
                        ?>

                </div>
            </div>
            <!--//products-->
        </div>

    </div>
    <!--//content-->
    <script type="text/javascript">
        function search(){
            var search= $("#search").val();
            $.post("search.php", { search: search},
            function(data) {
                $(".content-mid").empty();
                $(".content-mid").append(data);
            });
        }
    </script>
  <?php include'include/footer.php'; ?>