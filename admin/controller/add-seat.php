<?php

include "../../dbConfig/config.php";


// getting form inputs
$shuttleid = mysqli_real_escape_string($mysqli, $_POST['shuttleid']);
$seatno = mysqli_real_escape_string($mysqli, $_POST['seatno']);
$price = mysqli_real_escape_string($mysqli, $_POST['price']);
$status = "Available";

if (!empty($shuttleid) && !empty($seatno) && !empty($price)) {
    
    // insert seat details
    $insert = "INSERT INTO seats(seat_no, seat_price, seat_status, shuttle_id)
        VALUES('$seatno', $price, '$status', $shuttleid)";
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