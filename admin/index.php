
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

            $shops = $conn->query("SELECT count(*) FROM `shop_owner`")->fetchColumn();
            $customers= $conn->query("SELECT count(*) FROM `customers`")->fetchColumn();
            $driver= $conn->query("SELECT count(*) FROM `staff` where `role`='driver'")->fetchColumn();
            $electrician= $conn->query("SELECT count(*) FROM `staff` where `role`='electrician'")->fetchColumn();

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
                                        if(isset($_SESSION['usertype'])=='admin')
                                            echo $_SESSION['name'];
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
                                <a href="shop.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/shop.png" width="60px" height="60px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info" style="margin-left: 20px;">
                                                            <strong class="amount">No. of shops <br><?php echo $shops;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="customers.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/customer.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">No. of customers<br><?php echo $customers;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="staff.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/driver.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">No. of driver<br><?php echo $driver;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="staff.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/electrician.jpg" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">No. of electricians<br><?php echo $electrician;?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="payment.php" class="decoration-anchor">
                                    <section class="panel panel-featured-left panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon bg-primary">
                                                        <img src="../images/dollar.png" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">.</h4>
                                                        <div class="info">
                                                            <strong class="amount">Payment Confirmation</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </a>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <a href="contact.php" class="decoration-anchor">
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
                                                        <div class="info">
                                                            <strong class="amount">Message</strong>
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
