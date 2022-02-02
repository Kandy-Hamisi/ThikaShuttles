<?php

include "../includes/dashboard-header.php";




?>
<body id="page-top">
    
    <!-- Page wrapper -->
    <div id="wrapper">

        <!-- including the page sidebar -->
        <?php include_once "../../sb/partials/sidebar.php"; ?>

        <!-- Content-wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            
                <!-- including the topbar/navbar -->
                <?php include_once "../../sb/partials/navbar.php"; ?>
            

                <!-- Beginning Page Content -->
                <div class="container-fluid">
                    <!-- page heading -->
                    <h1 class="h3 mb-2 text-gray-800">Thika Shuttle | Admin</h1>
                    <p class="mb-4"> View System Content</p>

                    <!-- DataTables Test -->

                        
                    
                    <div class="card shadow mb-4" id="loan_status">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">List of Registered Customers</h3>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>Shuttle Name</td>
                                            <td>Shuttle Status</td>
                                            <td>Number of Seats</td>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td>Shuttle Name</td>
                                            <td>Shuttle Status</td>
                                            <td>Number of Seats</td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $selCust = "SELECT * FROM shuttles";
                                            $run = mysqli_query($mysqli, $selCust);

                                            // // selecting seats
                                            // $selSeats = "SELECT * FROM seats";
                                        ?>
                                        
                                        <?php while($ret = mysqli_fetch_assoc($run)): ?>
                                            
                                            <tr>
                                                <td><?php echo $ret['shuttle_no']?></td>
                                                <td><?php echo $ret['shuttle_status']; ?></td>
                                                <td><?php echo $ret['shuttle_seats']; ?></td>
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

    

</body>
</html>