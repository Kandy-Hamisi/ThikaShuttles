<?php

include "../../dbConfig/config.php";

// getting form details
$shuttleno = mysqli_real_escape_string($mysqli, $_POST['shuttleno']);
$seats = mysqli_real_escape_string($mysqli, $_POST['seats']);
$driverID = mysqli_real_escape_string($mysqli, $_POST['driver']);
$status = "Available";

if (!empty($shuttleno) && !empty($seats) && !empty($driverID)) {
    
    // insert the details into the database
    $insert = "INSERT INTO shuttles(shuttle_no, shuttle_status, shuttle_seats, driver_id)
        VALUES('$shuttleno', '$status', $seats, $driverID)";
    $run = mysqli_query($mysqli, $insert);

    if ($run) {
        echo "Success";
    } else {
        printf("Error: %s\n", mysqli_error($mysqli));
    }
} else {
    echo "All fields are required";
}



?>