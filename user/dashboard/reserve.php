<?php

include "../includes/dashboard-header.php";


if (isset($_GET['update'])) {
    
    $id = $_GET['update'];
    $status = "Disbursed";

    // update query || approving the loan
    $disburse = "UPDATE borrowers SET approval_status = '$status' WHERE id = $id";
    $result = mysqli_query($mysqli, $disburse);
    if ($result) {
        header("Location: borrowers.php");
    }else{
        echo "<script>window.alert('Something went wrong');</script>";
    }
}

// if cancel icon is clicked

if (isset($_GET['cancel'])) {
    
    $id = $_GET['cancel'];
    $status = "Denied";

    // update query || approving the loan
    $disburse = "UPDATE borrowers SET approval_status = '$status' WHERE id = $id";
    $result = mysqli_query($mysqli, $disburse);
    if ($result) {
        header("Location: borrowers.php");
    }else{
        echo "<script>window.alert('Something went wrong');</script>";
    }
}

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
                            <h3 class="m-0 font-weight-bold text-primary">List of Available Shuttles</h3>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Shuttle Name</th>
                                            <th>Number of Seats</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Shuttle Name</th>
                                            <th>Number of Seats</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $selShuttle = "SELECT * FROM shuttles WHERE shuttle_status = 'Available'";
                                            $run = mysqli_query($mysqli, $selShuttle);

                                            // // selecting seats
                                            // $selSeats = "SELECT * FROM seats";
                                        ?>
                                        
                                        <?php while($ret = mysqli_fetch_assoc($run)): ?>
                                            <?php
                                                $selDriver = "SELECT fullname FROM drivers WHERE driver_id = {$ret['driver_id']}";
                                                $result = mysqli_query($mysqli, $selDriver);
                                                $row = mysqli_fetch_assoc($result);
                                                $drivername = $row['fullname'];

                                                // selecting seats
                                                $selSeats = "SELECT * FROM seats where shuttle_id = {$ret['shuttle_id']} AND seat_status = 'Booked'";
                                                $ans = mysqli_query($mysqli, $selSeats);

                                            ?>
                                            <tr>
                                                <td><?php echo $ret['shuttle_no']; ?></td>
                                                <td><?php echo $ret['shuttle_seats']; ?></td>
                                                <td><?php echo (mysqli_num_rows($ans) > 0) ? "Few Seats remaining" : $ret['shuttle_status']; ?></td>
                                                <td><a href="view-shuttle.php?id=<?php echo $ret['shuttle_id']; ?>"><i class="icofont-pen"></i></a></td>
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

    <script>
        const printBtn = document.querySelector(".printer-btn");
        const printPageAreA = (areaID) => {
            let printContent = document.querySelector(areaID);
            let WinPrint = window.open('', '', 'width=900, height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close()
            WinPrint.focus();loan_status
            WinPrint.print();
            WinPrint.close();
        }

        printBtn.onclick = () => {
            printPageAreA("#loan_status");
            alert("clicked");
        }
    </script>

</body>
</html>