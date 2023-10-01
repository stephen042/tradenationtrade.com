<?php 
include 'header.php'; 
$msg = "";
$err = "";


if(isset($_POST['approve'])){
	$status = $_POST['status'];
	$plan_id = $_POST['plan_id'];
	$email = $_POST['email'];
	$pname = $_POST['pname'];
	$name = $_POST['name'];
	$id = $_POST['id'];
	$max = $_POST['max'];
	$min = $_POST['min'];

	if ($status == "Approved") {
		$err = "Request Approved Already";
	}else{
		$update = mysqli_query($link, "UPDATE package_request SET status = 'Approved' WHERE id = '$id' ");
		if ($update) {
			$subject = "Trading Plan Accepted";
			$body = "<h4>Hello ".$name."</h4> <p>We write to inform you that your requested trading plan has been accepted. Trading plan information is as follows: </p> <p>Type : <strong>".$pname." USD</strong> </p> <p>Minimum Deposit : <strong>".$min."</strong> </p>  <p>Maximum Deposit : <strong>".$max." USD</strong> </p> <center> <a href=".$siteurl.">Continue Trading</a></center> ";
			sendMail($email, $name, $subject, $body);
			$msg = "Plan Request Approved Already";
		}
	}
}


if(isset($_POST['delete'])){
	
	$id = $_POST['id'];
	
$sql = "DELETE FROM package_request WHERE id = '$id'";

if (mysqli_query($link, $sql)) {
    $msg = "Deposit deleted successfully!";
} else {
    $msg = "Deposit not deleted! ";
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
        echo pageRedirect("2", "plan_request.php");
    }
    if ($err != "") {
        echo customAlert("error", $err);
    }

 ?>
			<div class="row">
			    <div class="col-lg-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title mb-0">All Package Request</h4>
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
							<th>User Name</th>
							<th>Plan Name</th>
                              <th>Status</th>
							 
							<th>Date</th>
                             <th>Action</th>

                                

						</tr>
			                            </thead>
								        <tbody>
					<?php $sql= "SELECT * FROM package_request ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   
				  	$email = $row['email'];
				  	$pid = $row['plan_id'];
				  	$id = $row['id'];
				  	$user = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' ");
				  	if (mysqli_num_rows($user) > 0) {
				  		$data = mysqli_fetch_assoc($user);
				  		$name = $data['fname']." ".$data['lname'];

				  	}
				  	$plan = mysqli_query($link, "SELECT * FROM package1 WHERE id = '$pid' ");
				  	if (mysqli_num_rows($plan) > 0) {
				  		$pdata = mysqli_fetch_assoc($plan);
				  		$pname = $pdata['pname'];
				  		$min = $pdata['froms'];
				  		$max = $pdata['tos'];

				  	}

				  ?>

						<tr class="primary">
						<form action="plan_request.php" method="post">
							<input type="hidden" name="plan_id" value="<?php echo $pid ?>">
							<input type="hidden" name="email" value="<?php echo $email ?>">
							<input type="hidden" name="name" value="<?php echo $name ?>">
							<input type="hidden" name="pname" value="<?php echo $pname ?>">
							<input type="hidden" name="status" value="<?php echo $status ?>">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="hidden" name="min" value="<?php echo $min ?>">
							<input type="hidden" name="max" value="<?php echo $max ?>">
							<td></td>
							<td><?php echo $email ?></td>
							<td><?php echo $name ?></td>
							<td><?php echo $pname ?> Package</td>
							<td><?php echo $row['status'] ?></td>
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