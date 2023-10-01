<?php 
include 'header.php'; 
$msg = "";
$err = "";


if(isset($_POST['approve'])){
	
}


if(isset($_POST['delete'])){
	
	$id = $_POST['id'];
	
$sql = "DELETE FROM subscribe WHERE id = '$id'";

if (mysqli_query($link, $sql)) {
    	$msg = "Deposit deleted successfully!";
	} else {
	    $err = "Deposit not deleted! ";
	}
}

if (isset($_POST['approve'])) {
	$email = $_POST['email'];
	$id = $_POST['id'];
	$status = $_POST['status'];
	$amount = $_POST['amount'];
	$method = $_POST['method'];

	if ($status == "Completed") {
		$msg = "This transaction has been completed already";
	}else{
		$tdate = date("Y-m-d");
		$query = mysqli_query($link, "UPDATE subscribe SET status = 'Completed' WHERE id = '$id' ");
		if ($query) {
			mysqli_query($link, "UPDATE users SET sub_balance = sub_balance + '$amount' WHERE email = '$email' ");
			$user = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' ");
			if (mysqli_num_rows($user) > 0) {
				$data = mysqli_fetch_assoc($user);
				$name = $data['fname']." ".$data['lname'];
			}
			$msg = "Subscription Deposit Approved Successfully";
			$subject = "Subscription Deposit Completed";
	        $body = "<h3>Hello ".$name.",</h3> <p>Your Subscription Deposit request of $".$amount." via ".$method." has been completed</p> ";
	        sendMail($email, $name, $subject, $body);
	        
		}else{
			echo mysqli_error($link);
		}
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
        echo pageRedirect("2", "subdeposit.php");
    }
    if ($err != "") {
        echo customAlert("error", $err);
    }

 ?>
			<div class="row">
			    <div class="col-lg-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title mb-0">All Deposits</h4>
			            </div><!-- end card header -->

			            <div class="card-body">
			                <div id="customerList">
			                    

			                    <div class="table-responsive table-card mt-3 mb-1">
			                    	<table id="myTable" class="table-responsive" >  
								        <thead class="table-light">
			                                <tr class="info">
			                         <th></th>
						<th>Email</th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
						
							<th>Amount(USD)</th>
                              <th>Status</th>
							 <th>Payment Method</th>
							 <th>Proof of payment</th>
							<th>Date</th>
                             <th>Action</th>

                                

						</tr>
			                            </thead>
								        <tbody>
					<?php $sql= "SELECT * FROM subscribe ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   


				  ?>

						<tr class="primary">
						<form action="subdeposit.php" method="post">
							<td></td>
                            <td><?php echo $row['email'];?></td>
							
							<td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="amount" value="<?php echo $row['usd'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="method" value="<?php echo $row['method'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="status" value="<?php echo $row['status'];?>"> </td>
							
							<td style="display:none;"><input type="hidden" name="id" value="<?php echo $row['id'];?>"> </td>
							
							
							<td>$<?php echo $row['usd'];?></td>
							<td>
								<?php 
									if ($row['status'] == "Pending") {
										echo '<button type="button" class="btn btn-warning">Pending</button>';
									}elseif ($row['status'] == "Completed") {
										echo '<button type="button" class="btn btn-success">Completed</button>';
									}
								 ?>

							</td>

							<td><?php echo $row['method'] ?></td>
							<td><a target="_blank" href="../user/proof/<?php echo $row['proof'] ?>"><img width="70" height="50" src="../user/proof/<?php echo $row['proof'] ?>"></a></td>
			  
                            <td><button class="btn btn-success" type="submit" name="approve"><span class="glyphicon glyphicon-check"> Approve</span></button></td>
							
							<td><button onclick="return confirm('Do you really want to delete')" class="btn btn-danger" type="submit" name="delete"><span class="glyphicon glyphicon-check"> Delete</span></button></td>
							
   
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