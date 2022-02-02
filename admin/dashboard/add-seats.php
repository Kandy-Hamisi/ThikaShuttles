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
                            <h3 class="m-0 font-weight-bold text-primary">Add a Shuttle Vehicle</h3>
                        </div>
                        <div class="card-body" >
                            <div class="form-div">
                                
                                <form action="" method="POST" class="form">
                                    <div class="error-text"></div>
                                    <div class="form-group">
                                        <label for="">Shuttle Vehicle</label>
                                        <select name="shuttleid" id="" class="form-control">
                                            <option value="">Select Vehicle</option>
                                            <?php
                                                $seldriver = "SELECT * FROM shuttles";
                                                $run = mysqli_query($mysqli, $seldriver);

                                            ?>
                                            <?php while($ret = mysqli_fetch_assoc($run)): ?>
                                                <option value="<?php echo $ret['shuttle_id']; ?>"><?php echo $ret['shuttle_no']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Seat Number</label>
                                        <input type="text" name="seatno" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Seat Price</label>
                                        <input type="number" name="price" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">Add Shuttle</button>
                                    </div>
                                </form>
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
    <script src="../../JS/admin/addSeat.js"></script>
</body>
</html>