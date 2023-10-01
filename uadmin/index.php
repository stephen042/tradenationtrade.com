<?php 
include 'header.php';

include "investors_query.php";

?>
<div class="page-content">
    <div class="container-fluid">


		<div class="row">
	        <div class="col-md-6">
	            <div class="card card-animate">
	                <div class="card-body">
	                    <div class="d-flex justify-content-between">
	                        <div>
	                            <p class="fw-medium text-muted mb-0">Total Investors</p>
	                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="" ><?php echo $total;?></span></h2>
	                        </div>
	                        <div>
	                            <div class="avatar-sm flex-shrink-0">
	                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
	                                    <i data-feather="users" class="text-info"></i>
	                                </span>
	                            </div>
	                        </div>
	                    </div>
	                </div><!-- end card body -->
	            </div> <!-- end card-->
	        </div> <!-- end col-->

	        <div class="col-md-6">
	            <div class="card card-animate">
	                <div class="card-body">
	                    <div class="d-flex justify-content-between">
	                        <div>
	                            <p class="fw-medium text-muted mb-0">Total Invested</p>
	                            <h2 class="mt-4 ff-secondary fw-semibold">$<span class="" ><?php echo $total1 ;?></span></h2>
	                            
	                        </div>
	                        <div>
	                            <div class="avatar-sm flex-shrink-0">
	                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
	                                    <i class="ri-arrow-left-down-fill text-info"></i>
	                                </span>
	                            </div>
	                        </div>
	                    </div>
	                </div><!-- end card body -->
	            </div> <!-- end card-->
	        </div> <!-- end col-->
        </div> <!-- end row-->

        <div class="row">

	        <div class="col-md-6">
	            <div class="card card-animate">
	                <div class="card-body">
	                    <div class="d-flex justify-content-between">
	                        <div>
	                            <p class="fw-medium text-muted mb-0">Requested Withdrawal</p>
	                            <h2 class="mt-4 ff-secondary fw-semibold">$<span class="" ><?php echo $total3;?></span></h2>
	                        </div>
	                        <div>
	                            <div class="avatar-sm flex-shrink-0">
	                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
	                                    <i class="text-info ri-arrow-right-up-line"></i>
	                                </span>
	                            </div>
	                        </div>
	                    </div>
	                </div><!-- end card body -->
	            </div> <!-- end card-->
	        </div> <!-- end col-->

	       	<div class="col-md-6">
	            <div class="card card-animate">
	                <div class="card-body">
	                    <div class="d-flex justify-content-between">
	                        <div>
	                            <p class="fw-medium text-muted mb-0">Total Amount Withdrawn</p>
	                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="" data-target="">$<?php echo round($withdraw,2);?></span></h2>
	                        </div>
	                        <div>
	                            <div class="avatar-sm flex-shrink-0">
	                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
	                                    <i  class="text-info ri-arrow-go-back-line"></i>
	                                </span>
	                            </div>
	                        </div>
	                    </div>
	                </div><!-- end card body -->
	            </div> <!-- end card-->
	        </div> <!-- end col-->

	        <div class="col-md-6">
	            <div class="card card-animate">
	                <div class="card-body">
	                    <div class="d-flex justify-content-between">
	                        <div>
	                            <p class="fw-medium text-muted mb-0">Total Amount deposited</p>
	                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="" data-target="">$<?php echo round($deposit,2);?></span></h2>
	                        </div>
	                        <div>
	                            <div class="avatar-sm flex-shrink-0">
	                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
	                                    <i  class="text-info ri-arrow-go-back-line"></i>
	                                </span>
	                            </div>
	                        </div>
	                    </div>
	                </div><!-- end card body -->
	            </div> <!-- end card-->
	        </div> <!-- end col-->
        </div> <!-- end row-->


    </div>
</div>

<?php 
include 'footer.php';
?>