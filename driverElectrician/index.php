

<!doctype html>
<html class="fixed">

<?php include 'includes\head.php';?>

<?php
include '../dbconfig.php';
$staff_id= $_SESSION['user_id'];

if(isset($_POST['update'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $nid_no=$_POST['nid_no'];
    // $nid_image=$_POST['nid_image'];
    if(empty($_FILES["image"]["name"])){
    $image=$_POST['image'];
    }
    else{
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image=$_FILES["image"]["name"];
    }
    if(empty($_FILES["nid_image"]["name"])){
    $nid_image=$_POST['nid_image'];
    }
    else{
    $target_dir2 = "../img/";
    $target_file2 = $target_dir2 . basename($_FILES["nid_image"]["name"]);
    move_uploaded_file($_FILES["nid_image"]["tmp_name"], $target_file2);
    $nid_image=$_FILES["nid_image"]["name"];
    }

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="UPDATE `staff` SET `name`='$name', `phone`='$phone', `image`='$image',`nid_no`='$nid_no', `nid_image`='$nid_image', `address`= '$address'  where `id`='$staff_id'";
      //var_dump($sql);
      $stmt = $conn->prepare($sql);
      if($stmt->execute())
      {
        echo '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Successfully!</strong> Updated.
          </div>';
      }
  }
  catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

}


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT * FROM `staff` where `id`='$staff_id'"); 
    
    //var_dump("SELECT * FROM `staff` where `id`='$staff_id'");
    while ($row = $stmt->fetch()) {
        $name=$row['name'];
        $phone=$row['phone'];
        $image=$row['image'];
        $nid_no=$row['nid_no'];
        $nid_image=$row['nid_image'];
        $address=$row['address'];

    }
}
  catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
?>


<body>
    <section class="body">

        <!-- start: header -->
        <?php include 'includes\header.php'; ?>
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
                                        if(isset($_SESSION['usertype'])=='driver'|| $_SESSION['usertype']=='electrician')
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
                  <div class="form-group " >
                    <label for="image">Photo</label>
                    <div id="image">
                    <?php  if($image!=null) {
                     ?>
                         <img src="../img/<?php echo $image;?>" class="img-responsive" width="150px;" height="150px;">
                         <a  onclick="change('image')" ><span style="color: red">|change</span></a>
                         <input type="hidden" class="form-control" value="<?php  echo $image;?>" name="image">
                     <?php   
                    }
                    else {
                        ?>
                        <input type="file"  class="form-control" name="image" >
                        <?php
                    }
                    ?>
                    
                  </div>
                </div>
                <div class="form-group " >
                    <label for="address">Present Address</label>
                    <div id="address">
                    <?php  if($address!=null) {
                     ?>
                         <?php  echo $address;?>
                        <input type="hidden" class="form-control " value="<?php  echo $address?>" name="address">
                        <a  onclick="change('address')" ><span style="color: red">|change</span></a>
                     <?php   
                    }
                    else {
                        ?>
                        <input type="text" class="form-control "  name="address">
                        <?php
                    }
                    ?>
                    
                    </div>
                </div>
                  <div class="form-group " >
                    <label for="nid_no">NID No.</label>
                    <div id="nid_no">
                    <?php  if($nid_no!=null) {
                     ?>
                         <?php  echo $nid_no;?>
                        <input type="hidden" class="form-control " value="<?php  echo $nid_no?>" name="nid_no">
                        <a  onclick="change('nid_no')" ><span style="color: red">|change</span></a>
                     <?php   
                    }
                    else {
                        ?>
                        <input type="text" class="form-control "  name="nid_no">
                        <?php
                    }
                    ?>
                    
                    </div>
                </div>
                  <div class="form-group " >
                    <label for="nid_image">Nid Photo</label>
                    <div id="nid_image">
                    <?php  if($nid_image!=null) {
                     ?>
                         <img src="../img/<?php echo $nid_image;?>" class="img-responsive" width="150px;" height="150px;">
                         <a  onclick="change('nid_image')" ><span style="color: red">|change</span></a>
                         <input type="hidden" class="form-control" value="<?php  echo $nid_image;?>" name="nid_image">
                     <?php   
                    }
                    else {
                        ?>
                        <input type="file"  class="form-control" name="nid_image" >
                        <?php
                    }
                    ?>
                    
                  </div>
                  </div>  
                  
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                  </div>
                </form>
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
    if(id=='image')
        var html='<input type="file"  class="form-control" name="image" >';
    if(id=='address')
        var html='<input type="text" class="form-control" value="<?php echo $address;?>" name="address">';
    if(id=='nid_no')
        var html='<input type="text" class="form-control" value="<?php echo $nid_no;?>" name="nid_no">';
    if(id=='nid_image')
        var html='<input type="file"  class="form-control" name="nid_image" >';
    $('#'+id).empty();
    $("#"+id).append(html);
    //document.getElementById('name').value="manik";
  }
</script>
</html>
