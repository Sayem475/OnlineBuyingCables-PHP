

<!doctype html>
<html class="fixed">

<?php include 'includes\head.php';?>

<?php
include '../dbconfig.php';
$staff_id= $_SESSION['user_id'];

if(isset($_POST['status'])){
  $status=($_POST['status']+1)%2;
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql ="UPDATE `staff` SET `status`='$status' where `id`='$staff_id'";
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
        $status=$row['status'];
        

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
                <form action="status.php" method="POST">
                  
                <button class="button1" style="<?php if($status==0) echo ' background-color : red'?>"  name="status" value="<?php echo $status;?>">
                  <?php
                    if($status==1)
                      echo 'Click for Inactive';
                    else echo 'Click for Active';
                  ?>
                </button>
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

</html>
