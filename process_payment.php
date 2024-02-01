<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

require_once 'salesforce.php';
// process_payment.php

// Include Stripe PHP library and initialize if required

// Retrieve the PaymentMethod ID sent from the client-side
$payment_method_id = $_POST['payment_method_id'];

// Verify the payment status with Stripe using the $payment_method_id
// Make API call to Stripe and check if the payment was successful

// Assuming $payment_successful is a boolean indicating the payment status
if ($payment_successful) {
    // Payment was successful

    // // Get current logged in user
    // $user_id = $_SESSION('username');

    // // Get user details from database
    // try {
    //     $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    //     $result = mysqli_query($conn, $select_query);

    //     if ($result) {
    //         // Fetch the data from the row
    //         $row = mysqli_fetch_assoc($result);

    //         // Use the data from the row as needed
    //         if ($row) {
    //             $salesforce_account_id = $row['salesforce_account_id'];
    //             $user_ip = getIPAddress();
    //             // Use other fields as needed

    //             // Add order details to salesforce
    //             $access_token = get_access_token();

    //             // Salesforce REST API endpoint for creating records
    //             $apiEndpoint = "https://ruby-site-6762.my.salesforce.com/services/data/v59.0/sobjects/Order/";

    //             // Data to be saved to the Account object
    //             $data = array(
    //                 "Name" => $user_username,
    //                 "Phone" => $user_contact,
    //                 "Ip_Address__c" => $user_ip
    //             );

    //             // Convert data to JSON format
    //             $jsonData = json_encode($data);

    //             // Create cURL resource
    //             $ch = curl_init($apiEndpoint);

    //             // Set cURL options
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //                 "Content-Type: application/json",
    //                 "Authorization: Bearer " . $accessToken
    //             ));
    //             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    //             // Execute cURL request
    //             $response = curl_exec($ch);

    //             // Check for errors
    //             if (curl_errno($ch)) {
    //                 echo 'Error: ' . curl_error($ch);
    //             } else {
    //                 // Decode the response
    //                 $responseData = json_decode($response, true);
    //                 $salesforce_account_id = $responseData["id"];
    //                 // Check if the record was created successfully
    //                 if (isset($responseData["success"]) && $responseData["success"] === true) {
    //                     echo "Account created successfully. Id: " . $responseData["id"];
    //                 } else {
    //                     echo "Failed to create Account. Error: " . print_r($responseData, true);
    //                 }
    //             }


    //             // Close cURL resource
    //             curl_close($ch);
    //         } else {
    //             echo "No matching row found";
    //         }
    //     } else {
    //         echo "Error executing query: " . mysqli_error($conn);
    //     }


    //     echo json_encode(array('success' => true));
    // } catch (\Throwable $th) {
    //     echo json_encode(array('success' => false));
    // }
    echo json_encode(array('success' => true));
} else {
    // Payment failed
    echo json_encode(array('success' => false));
}
