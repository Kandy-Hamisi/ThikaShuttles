<?php

include "../includes/dashboard-header.php";



// selecting the specific shuttle
$selShuttle = "SELECT * FROM shuttles WHERE shuttle_id = {$_GET['id']}";
$run = mysqli_query($mysqli, $selShuttle);
$r = mysqli_fetch_assoc($run);

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

// if (isset($_GET['id'])) {
    
    
//     // echo "<script>alert('it is set')</script>";
// }


if (isset($_GET['price'])) {
    $price = $_GET['price'];
    $seat_id = $_GET['seat'];
    $id = $_GET['id'];
    echo $price;
    echo $seat_id;

    
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
                            <h3 class="m-0 font-weight-bold text-primary"><?php echo $r['shuttle_no']; ?></h3>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $selSeats = "SELECT * FROM seats WHERE shuttle_id = {$_GET['id']}";
                                        $res = mysqli_query($mysqli, $selSeats);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Seat Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Seat Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                                            
                                            <tr>
                                                <td><?php echo $row['seat_no']; ?></td>
                                                <td><?php echo $row['seat_status']; ?></td>
                                                <td><a class="clicker" href="view-shuttle.php?id=<?php echo $_GET['id']; ?>&price=<?php echo $row['seat_price']; ?>&seat=<?php echo $row['seat_id']; ?>" id="selSeat"><i class="icofont-ui-check"></i></a></td>
                                            </tr>
                                        <?php endwhile ?>

                                    </tbody>
                                </table>
                                <div class="finalprice">
                                <?php echo (isset($_GET['price'])) ? $price : ""; ?>
                                    
                                    <div class="form">
                                        <form action="" method="POSt" class="meform">
                                            <div class="error-text text-small"></div>
                                            <input type="text" name="shuttleid" id="" value="<?php echo (isset($_GET['id'])) ? $id : ""; ?>" hidden>
                                            <input type="text" name="userid" id="" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                                            <input type="text" name="seatid" id="" value="<?php echo (isset($_GET['seat'])) ? $seat_id : ""  ?>" hidden>
                                            <input type="text" name="seatprice" id="" value="<?php echo (isset($_GET['price'])) ? $price : ""; ?>" hidden>
                                            <button class="btn btn-success" name="pay">Pay</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-shadow mb4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary"><?php echo $r['shuttle_no']; ?></h3>
                        </div>
                        <div class="card-body">
                            
                                <?php 
                                    $seats = array("B8", "C7", "A1", "B1");

                                    $ais = array("A", "B", "E", "C", "D");

                                    $aisle =  array("E1", "E2", "E3", "E4", "E5", "E6", "E7", "E8", "E9");;
                                    echo "<table border='1'>";
                                    // foreach ($ais as $i) {
                                    //     echo "<tr>";
                                    //     for ($r=0; $r <= 10 ; $r++) { 
                                    //         $seat = $i.$r;
                                    //         if (in_array($seat, $seats)) {
                                    //             $image = "<div class='booked'></div>";
                                    //         }elseif (!in_array($seat, $aisle)) {
                                    //             $image = "<div class='empty'></div>";
                                    //         }else {
                                    //             $image = "&nbsp;";
                                    //         }
                                    //         echo "<td>$image</td>";
                                    //     }
                                    //     echo "<tr>";
                                    // }
                                    echo "<tr>
                                        <td>Hello</td>
                                    </tr>";
                                    echo "<table>";
                                ?>
                            

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