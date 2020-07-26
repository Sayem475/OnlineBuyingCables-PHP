<?php
//ob_start();
if(isset($_POST['email'])){
include 'dbconfig.php';
$email=$_POST['email'];
$user_password=md5($_POST['password']);
        
try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $count = $conn->query("SELECT count(*) FROM `users` where `email`='$email' && `password`='$user_password'")->fetchColumn();
          $stmt = $conn->query("SELECT * FROM `users` where `email`='$email' && `password`='$user_password'"); 
    
    
          $row = $stmt->fetch();
 
          
        if( $count == 1 )
        {
            
        // echo $path_choice;
        // echo $page_inc;
        session_start();
        $_SESSION['name']=$row['name'];
        $_SESSION['usertype']=$row['user_type'];
        $usertype = $row['user_type'];     
        $user_id=$row['id'];
        if($usertype=='admin'){
            $_SESSION['user_id']=$row['id'];
            header('Location:admin/index.php');
        }
        if($usertype=='shop_owner'){
            $stmt1 = $conn->query("SELECT * FROM `shop_owner` where `user_id`='$user_id'"); 
            $row1 = $stmt1->fetch();
            $_SESSION['user_id']=$row1['id'];
            header('Location:shop_owner/index.php');
        }
        if($usertype=='customers'){
            $stmt1 = $conn->query("SELECT * FROM `customers` where `user_id`='$user_id'"); 
            $row1 = $stmt1->fetch();
            $_SESSION['user_id']=$row1['c_id'];
            header('Location:index.php');
        }
        if($usertype=='driver'|| $usertype=='electrician'){
            $stmt1 = $conn->query("SELECT * FROM `staff` where `user_id`='$user_id'"); 
            $row1 = $stmt1->fetch();
            $_SESSION['user_id']=$row1['id'];
            header('Location:driverElectrician/index.php');
        }
        exit;

        }
        else{
            
        echo '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Sorry!</strong> Your email or Password Not Correct.
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
        <h1>Login</h1>
        <em></em>
        <h2><a href="index.html">Home</a><label>/</label><a href="login.php">Login</a></h2>
    </div>
</div>
<!--login-->
<div class="container">
    <div class="login">
        <form action="login.php" method="POST">
            <div class="col-md-6 login-do">
                <div class="login-mail">
                    <input type="text" placeholder="Email" name="email" id="email" required>
                    <i class="glyphicon glyphicon-envelope"></i>
                </div>

                <div class="login-mail">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <i class="glyphicon glyphicon-lock"></i>
                </div>

<!--
                <div class="login-mail">
                    <select name="usertype" id="usertype" class="form-control">
                        <option value="">Select User Type</option>
                        <option value="admin">Admin</option>
                        <option value="shop_owner">Shop Owner</option>
                        <option value="customers">Customer</option>
                        <option value="driver">Driver</option>
                        <option value="electrician">Electrician</option>
                    </select>
                </div>
-->

                <label class="hvr-skew-backward">
                    <input type="submit" value="Login" name="login" id="login">
                </label>

            </div>
            <div class="col-md-6 login-right">
                <h2 style="padding-top: 20px;padding-bottom: 20px;">Welcome to the official Login page of Online Buying Cables</h2>

                <center>
                    <label class="hvr-skew-backward">
                        <a href="register.php" style="text-decoration: none;">Register here</a>
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
