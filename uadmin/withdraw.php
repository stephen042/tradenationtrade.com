<?php 
include 'header.php'; 
$msg = "";
$err = "";

if(isset($_POST['complete'])){
	
	$tnx = $_POST['id'];
	$moni = $_POST['moni'];
	$email = $_POST['email'];

	$sql2 = "SELECT * FROM wbtc WHERE id = '$tnx'";
	$result2 = mysqli_query($link,$sql2);
	if(mysqli_num_rows($result2) > 0){
		$row = mysqli_fetch_assoc($result2);
		$status = $row['status'];
	}
	
	if ($status == "Completed") {
		$msg = "This transaction has been completed already";
	}else{
		$wwq = mysqli_query($link, "UPDATE wbtc SET status = 'Completed'  WHERE id = '$tnx'");
		if ($wwq) {
			$sqlus = "SELECT * FROM users WHERE email = '$email'";
	  		$resultus = mysqli_query($link, $sqlus);
	  		if(mysqli_num_rows($resultus) > 0){
	   			$rowus = mysqli_fetch_assoc($resultus);
	   			$name = $rowus['fname']." ".$rowus['lname'];
	  		}
	  		$msg = "Withdrawal Completed Succesfully";
	        $subject = "Withdrawal Completed";
	        $body = "<h3>Hello ".$name.",</h3> <p>Your withdrawal request $".$amount." has been completed</p> ";
	        sendMail($email, $name, $subject, $body);
		}
		
	}

	  
	 

}



if(isset($_POST['delete'])){
	
	$tnx = $_POST['id'];
	
$sql = "DELETE FROM wbtc WHERE id ='$tnx'";

if (mysqli_query($link, $sql)) {
    $msg = "Order deleted successfully!";
} else {
    $msg = "Order not deleted! ";
}
}

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  

  <link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.jqueryui.min.css">



  

  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="">
 
  

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.jqueryui.min.js"></script>
   
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<style>
.table-responsive {
overflow-x: hidden;
}
@media (max-width: 8000px) {
.table-responsive {
overflow-x: auto;
}
</style>
<div class="page-content">
    <div class="container-fluid">
<?php 
    if ($msg != "") {
        echo customAlert("success", $msg);
        echo pageRedirect("2", "withdraw.php");
    }
    if ($err != "") {
        echo customAlert("error", $err);
    }

 ?>
			<div class="row">
			    <div class="col-lg-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title mb-0">All Withdrawals</h4>
			            </div><!-- end card header -->

			            <div class="card-body">
			                <div id="customerList">
			                    

			                    <div class="table-responsive table-card mt-3 mb-1">
			                    	<table id="myTable" class="table-responsive" >  
								        <thead class="table-light">
			                                <tr class="info">
												<th>Email</th>
						<th>Wallet address</th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
			
							<th>Amount</th>
                         
                             <th>Status</th>
							<th>Date</th>
                                <th>Action</th>
                                 <th>Action</th>

											</tr>
			                            </thead>
								        <tbody>
					<?php $sql= "SELECT * FROM wbtc ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   

$row['status'];
   
   
if(isset($row['status']) &&  $row['status']== 'completed'){
	
	
	$sec = 'Completed &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-check" ></i>';

}else{
$sec ='Pending &nbsp;&nbsp;<i class="fa  fa-refresh" style=" font-size:20px;color:red"></i>';

}


				  ?>

						<tr class="primary">
						<form action="withdraw.php" method="post">
						
                          <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['wal'];?></td>
						  
						  <td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="moni" value="<?php echo $row['moni'];?>"> </td>
							
							<td style="display:none;"><input type="hidden" name="id" value="<?php echo $row['id'];?>"> </td>
						  
							<td>$<?php echo $row['moni'];?></td>
				
							<td><?php echo $sec ;?></td>
              
              <td><?php echo $row['date'];?></td>
			  
                             <td><button class="btn btn-primary" type="submit" name="complete" ><span class="glyphicon glyphicon-check"> complete</span></button></td>
							
    <td><button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"> Delete</span></button></td>
</form>


						</tr>
					  <?php
 }
			  }
			  ?>
					</tbody>

								      </table>  

			                        
			                    </div>


			                </div>
			            </div><!-- end card -->
			        </div>
			        <!-- end col -->
			    </div>
			    <!-- end col -->
			</div>
			<!-- end row -->


	</div>
</div>
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>

<?php include 'footer.php'; ?>