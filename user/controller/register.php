<?php

include "../../dbConfig/config.php";

// getting the form inputs

$fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
$lname = mysqli_real_escape_string($mysqli, $_POST['lname']);
$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
$contact = mysqli_real_escape_string($mysqli, $_POST['contact']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$idno = mysqli_real_escape_string($mysqli, $_POST['idno']);
$pwd1 = mysqli_real_escape_string($mysqli, $_POST['pwd1']);
$pwd2 = mysqli_real_escape_string($mysqli, $_POST['pwd2']);



// checking if fields are empty
if (!empty($fname) && !empty($lname) && !empty($gender) && !empty($contact) && !empty($email) && !empty($idno)) {
    
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
                $insert = "INSERT into customers(fname, lname, gender, national_id, email, contact, passcode)
                    VALUES('$fname', '$lname', '$gender', $idno, '$email', '$contact', '$pwd1')";
                
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