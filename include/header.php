<!DOCTYPE html>
<html>
<?php ob_start() ; 
session_start();
$session_id = session_id();
include 'dbconfig.php';
?>
<head>
    <title>Online Buying Cables</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/card.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text.php; charset=utf-8" />
    <meta name="keywords" content="" />
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
    <link rel="stylesheet" href="css/rating.css">
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

</head>

<body>
    <!--header-->
    <div class="header" style="margin-bottom: -20px;">
        <div class="container">
            <div class="head">
                <div class=" logo">
                    <a href="index.php"><img src="" alt=""></a>
                </div>
            </div>
        </div>
        <div class="header-top">
            <div class="container">
                <div class="col-sm-12 header-login text-right">
                    <ul><?php if(isset($_SESSION['user_id'])){
                        $usertype= $_SESSION['usertype'];
                        echo '<li><a href="'.$usertype.'/index.php">My Account</a></li>';
                        }
                        else {
                            ?>
                        
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <?php  }?>
                        <li><a href="checkout.php">Checkout</a></li>

                    </ul>
                </div>

                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="container">

            <div class="head-top">

                <div class="col-sm-8 col-md-offset-2 h_menu4">
                    <nav class="navbar nav_bottom" role="navigation">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header nav_2">
                            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>

                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav nav_1">
                                <li><a class="color" href="index.php">Home</a></li>
                                <li><a class="color3" href="shop.php">Shop</a></li>
                                <li><a class="color4" href="driver.php">Driver</a></li>
                                <li><a class="color5" href="electrician.php">Electrician</a></li>
                                <li><a class="color6" href="contact.php">Help</a></li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->

                    </nav>
                </div>
                <div class="col-sm-2 search-right">
                    <ul class="heart">
                        
                <!--             <a href="#">
                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                </a></li> -->
                        <input type="text" id="search" onkeyup="search()" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}">
                        <div class="cart box_1">
                        <a href="checkout.php">
                            <?php
                            try {
                              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                              // set the PDO error mode to exception
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $stmt=$conn->query("SELECT * FROM `cart` INNER JOIN `products` ON products.p_id= cart.product_id where `session_id` = '$session_id' ");
                              $total=0;
                              while($row = $stmt->fetch()){
                                    $total+=($row['product_price']*$row['quantity']);
                                }

                              }
                                catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    $conn = null;   
                            ?>
                            <div id="cart_total"><?php echo $total; ?></div>
                            <img src="images/cart.png" alt="" />
                        </a>
                        <p><a href="#" onclick="empty_cart()">Empty Cart</a></p>
                        <script type="text/javascript">
                            function empty_cart(){
                                document.getElementById('cart_total').innerHTML=0;
                                
                                $("#checkout_body").empty();
                                $.post("action/empty_cart.php", { },
                                function(data) {
                                    document.getElementById('total1_amount').innerHTML=0;
                                });
                            }
                        </script>

                    </div>
                    </ul>
                    
                </div>
                    <div class="clearfix"> </div>

                    <!----->

                    <!---pop-up-box---->
                    <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
                    <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
                    <!---//pop-up-box---->
                    
                    <script>
                        $(document).ready(function() {
                            $('.popup-with-zoom-anim').magnificPopup({
                                type: 'inline',
                                fixedContentPos: false,
                                fixedBgPos: true,
                                overflowY: 'auto',
                                closeBtnInside: true,
                                preloader: false,
                                midClick: true,
                                removalDelay: 300,
                                mainClass: 'my-mfp-zoom-in'
                            });

                        });

                    </script>
                    <!----->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <hr>