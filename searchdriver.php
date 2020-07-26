<?php include 'dbconfig.php'; ?>

<?php
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['search'])){
        $location= $_POST['search'];
        $stmt = $conn->query("SELECT * FROM `staff` where `role`='driver' and `status`='1' and `address` LIKE '%$location%'"); 
        $count = $conn->query("SELECT count(*) FROM `staff` where `role`='driver' and `status`='1' and `address` LIKE '%$location%' ")->fetchColumn();
        if($count>0){
        while ($row = $stmt->fetch()) {
  ?>
          <div class="column">
            <div class="card" style="height: 320px;">
              <center><img src="img/<?php echo $row['image']; ?>" alt="" width= "128px" height= "128px" style="margin: 10px;">
              <div >
                <h2><?php echo $row['name'];?></h2>
                <p class="title">Phone No:</p>
                <p ><?php echo $row['phone'];?></p>
                <p class="title">Location:</p>
                <p ><?php echo $row['address'];?></p>
              </div>
              </center>
            </div>
          </div>
        <?php
          }
           }
          else {
            echo '<p><h2>No Electrician Is Active</h2></p>';
          }

      }
        }catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
    ?>
