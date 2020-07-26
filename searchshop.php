<?php include 'dbconfig.php'; ?>

<?php
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['search'])){
        $location= $_POST['search'];
        $stmt = $conn->query("SELECT * FROM `shop_owner` where `address` LIKE '%$location%' "); 
        
while ($row = $stmt->fetch()) {
  ?>
  <div class="column">
    <div class="card">
      <!-- <img src="/w3images/team1.jpg" alt="Jane" style="width:100%"> -->
      <div class="container" style="width: 100%; height: 320px; text-align: center;">
          <div style="height: 260px;">
            <table>
              <tr>
                <th><h2 style="padding: 3%; "><?php echo $row['shop_name']; ?></h2></th>
              </tr>
              <tr>
                <td>
                <p>Location : <?php echo $row['address'];?></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Phone : <?php echo $row['phone'];?></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Email Address : <?php echo $row['email'];?></p>
                </td>
              </tr>
              
            </table>          
          </div>
          <div>
            <p ><a href="index.php?id=<?php echo $row['id'] ;?>">
                <button class="button" >Show Products</button></a></p> 
          </div>
          
      </div>
    </div>
  </div>

        <?php
          }
           

      }
        }catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
    ?>
