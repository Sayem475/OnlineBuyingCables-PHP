<html>

<?php  
include 'includes/head.php';
include '../dbconfig.php'; 

?>
<body>
	<section class="body">

	<!-- start: header -->
	<?php include 'includes\header.php'; ?>
	<!-- end: header -->

	<div class="inner-wrapper">
	    <!-- start: sidebar -->
	    <?php include 'includes\sidebar.php' ; ?>

	    <section role="main" class="content-body">
                <header class="page-header">
                    <table>
                        <tbody class="text-center">
                         
                            <tr>
                                <th>
                                    <h2>
                                        <?php 
                                        if(isset($_SESSION['usertype'])=='customers')
                                            {echo $_SESSION['name'];}
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
            
        	   <div class="form-group col-sm-6">
			    <label for="price">From date</label>
			    <input type="date" class="form-control" id="from_date" name="from_date">
			  </div>
			  <div class="form-group col-sm-6">
			    <label for="length">TO date</label>
			    <input type="date" class="form-control" id="to_date" name="to_date">
			  </div>
			  <div class="form-group col-sm-6">
			    <input type="submit" class="btn btn-info" onclick="history()" id="button" name="button">
			  </div>
			  
             <div id="history" class="col-sm-12" style="overflow-x:auto; -webkit-overflow-scrolling: touch;">

			</div>
       </section>
	</div>
</section>

</body>
<script type="text/javascript">
	function history(){
		var from_date= document.getElementById('from_date').value;
		var to_date= document.getElementById('to_date').value;
		//document.getElementById('mmm').value=to_date;
		$.post("../action/history.php", { from_date: from_date, to_date: to_date},
		    function(data) {
		   			$('#history').empty();
				    $('#history').append(data);
				   
		    });
	}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="js/bootstrap.min.js"></script>
</html>
