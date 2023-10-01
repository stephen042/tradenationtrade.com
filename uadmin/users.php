<?php 
include 'header.php'; 
$msg = "";
$err = "";

if (isset($_POST['p_bar'])) {
	$data = $_POST['p_bar_status'];
	$userId = $_POST['id'];
	$result = mysqli_query($link, "UPDATE users SET p_bar_status = '$data' WHERE id = '$userId' ");
	if ($result) {
		$msg = "Progress status updated successfully!";
	}else{
		$err = "Progress status not updated! ";
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
			echo pageRedirect("2", "users.php");
		}
		if ($err != "") {
			echo customAlert("error", $err);
		}

 	?>

			<div class="row">
			    <div class="col-lg-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title mb-0">All Users</h4>
			            </div><!-- end card header -->

			            <div class="card-body">
			                <div id="customerList">
			                    

			                    <div class="table-responsive table-card mt-3 mb-1">
			                    	<table id="myTable" class="table-responsive table" >  
								        <thead class="table-light">
			                                <tr>
			                                	<td></td>
			                                    <th>User Name</th>
												<th>Email</th>
												<td></td>
												<th>Account Type</th>
												<th>Balance</th>
												<th>Gender</th>
												<th>Country</th>
												<th>Progress_bar</th>
												<th>Verification</th>
												<th>Date</th>
												<th>ACTION</th>
                                             	<th>ACTION</th>
                                                <!-- <th>ACTION</th> -->
			                                </tr>
			                            </thead>
								        <tbody>  
								          <?php $sql= "SELECT * FROM users ORDER BY id DESC";
											  $result = mysqli_query($link,$sql);
											  if(mysqli_num_rows($result) > 0){
												  while($row = mysqli_fetch_assoc($result)){  
												  
												  	$verify = $row['verify'];
												  ?>
				                    	 <tr>
				                    	<form action="users.php" method="post">
				                    		<td></td>
								            <td><?php echo $row['fname']." ".$row['lname'];?></td>
											<td id="email"><?php echo $row['email'];?></td>
											<td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
											<td></td>
											<td><?php echo $row['account_type'] ?></td>
											<td>$<?php echo $row['balance'] ?></td>
											<td><?php echo $row['gender'] ?></td>
				              				<td><?php echo $row['country'] ?></td>
				              				<td>
				              					<form method="post">
				              						<input type="number" name="p_bar_status" value="<?php echo $row['p_bar_status'];?>">
				              						<input type="hidden" name="id" value="<?php echo $row['id'];?>">
													  <button type="submit" name="p_bar" class="btn m-1 btn-primary btn-sm">submit</button>
												</form>
											</td>
				              				<td>
				              					<?php 
				              						if ($verify == 0) {
				  										echo '<button type="button" class="btn btn-danger">Not Verified</button>';
				              						}elseif ($verify == 1) {
				              							echo '<button type="button" class="btn btn-success">Verified</button>';
				              						}elseif ($verify == 2) {
				              							echo '<button type="button" class="btn btn-warning">Pending</button>';
				              						}

				              					?>

				              				</td>
				              				<td><?php echo $row['date'];?></td>
				              				<td> <a href="user-edit.php?email=<?php echo $row['email']?>"> 
                                            <button type="button" name="edit" style="width:100%" class="btn btn-primary"><span class="fa fa-check">-Edit- </span></button></a></td>
                                            
                                           <td><button type="submit" onclick="return confirm('Do you want to delete this account')" name="delete" style="width:100%" class="btn btn-danger"><span class="fas fa-trash">-Delete- </span></button></td>
                                           
                                            <!-- <td> <a href="views.php?email=<?php echo $row['email']?>"> 
                                            <button type="button" name="view" style="width:100%" class="btn btn-primary"><span class="fa fa-eye">-View </span></button></a></td> -->
							  
				                           
											
							    <!--<td><button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"> Delete</span></button></td>-->
							</form>
							</tr>
                        <?php }} ?>
								           
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