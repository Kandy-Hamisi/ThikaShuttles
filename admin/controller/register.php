<?php

include "../../dbConfig/config.php";

// getting the form inputs

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$pwd1 = mysqli_real_escape_string($mysqli, $_POST['pwd1']);
$pwd2 = mysqli_real_escape_string($mysqli, $_POST['pwd2']);



// checking if fields are empty
if (!empty($username) && !empty($email) && !empty($pwd1) && !empty($pwd2)) {
    
    // checking if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $checkQuery = "SELECT email from customers WHERE email = '$email'";
        $run = mysqli_query($mysqli, $checkQuery);

        // if the email exists
        if (mysqli_num_rows($run) > 0) {
            echo "$email - already exists";
        }else {

            // checking if the two passwords match
            if ($pwd1 === $pwd2) {
                
                // inserting the details into the database
                $insert = "INSERT into admins(username, email, passcode)
                    VALUES('$username', '$email', '$pwd1')";
                
                $runQuery = mysqli_query($mysqli, $insert);
                if ($runQuery) {
                    echo "Success";
                }else {
                    printf("Error: %s\n ", mysqli_error($mysqli));
                }

            }else {
                echo "The two passwords don't match";
            }
        }
    }else {
        echo "$email - is not a valid email";
    }
} else {
    echo "All fields are required";
}

?>