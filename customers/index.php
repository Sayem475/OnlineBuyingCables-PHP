<!doctype html>
<html class="fixed">

<?php include 'includes\head.php';?>
 <?php include 'includes\header.php'; ?>
<?php

include '../dbconfig.php';

if(isset($_POST['update'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    // $image=$_POST['image'];
    $email=$_POST['email'];
    $present_address=$_POST['present_address'];
    $shipping_address=$_POST['shipping_address'];
    // $nid_image=$_POST['nid_image'];
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $customer_id= $_SESSION['user_id'];
      
      $sql ="UPDATE `customers` SET `name`='$name', `phone`='$phone', `email`='$email',`address`='$present_address', `shipping_address`='$shipping_address'  where `c_id`='$customer_id'";
      //var_dump($sql);
      $stmt = $conn->prepare($sql);
      if($stmt->execute())
      {
        echo '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Successfully!</strong> Updated.
          </div>';
      }
      else {
        {
        echo '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Error!</strong> .
          </div>';
      }
      }
  }
  catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

}



?>


<body>
    <section class="body">

        <!-- start: header -->
       
        <!-- end: header -->

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
                                        if(isset($_SESSION['usertype'])=='customers')
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
                <?php 
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $customer_id= $_SESSION['user_id'];
                  $stmt = $conn->query("SELECT * FROM `customers` where `c_id`='$customer_id'"); 
                  
                  // var_dump("SELECT * FROM `customers` where `c_id`='$customer_id'");
                  while ($row = $stmt->fetch()) {
                      $name=$row['name'];
                      $phone=$row['phone'];
                      $email=$row['email'];
                      $present_address= $row['address'];
                      $shipping_address= $row['shipping_address'];
                      ?>

                      <form action="index.php" method="POST"  enctype="multipart/form-data">
                      <div class="form-group " >
                        <label for="name">Name</label>
                        <div id="name">
                        <?php  echo $name;?>
                        <input type="hidden" class="form-control " value="<?php  echo $name;?>" name="name">
                        <a  onclick="change('name')" ><span style="color: red">|change</span></a>
                        </div>
                        
                      </div>
                      
                      <div class="form-group" >
                        <label for="phone">Phone No.</label>
                        <div id="phone">
                        <?php  echo $phone;?>
                        <input type="hidden" class="form-control" value="<?php  echo $phone;?>" name="phone">
                        <a  onclick="change('phone')" ><span style="color: red">|change</span></a>
                      </div>
                      </div>

                      <div class="form-group" >
                        <label for="email">Email Address</label>
                        <div id="email">
                        <?php  echo $email;?>
                        <input type="hidden" class="form-control" value="<?php  echo $email;?>" name="email">
                        <a  onclick="change('email')" ><span style="color: red">|change</span></a>
                      </div>
                      </div>
                      
                      
                      <div class="form-group " >
                        <label for="present_address">Present Address</label>
                        <div id="present_address">
                        <?php  if($present_address!=null) {
                         ?>
                             <?php echo $present_address;?>
                             <a  onclick="change('present_address')" ><span style="color: red">|change</span></a>
                             <input type="hidden" class="form-control" value="<?php  echo $present_address;?>" name="present_address">
                         <?php   
                        }
                        else {
                            ?>
                            <input type="text"  class="form-control" name="present_address" >
                            <?php
                        }
                        ?>
                        
                      </div>
                      </div>  
                      <div class="form-group " >
                        <label for="shipping_address">Shipping Address</label>
                        <div id="shipping_address">
                        <?php  if($shipping_address!=null) {
                         ?>
                             <?php echo $shipping_address;?>
                             <a  onclick="change('shipping_address')" ><span style="color: red">|change</span></a>
                             <input type="hidden" class="form-control" value="<?php  echo $shipping_address;?>" name="shipping_address">
                         <?php   
                        }
                        else {
                            ?>
                            <input type="text"  class="form-control" name="shipping_address" >
                            <?php
                        }
                        ?>
                        
                      </div>
                      </div>  
                      
                      
                      <div class="form-group">
                        <button type="submit" class="btn btn-success" name="update">Update</button>
                      </div>
                    </form>

                <?php 
                  }
              }
                catch(PDOException $e) {
                          echo "Error: " . $e->getMessage();
                      }
                      $conn = null;
                      ?>
                
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  function change(id){
    if(id=='name')
        var html='<input type="text" class="form-control" value="<?php echo $name;?>" name="name">';
    if(id=='phone')
        var html='<input type="text" class="form-control" value="<?php echo $phone;?>" name="phone">';
    if(id=='email')
        var html='<input type="text" class="form-control" value="<?php  echo $email;?>" name="email">';
    if(id=='present_address')
        var html='<input type="text" class="form-control" value="<?php  echo $present_address;?>" name="present_address">';
    if(id=='shipping_address')
        var html='<input type="text" class="form-control" value="<?php  echo $shipping_address;?>" name="shipping_address">';
    $('#'+id).empty();
    $("#"+id).append(html);
    //document.getElementById('name').value="manik";
  }
</script>
</html>
