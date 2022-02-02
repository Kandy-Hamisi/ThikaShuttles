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
                            <h3 class="m-0 font-weight-bold text-primary">View Hired Shuttles</h3>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $selSeats = "SELECT * FROM hirings WHERE customer_id = {$_SESSION['user_id']}";
                                        $res = mysqli_query($mysqli, $selSeats);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Shuttle Price</th>
                                            <th>Shuttle Name</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Shuttle Price</th>
                                            <th>Shuttle Name</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                                            <?php
                                                // selecting seat name
                                                // $seatSel = "SELECT * FROM shuttle WHERE shuttle_id = {$row['shuttle_id']} AND seat_status = 'Booked'";
                                                // $ans = mysqli_query($mysqli, $seatSel);
                                                // $r = mysqli_fetch_assoc($ans);
                                                // $seatname = $r['seat_no'];
                                                // $price = $r['seat_price'];


                                                // select shuttle
                                                $selShut = "SELECT * FROM shuttles WHERE shuttle_id = {$row['shuttle_id']}";
                                                $ret = mysqli_query($mysqli, $selShut);
                                                $line = mysqli_fetch_assoc($ret);
                                                $shuttlename = $line['shuttle_no'];
                                            ?>
                                            
                                            <tr>
                                                <th><?php echo $row['price']; ?></th>
                                                <th><?php echo $shuttlename; ?></th>
                                                <th><?php echo $row['hiring_date']; ?></th>
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

    
    

    

    <script>
        $(document).ready( function () {
    $('#dataTable').DataTable();
} );

    </script>

    <script src="../../JS/user/mpesa.js"></script>

</body>
</html>