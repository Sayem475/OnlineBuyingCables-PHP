<?php include'include/header.php'; 

include 'dbconfig.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 30%;
  margin-bottom: 16px;
  padding: 0 8px;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}


</style>
   <!--banner-->

    <!--content-->

<div class="row" style="width:100%; padding-left:15%;">
  <?php
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->query("SELECT * FROM `shop_owner` "); 
        
          while ($row = $stmt->fetch()) {
    ?>
             
  <div class="column">
    <div class="card">
      <!-- <img src="/w3images/team1.jpg" alt="Jane" style="width:100%"> -->
      <div class="container" style="width: 100%; height: 400px; text-align: center;">
          <div style="height: 350px;">
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
              <tr>
                  <td>
                      <?php
                     try {
                    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt_rat = $db->prepare('SELECT AVG(rating) as avg_rat from rating inner join products on products.p_id=rating.product_id WHERE products.shop_id = :shop_id');
                    $stmt_rat->bindParam(':shop_id', $row['id']);
                    $stmt_rat->execute();
                    $r = $stmt_rat->fetch(PDO::FETCH_ASSOC);

                ?>
                   <p >Rating: 

                         <?php if($r['avg_rat'] == 0){
                            echo "5 (Not Rated yet)";
                        }else{
                            echo round($r['avg_rat'],2);
                        }
                     }catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                        ?>
                    </p>
                  </td>
              </tr>
              
            </table>          
          </div>
          <div>
            <p ><a href="index.php?id=<?php echo $row['id'] ;?>&shopname=<?php echo $row['shop_name']; ?>">
                <button class="button" >Show Products</button></a></p> 
          </div>
          
      </div>
    </div>
  </div>



          <?php
            }
          
        }catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
    ?>
</div>

<script type="text/javascript">
  function search(){
    var search= $("#search").val();
    $.post("searchshop.php", { search: search},
    function(data) {
        $(".row").empty();
        $(".row").append(data);
    });
  }
</script>
  
  <?php include'include/footer.php'; ?>