<?php 
include 'header.php'; 
$msg = "";
$err = "";


if(isset($_POST['delete'])){
	
	$tnx = $_POST['id'];
	
$sql = "DELETE FROM signals WHERE id ='$tnx'";

if (mysqli_query($link, $sql)) {
    $msg = "Signal deleted successfully!";
} else {
    $msg = "Signal not deleted! ";
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
        echo pageRedirect("2", "signals.php");
    }
    if ($err != "") {
        echo customAlert("error", $err);
    }

 ?>
			<div class="row">
			    <div class="col-lg-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title mb-0">All Signals</h4>
			            </div><!-- end card header -->

			            <div class="card-body">
			                <div id="customerList">
			                    

			                    <div class="table-responsive table-card mt-3 mb-1">
			                    	<table id="myTable" class="table-responsive" >  
								        <thead class="table-light">
			                                <tr class="info">
												<th>#</th>
												<th>Symbol</th>
												<th style="display:none;"></th>
												<th style="display:none;"></th>
												<th style="display:none;"></th>
												<th>Interval</th>
                             					<th>Unit</th>
												<th>Amount</th>
                                				<th>Direction</th>
                                 				<th>Action</th>
											</tr>
			                            </thead>
								        <tbody>
								        	<?php  
								        	$i = 0;
								        		$sql = mysqli_query($link, "SELECT * FROM signals ");
								        		if(mysqli_num_rows($sql) > 0){
								        			while ($row = mysqli_fetch_assoc($sql)) {
								        				$i++;
								        	?>
								        	<tr>
								        		<form method="post" action="signals.php">
								        			<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
									        		<td><?php echo $i; ?></td>
									        		<td><?php echo $row['symbol'] ?></td>
									        		<td><?php echo $row['t_interval'] ?></td>
									        		<td><?php echo $row['unit'] ?></td>
									        		<td><?php echo $row['amount'] ?></td>
									        		<td><?php echo $row['directions'] ?></td>
									        		<td><button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Confirm delete')">Delete</button></td>
									        	</form>
								        	</tr>
								        	<?php }
								        		} ?>
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