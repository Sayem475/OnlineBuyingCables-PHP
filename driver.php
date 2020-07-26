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
  padding: 0px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 33%;
}

.button:hover {
  background-color: #555;
}
</style>
   <!--banner-->

    <!--content-->
 
<div class="row" style="width:80%; padding-left:15%;">
  <?php
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->query("SELECT * FROM `staff` where `role`='driver' and `status`='1' "); 
        $count = $conn->query("SELECT count(*) FROM `staff` where `role`='driver' and `status`='1' ")->fetchColumn();
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
        }catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
    ?>
</div>
<script type="text/javascript">
  function search(){
    var search= $("#search").val();
    $.post("searchdriver.php", { search: search},
    function(data) {
        $(".row").empty();
        $(".row").append(data);
    });
  }
</script>
        
  <?php include'include/footer.php'; ?>