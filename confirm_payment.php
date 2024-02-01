<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};


session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "Select * from `user_orders` where order_id=$order_id";
    $result = mysqli_query($conn, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    if ($payment_mode === 'stripe') {
        require_once(__DIR__ . '/vendor/autoload.php');



        // Set your Stripe API keys
        \Stripe\Stripe::setApiKey('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');

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => (int)$amount * 100, // Amount in cents
                'currency' => 'eur',
                'description' => 'Payment for Invoice ' . $invoice_number,
                // Add more parameters as needed
            ]);

            // Get the client_secret from PaymentIntent
            $clientSecret = $paymentIntent->client_secret;

            // Redirect the user to the checkout page

            header('Location: stripes_checkout.php?client_secret=' . $clientSecret);
            exit();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        // $error_message = "Error: Could not connect to Stripe. Please try again later.";
        // header("Location: https://mbztechnology.com/error-page.php?error_message=" . urlencode($error_message));
        // exit();
    } elseif ($payment_mode === 'flutterwave') {
        $curl = curl_init();

        // Set your Flutterwave secret key
        $secret_key = 'FLWSECK-77563734dcafe5819430ddd6f06570e7-18c9c1337abvt-X';

        // URL to Flutterwave's API for initiating transactions
        $url = 'https://api.flutterwave.com/v3/payments';

        // Prepare payload for Flutterwave
        $payload = json_encode([
            'tx_ref' => $invoice_number,
            'amount' => $amount,
            'currency' => 'eur', // Replace with your desired currency
            'redirect_url' => 'https://mbztechnology.com/success-page.html', // Replace with success URL
            'payment_options' => 'card, mobilemoneyghana, ussd', // Replace with desired payment options
            'customer' => [
                'email' => 'info@mbztechnology.com', // Replace with customer's email
                'phonenumber' => 'customer_phone_number', // Replace with customer's phone number
                'name' => 'Customer Name' // Replace with customer's name
            ],
            'customizations' => [
                'title' => 'MBZTECHNOLOGY',
                'description' => 'Payment for goods/services',
                'logo' => 'https://mbztechnology.com/assets/img/favicon.png' // Replace with your logo URL
            ]
        ]);

        // Set CURL options for Flutterwave API
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $secret_key,
                "Content-Type: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response);

            // Check if the response contains expected data and the 'data' property exists
            if (isset($responseData->data) && isset($responseData->data->link)) {
                $payment_url = $responseData->data->link;
                // Redirect the user to Flutterwave payment page
                header('Location: ' . $payment_url);
                exit();
            } else {
                $responseData = json_decode($response);

                // Log the entire response for inspection
                file_put_contents('flutterwave_response.txt', print_r($responseData, true));

                // Display an error message
                echo "Error: Invalid Flutterwave response. Check flutterwave_response.txt for details.";
            }
        }
        $error_message = "Error: Could not connect to Flutterwave. Please try again later.";
        header("Location: https://mbztechnology.com/error-page.php?error_message=" . urlencode($error_message));
        exit();
    } else {
        // Handle other payment modes
        $error_message = "Error: Invalid payment mode selected.";
        header("Location: https://mbztechnology.com/error-page.php?error_message=" . urlencode($error_message));
        exit();
    }
    
    if ($payment_success) {
        // Insert payment details into user_payments table
        $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode) VALUES (?, ?, ?, ?)";
        // ... (prepare statement, bind params, execute)

        // Update order status
        $update_orders = "UPDATE `user_orders` SET order_status='Complete' WHERE order_id=?";
        // ... (prepare statement, bind param, execute)

        // Provide success feedback to the user
        echo "<h4 class='text-center'>Successfully completed the payment</h4>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    } else {
        // Handle payment failure
        echo "Payment failed.";
    }
}


// Update orders and payment status in the database accordingly
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBZTECHNOLOGY</title>
    <!-- favicon -->
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">
    <!-- animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <!-- animated slider -->
    <link rel="stylesheet" href="assets/css/animated-slider.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">


    <style>
        select {
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 4px;
            padding: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;

        }
    </style>
</head>

<body>
    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <div class="breadcrumb-area" style="background-image:url(assets/img/page-title-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">Confirm Payment</h1>
                        <ul class="page-list">


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline mt-4 text-center">
                <label for="invoice">Payment Invoice</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
            </div>
            <div class="form-outline mt-4 text-center">
                <label for="amount">Amount</label>
                <input type="hidden" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>" readonly>
                <input type="text" class="form-control w-50 m-auto" value="€<?php echo $amount_due ?>" readonly>
            </div>
            <div class="form-outline mt-4 text-center">
                <label for="amount">Payment Mode</label><br>
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <!-- <option value="paypal">Paypal</option> -->
                    <option value="stripe">Stripe</option>
                    <option value="flutterwave">Flutterwave</option>
                    <!-- <option value="globalpay">Global Pay</option> -->
                </select>
            </div>

            <div class="col-12 mt-5 mb-5 text-center">
                <input type="submit" value="Pay" name="confirm_payment" class="btn btn-green">
            </div>
        </form>
    </div>


    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->


    <!-- jquery -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <!-- popper -->
    <script src="assets/js/popper.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <!-- wow -->
    <script src="assets/js/wow.min.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- slick slider -->
    <script src="assets/js/slick.js"></script>
    <!-- cssslider slider -->
    <script src="assets/js/jquery.cssslider.min.js"></script>
    <!-- waypoint -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- counterup -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- imageloaded -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- world map -->
    <script src="assets/js/worldmap-libs.js"></script>
    <script src="assets/js/worldmap-topojson.js"></script>
    <script src="assets/js/mediaelement.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>

</body>

</html>