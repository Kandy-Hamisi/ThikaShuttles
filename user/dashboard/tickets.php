<?php

include "../includes/dashboard-header.php";

?>
<body id="page-top">
    
    <!-- Page wrapper -->
    <div id="wrapper">

        <!-- including the page sidebar -->
        <?php include_once "partials/sidebar.php"; ?>

        <!-- Content-wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            
                <!-- including the topbar/navbar -->
                <?php include_once "partials/navbar.php"; ?>
            

                <!-- Beginning Page Content -->
                <div class="container-fluid">
                    <!-- page heading -->
                    <h1 class="h3 mb-2 text-gray-800">Thika Shuttle | User</h1>
                    <p class="mb-4"> View System Content</p>

                    <!-- DataTables Test -->

                        
                    
                    <div class="card shadow mb-4" id="loan_status">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">View Payments</h3>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $selSeats = "SELECT * FROM payments WHERE customer_id = {$_SESSION['user_id']}";
                                        $res = mysqli_query($mysqli, $selSeats);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Seat Name</th>
                                            <th>Seat Price</th>
                                            <th>Shuttle Name</th>
                                            <th>Payment Date</th>
                                            <th>View Ticket</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Seat Name</th>
                                            <th>Seat Price</th>
                                            <th>Shuttle Name</th>
                                            <th>Payment Date</th>
                                            <th>View Ticket</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                                            <?php
                                                // selecting seat name
                                                $seatSel = "SELECT * FROM seats WHERE shuttle_id = {$row['shuttle_id']} AND seat_status = 'Booked'";
                                                $ans = mysqli_query($mysqli, $seatSel);
                                                $r = mysqli_fetch_assoc($ans);
                                                $seatname = $r['seat_no'];
                                                $price = $r['seat_price'];


                                                // select shuttle
                                                $selShut = "SELECT * FROM shuttles WHERE shuttle_id = {$row['shuttle_id']}";
                                                $ret = mysqli_query($mysqli, $selShut);
                                                $line = mysqli_fetch_assoc($ret);
                                                $shuttlename = $line['shuttle_no'];
                                            ?>
                                            
                                            <tr>
                                                <th><?php echo $seatname; ?></th>
                                                <th><?php echo $price; ?></th>
                                                <th><?php echo $shuttlename; ?></th>
                                                <th><?php echo $row['payment_date']; ?></th>
                                                <th><a href="print.php?payid=<?php echo $row['payment_id']; ?>" class="btn btn-primary">View Ticket</a></th>
                                            </tr>
                                        <?php endwhile ?>

                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                    

                </div>

            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View The Interest, Overdue and final payments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="body-splitter" style="display:flex; justify-content: space-between; align-items: center;">
                        <div class="guaranter-details">
                            <ul>
                                <li class="first">Guaranter's Name: <span></span></li>
                                <li class="second">Guaranter's ID: <span></span></li>
                                <li class="third">Ward: <span></span></li>
                                <li class="fourth">Residence: <span></span></li>
                            </ul>
                        </div>
                        <div class="loan-details">
                            <ul>
                                <li class="uno">Loan Amount: <span></span></li>
                                <li class="dos">Interest Rate: <span></span></li>
                                <li class="tres">Overdue Rate: <span></span></li>
                                <li class="quatro">Payment: <span></span></li>
                                <li class="quince">Payment per Month: <span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                
            </div>
        </div>
    </div>
    

    

    <script>
        $(document).ready( function () {
    $('#dataTable').DataTable();
} );

    </script>

    <script src="../../JS/user/mpesa.js"></script>

</body>
</html>