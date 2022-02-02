<?php

include "../../dbConfig/config.php";


// getting form inputs
$drivername = mysqli_real_escape_string($mysqli, $_POST['drivername']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$contact = mysqli_real_escape_string($mysqli, $_POST['contact']);

if (!empty($drivername) && !empty($email) && !empty($contact)) {
    

    // lets check the email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // checking if the email already exists
        $checkQuery = "SELECT email from drivers WHERE email = '$email'";
        $run = mysqli_query($mysqli, $checkQuery);

        // if the email exists
        if (mysqli_num_rows($run) > 0) {
            echo "$email - already exists";
        } else {

            // inserting the details into the database
            $insert = "INSERT INTO drivers(fullname, contact, email)
                VALUES('$drivername', '$contact', '$email')";
            $run = mysqli_query($mysqli, $insert);

            if ($run) {
                echo "Success";
            } else {
                printf("Error: %s\n", mysqli_error($mysqli));
            }

        }
    } else {
        echo "$email - is not a valid email";
    }
} else {
    echo "All fields are required";
}


?>