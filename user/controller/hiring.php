<?php

include "../../dbConfig/config.php";


// getting payment variables
$price = mysqli_real_escape_string($mysqli, $_POST['price']);
$userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
$shuttleid = mysqli_real_escape_string($mysqli, $_POST['shuttleid']);
$status = 'Hired';


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

        // inserting into table hiring\
        $insertHire = "INSERT INTO hirings(customer_id, shuttle_id, price)
        VALUES($userid, $shuttleid, $price)";
        $success = mysqli_query($mysqli, $insertHire);

        if ($success) {
            $hire = "UPDATE shuttles SET shuttle_status = 'Hired' WHERE shuttle_id = $shuttleid";
            $set = mysqli_query($mysqli, $hire);

            if ($set) {
                $r = customerMpesaSTKPush();
                if ($r == 0) {
                    echo "Success";
                }
            }else {
                printf("Error: %s \n", mysqli_error($mysqli));
            }
        }else {
            printf("Error: %s \n", mysqli_error($mysqli));
        }
                
}else {
    echo "Please select a seat";
}



?>