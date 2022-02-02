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
                    <h1 class="h3 mb-2 text-gray-800">Thika Shuttle | Admin</h1>
                    <p class="mb-4"> View System Content</p>

                    <!-- DataTables Test -->

                        
                    
                    <div class="card shadow mb-4" id="loan_status">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">List of Borrowers</h3>
                        </div>
                        <div class="card-body" >
                            <div class="cards-splitter">
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <h3>Users</h3>
                                        <h4>5</h4>
                                    </div>
                                </div>
                                <div class="card bg-warning">
                                    <div class="card-body">
                                        <h3>Users</h3>
                                        <h4>5</h4>
                                    </div>
                                </div>
                                <div class="card bg-primary">
                                    <div class="card-body">
                                        <h3>Users</h3>
                                        <h4>5</h4>
                                    </div>
                                </div>
                                <div class="card bg-info">
                                    <div class="card-body">
                                        <h3>Users</h3>
                                        <h4>5</h4>
                                    </div>
                                </div>
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