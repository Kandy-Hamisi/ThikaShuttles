<?php
session_start();

include "../../dbConfig/config.php";


// getting the payment details
$price = mysqli_real_escape_string($mysqli, $_POST['seatprice']);
$seatid = mysqli_real_escape_string($mysqli, $_POST['seatid']);
$userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
$shuttleid = mysqli_real_escape_string($mysqli, $_POST['shuttleid']);




if (!empty($price)) {
    $url = "https://7c01-197-232-61-207.ngrok.io";
    function generateToken(){
        $consumerKey='pjIhT9HvDvIwfAHiXjkv1wZJWIuTf1kf';
        $consumerSecret='b4kN7Lh47TlsRkyc';
        $credentials = base64_encode($consumerKey.':'.$consumerSecret);
        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic '.$credentials]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $json_decode=json_decode($response);
        $access_token=$json_decode->access_token;
        return $access_token;
    }
    
    
    function customerMpesaSTKPush()
        {
            date_default_timezone_set("Africa/Nairobi");
            $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $BusinessShortCode='174379';
            $Timestamp=date('YmdHis');
            $PartyA='254795924576';
            //$PartyA='254711601532';
            $CallBackURL='https://sandbox.safaricom.co.ke/mpesa/';
            //$CallBackURL=$url;
            $AccountReference='Thika Shuttle';
            $TransactionDesc='Thika Shuttle Price';
            $Amount=1;
            $Passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";//test passkey for daraja sandbox apps
            $Password=base64_encode($BusinessShortCode.$Passkey.$Timestamp);
            $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
    
            #create an array to be converted to JSON
            $curl_post_data = array(
                //Fill in the request parameters with valid values
                'BusinessShortCode' => $BusinessShortCode,
                'Password' =>$Password,
                'Timestamp' => $Timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' =>$Amount,
                'PartyA' =>$PartyA,
                'PartyB' =>$BusinessShortCode,
                'PhoneNumber' =>$PartyA,
                'CallBackURL' =>$CallBackURL,
            // 'CallBackURL' => 'https://ip_address:port/callback',
                'AccountReference' =>$AccountReference,
                'TransactionDesc' =>$TransactionDesc,
            );
    
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer '.generateToken() ,
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            $data_string = json_encode($curl_post_data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
            $response     = curl_exec($ch);
            
            $json_decode=json_decode($response);
            curl_close($ch);
            return $json_decode->ResponseCode;
            sleep(15);
        }
    
        
        // if ($r == 0) {
            // echo "Success";
            // check if the selected seat is already booked
            $checkSeat = "SELECT * FROM seats WHERE seat_id = $seatid AND seat_status = 'Booked'";
            $checker = mysqli_query($mysqli, $checkSeat);
            
            // if seat is booked
            if (mysqli_num_rows($checker) > 0) {
                echo "Seat is alredy booked";
            } else {

                // book seat
                $updateSeat = "UPDATE seats SET seat_status = 'Booked' WHERE seat_id = $seatid AND shuttle_id = $shuttleid ";
                $updator = mysqli_query($mysqli, $updateSeat);

                if ($updator) {
                    
                    // lets add the details into the booking table
                    $insertBooking = "INSERT INTO bookings(customer_id, seat_id, shuttle_id)
                        VALUES($userid, $seatid, $shuttleid)";
                    $booker = mysqli_query($mysqli, $insertBooking);

                    if ($booker) {

                        // check the booking ID
                        $selBooking = "SELECT * FROM bookings WHERE customer_id = $userid AND seat_id = $seatid";
                        $selector = mysqli_query($mysqli, $selBooking);
                        $r = mysqli_fetch_assoc($selector);
                        $bookingid = $r['booking_id'];

                        
                        // insert the payment details
                        $pay = "INSERT INTO payments(customer_id, booking_id, shuttle_id, price)
                            VALUES($userid, $bookingid, $shuttleid, '$price')";
                        $payer = mysqli_query($mysqli, $pay);

                        if ($payer) {
                            $r = customerMpesaSTKPush();
                            if ($r == 0) {
                                echo "Success";
                            }
                        } else {
                            printf("Error: %s\n", mysqli_error($mysqli));
                        }
                    }
                }
            }
        // }
    
    
    
}else {
    echo "Please select a seat";
}


?>