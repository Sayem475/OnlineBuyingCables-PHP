<?php include 'dbconfig.php';?>
    <div class="content">
        <div class="container">
            <!--products-->
            <div class="content-mid">
                <h3>Items
                <label class="line"></label>
                <div class="mid-popular">
                    <?php
                        try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                if(isset($_POST['search'])){
                                    $search=$_POST['search'];
                                    if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    
                                    $stmt = $conn->query("SELECT * FROM `products` where `shop_id`='$id' and `product_name` LIKE '%$search%'");
                                }
                                else {
                                    $stmt = $conn->query("SELECT * FROM `products` where `product_name` LIKE '%$search%'"); 
                                }
                                }else{
                                    if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    $stmt = $conn->query("SELECT * FROM `products` where `shop_id`='$id'");
                                }
                                else {
                                    $stmt = $conn->query("SELECT * FROM `products`"); 
                                }
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
                        
                        <div class=" mid-pop" style="height: 90%;">
                            <center><div class="pro-img" style="height: 180px;">
                                <img src="img/<?php echo $image;?>" class="img-responsive"  height="180px" width="180px" alt="">
                                <div class="zoom-icon ">
                                    <a class="picture" href="img/<?php echo $image;?>" rel="title" class="b-link-stripe b-animate-go  thickbox"><i class="glyphicon glyphicon-search icon "></i></a>
                                    <a href="product_details.php?id=<?php echo $product_id;?>"><i class="glyphicon glyphicon-menu-right icon"></i></a>
                                </div>
                            </div></center>
                            <div class="mid-1" style="padding-top: 0em!important;">
                                <div class="women">
                                    <div class="women-top">
                                        <span style="font-size: 16px;"><?php echo $category; ?></span>
                                        <h6 style="font-size: 14.4px;"><a href="product_details.php?id=<?php echo $product_id;?>"><?php echo $name; ?></a></h6>
                                    </div>
                                    <div class="img item_add">
                                        <a href="#"><img src="images/ca.png" alt=""></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="mid-2" style="padding-top: 0em!important;">
                                    <p style="font-size: 12px;" class="item_price"><?php echo $price;?>Tk(per meter)</p>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>

                                    
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        
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