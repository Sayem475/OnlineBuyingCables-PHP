
<!doctype html>
<html class="fixed">

<?php include 'includes\head.php';?>

<body>
    <section class="body">

        <!-- start: header -->
        <?php include 'includes\header.php'; ?>
        <!-- end: header -->
        <?php  
        include '../dbconfig.php';
        $shop_id= $_SESSION['user_id'];
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $no_product = $conn->query("SELECT count(*) FROM `products` where `shop_id`='$shop_id'")->fetchColumn();
            $not_delivered= $conn->query("SELECT count(*) FROM `order_details` where `shop_id`='$shop_id' and `status`=1")->fetchColumn();
            $on_going= $conn->query("SELECT count(*) FROM `order_details` where `shop_id`='$shop_id' and `status`=2")->fetchColumn();
            $delivered= $conn->query("SELECT count(*) FROM `order_details` where `shop_id`='$shop_id' and `status`>2")->fetchColumn();
            $warning= $conn->query("SELECT count(*) FROM `warning` where `shop_id`='$shop_id' ")->fetchColumn();
            }
          catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
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
                <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="row">
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="add_product.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/product.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info" style="margin-left: 20px;">
                                                            <strong class="amount">No. of products <br><?php echo $no_product;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="orders.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/notdelivered.png" width="80px" height="80px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">Not delivered orders<br><?php echo $not_delivered;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="orders.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/ongoing.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">On Going orders<br><?php echo $on_going;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="orders.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/delivered.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">Delivered orders<br><?php echo $delivered;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="warning_message.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/message.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info" style="margin-left: 20px;">
                                                            <strong class="amount" style="color:red;">Warning Message<br><?php echo $warning;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                            </div>
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
