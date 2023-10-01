<?php
include 'header.php';
$msg = "";
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">ALL TRADES FOR CLIENTS</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">


                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="myTable" class="table-responsive table table-striped table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <td>S/N</td>
                                            <th>User Email</th>
                                            <th>Amount Staked</th>
                                            
                                            <th>Symbol</th>
                                            <th>Units</th>
                                            <th>Trade_interval</th>
                                            
                                            <th>market</th>
                                            <th>Profit</th>
                                            <th>status</th>
                                            <th>start_time</th>
                                            <th>end_time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $all_trades = mysqli_query($link, "SELECT * FROM trade ORDER BY id DESC ");
                                        if (mysqli_num_rows($all_trades) > 0) {
                                            while ($data = mysqli_fetch_assoc($all_trades)) {
                                                $trade_set = date('d-m-Y H:i', strtotime($data['trade_set']));
                                                $trade_exp = date('d-m-Y H:i', strtotime($data['trade_exp']));
                                                if ($data['status'] == 1) {
                                                    $status = 'trade in progress';
                                                }elseif ($data['status'] == 2 && $data['win_loss'] == 0) {
                                                    $status = 'loss';
                                                }elseif ($data['status'] == 3 && $data['win_loss'] == 1) {
                                                    $status = 'win';
                                                }
                                                echo "<tr>";
                                                echo "<td>" . $data['id'] . "</td>";
                                                echo "<td>" . $data['email'] . "</td>";
                                                echo "<td>" . $data['amount'] . "</td>";
                                                echo "<td>" . $data['symbol'] . "</td>";
                                                echo "<td>" . $data['units'] . "</td>";
                                                echo "<td>" . $data['trade_interval'] . "</td>";
                                                echo "<td>" . $data['market'] . "</td>";
                                                echo "<td>" . $data['profit'] . "</td>";
                                                echo "<td>" . $status. "</td>";
                                                echo "<td>" . $trade_set . "</td>";
                                                echo "<td>" . $trade_exp . "</td>";
                                                echo "</tr>";
                                            }
                                        };
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
    $(document).ready(function() {
        $('#myTable').dataTable();
    });
</script>

<?php include 'footer.php'; ?>