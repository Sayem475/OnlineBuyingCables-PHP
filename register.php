<?php

if(isset($_POST['register'])){
include 'dbconfig.php';
$name=$_POST['name'];
$phone=$_POST['phone'];
$usertype=$_POST['usertype'];
$email=$_POST['email'];
$user_password=md5($_POST['password']);

try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $count = $conn->query("SELECT count(*) FROM `users` where `user_type`='$usertype' && `email`='$email' && `password`='$user_password'")->fetchColumn();
      

        if( $count ==0 )
        {
        $sql ="INSERT INTO  `users`(`name`,`email`,`user_type`,`password`) values('$name','$email','$usertype','$user_password')";
          
        $conn->exec($sql);

        $last_id = $conn->lastInsertId();

        session_start();
        $_SESSION['name']=$name;
        $_SESSION['usertype']=$usertype;
        //$_SESSION['userid']=$last_id;
        if($usertype=='shop_owner'){
            $sql1 ="INSERT INTO  `shop_owner`(`user_id`,`name`,`phone`,`email`) values('$last_id','$name','$phone','$email')";
          
            $conn->exec($sql1);

            $shop_id = $conn->lastInsertId();
            $_SESSION['user_id']=$shop_id;
            //$last_id= "shop".$last_id;
            
            $c_id= '-'.$shop_id;
            $sql2 ="INSERT INTO  `customers`(`c_id`,`user_id`,`name`,`phone`,`email`) values('$c_id','$last_id','$name','$phone','$email')";
          
            $conn->exec($sql2);
            header('Location:shop_owner/index.php');
        }
        if($usertype=='customers'){
            $sql1 ="INSERT INTO  `customers`(`user_id`,`name`,`phone`,`email`) values('$last_id','$name','$phone','$email')";
          
            $conn->exec($sql1);
            $customer_id = $conn->lastInsertId();
            $_SESSION['user_id']=$customer_id;
            header('Location:index.php');
        }
        if($usertype=='driver'|| $usertype=='electrician'){
            $sql1 ="INSERT INTO  `staff`(`user_id`,`name`,`role`,`phone`) values('$last_id','$name','$usertype','$phone')";
          
            $conn->exec($sql1);
            $staff_id = $conn->lastInsertId();
            $_SESSION['user_id']=$staff_id;
            header('Location:driverElectrician/index.php');
        }
        exit;

        }
        else{
        echo '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Sorry!</strong> Your have already an account.
          </div>';
        }

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;


}

?>

<?php include'include/header.php'; ?>
<!--banner-->
<div class="banner-top">
    <div class="container">
        <h1>Register</h1>
        <em></em>
        <h2><a href="index.html">Home</a><label>/</label><a href="register.php">Register</a></h2>
    </div>
</div>
<!--login-->
<div class="container">
    <div class="login">
        <form action="register.php" method="POST">
            <div class="col-md-6 login-do">
                <div class="login-mail">
                    <input type="text" placeholder="Full Name" required="required" name="name" id="name">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
                <div class="login-mail">
                    <input type="text" placeholder="Phone Number" required="required" name="phone" id="phone">
                    <i class="glyphicon glyphicon-phone"></i>
                </div>
                <div class="login-mail">
                    <input type="text" placeholder="Email" required="required" name="email" id="email">
                    <i class="glyphicon glyphicon-envelope"></i>
                </div>
                <div class="login-mail">
                    <select name="usertype" id="usertype" class="form-control" required="required">
                        <option value="">Select User Type</option>
                        <option value="shop_owner">Shop Owner</option>
                        <option value="customers">Customer</option>
                        <option value="driver">Driver</option>
                        <option value="electrician">Electrician</option>
                    </select>
                </div>
                <div class="login-mail">
                    <input type="password" placeholder="Password" required="required" name="password" id="password">
                    <i class="glyphicon glyphicon-lock"></i>
                </div>
                <label class="hvr-skew-backward">
                    <input type="submit" value="Register" name="register" id="register">
                </label>

            </div>
            <div class="col-md-6 login-right">
                <center><img src="img/img1.jpg" alt="cable image" height="200px" width="auto"></center>
                <h2 style="padding-top: 20px;padding-bottom: 20px;">Welcome to the official registration page of Online Buying Cables</h2>

                <center>
                    <label class="hvr-skew-backward">
                        <a href="login.php" style="text-decoration: none;">Log in Here</a>
                    </label>
                </center>
            </div>

            <div class="clearfix"> </div>
        </form>
    </div>

</div>

<!--//login-->

<!--//content-->
<?php include'include/footer.php'; ?>
