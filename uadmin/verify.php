<?php 
include 'header.php';

$msg = $err = "";

// verify investor

if(isset($_POST['verify'])){
	
	$email = $_POST['email'];
	$username = $_POST['name'];
	
$sql = "UPDATE users SET verify = '1'  WHERE email='$email'";

if (mysqli_query($link, $sql)) {
    $msg = "User verified successfully!";
    $subject = "Account Verified";
     $body = "<h5>Account Verified</h5> <h3>Hello ".$username.",</h3> <p>Your account has been verified.</p> ";
     sendMail($email, $username, $subject, $body);
} else {
    $msg = "User  was not verified! ";
}
}






// unverify investors

if(isset($_POST['unverify'])){
	
	$email = $_POST['email'];
	$username = $_POST['name'];
	
$sql = "UPDATE users SET verify = '0'  WHERE email='$email'";

if (mysqli_query($link, $sql)) {
    $msg = "User Un-verified successfully!";
    $msg = "User verified successfully!";
    $subject = "Account Not Verified";
     $body = "<h5>Account Not Verified</h5> <h3>Hello ".$username.",</h3> <p>Your account was not verified.</p> ";
     sendMail($email, $username, $subject, $body);
} else {
    $msg = "User  was not Un-verified! ";
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
        echo pageRedirect("2", "verify.php");
    }
    if ($err != "") {
        echo customAlert("error", $err);
    }

 ?>
			<div class="row">
			    <div class="col-lg-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title mb-0">Verify Users</h4>
			            </div><!-- end card header -->
			            <div class="card-body">
			                <div id="customerList">
			                    

			                    <div class="table-responsive table-card mt-3 mb-1">
			                    	<table id="myTable" class="table-responsive" >  
								        <thead class="table-light">
			                                <tr class="info">
							<th>Username</th>
							<th>Email</th>
							<th style="display:none;"></th>
							<th>Verification ID</th>
                            <th>Verification Photo</th>
							<th>Action</th>
                            <th>Action</th>
                                 
                                

						</tr>
			                            </thead>
								        <tbody>
					<?php $sql= "SELECT * FROM users WHERE verify = 2 ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  

				  $image_part = "../user/verify/".$row['id_image']."";

				  ?>
				
						<tr class="primary">
						<form action="verify.php" method="post">
						<td><?php echo $row['fname']." ".$row['lname'];?></td>
							<td id="email"><?php echo $row['email'];?></td>
							<td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
							<input type="hidden" name="name" value="<?php echo $row['fname']." ".$row['lname'];?>">
                           <td><?php echo $row['id_type'] ?></td>
                           <td>
                            	<a target="_blank" href="<?php echo $image_part?>"><img height="50" width="70" src="<?php echo  $image_part?>"></a> 
                            </td>
			  
                            <td><button class="btn btn-success" type="submit" name="verify"><span class="glyphicon glyphicon-check"> Verify</span></button></td>
							<td><button class="btn btn-danger" type="submit" name="unverify"><span class="glyphicon glyphicon-check">  Un-verify</span></button></td>
							
    
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