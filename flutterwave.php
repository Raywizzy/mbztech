<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

// Establish database connection (remove these lines if not used)
$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Retrieve necessary details for payment processing (ensure proper validation and sanitization)
$invoice_number = isset($_POST['invoice_number']) ? $_POST['invoice_number'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';

// Your Flutterwave API keys
$secret_key = 'YOUR_FLUTTERWAVE_SECRET_KEY'; // Replace with your actual secret key

// Set up payment details
$payment_data = array(
    'tx_ref' => $invoice_number,
    'amount' => $amount,
    'currency' => 'NGN',
    'redirect_url' => 'https://yourwebsite.com/payment-success',
    'payment_options' => 'card',
    'customer' => array(
        'email' => 'customer@example.com',
        // Add more customer details as required
    ),
    // Add more parameters as required by Flutterwave's API
);

// Initialize cURL and send payment request
$ch = curl_init();

// Set the necessary cURL options for Flutterwave API
curl_setopt($ch, CURLOPT_URL, 'https://api.flutterwave.com/v3/payments');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payment_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $secret_key,
    'Content-Type: application/json',
));

// Execute cURL request and handle response
$response = curl_exec($ch);
$err = curl_error($ch);

// Close cURL session
curl_close($ch);

// Handle API response
if ($err) {
    // If there's an error in the request
    echo "cURL Error: " . $err;
} else {
    // Decode the response from Flutterwave
// Decode the response from Flutterwave
$payment_response = json_decode($response, true);

// Check if $payment_response['data'] exists and is not null
if (isset($payment_response['data']) && isset($payment_response['data']['link'])) {
    // Redirect the user to the Flutterwave payment page
    header('Location: ' . $payment_response['data']['link']);
    exit();
} else {
    // Handle the case where the required data is not available
    echo "<script>Error</script>";
}

}
?>

<?php
// Check if the form is submitted and $_POST data is available
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_payment'])) {
    // Retrieve necessary details for payment processing
    $invoice_number = isset($_POST['invoice_number']) ? $_POST['invoice_number'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';

    // Validate or sanitize the data as needed

    // Your payment processing logic using Flutterwave's API goes here...
} else {
    // Handle cases where the script is accessed without the form being submitted
    echo "Please submit the form to proceed with payment.";
}
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
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>" >
            </div>
            <div class="form-outline mt-4 text-center">
                <label for="amount">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>

            <div class="col-12 mt-5 mb-5 text-center">
                <input type="submit" value="Pay" name="confirm_payment"  class="btn btn-green" >
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
    <script>
        // Redirecting to Flutterwave payment page if JavaScript is enabled
        window.location.replace('https://api.flutterwave.com/v3/payments');
    </script>

    <!-- Provide a fallback link to the Flutterwave payment page -->
    <noscript>
        <p>Please <a href="https://api.flutterwave.com/v3/payments">click here</a> to proceed with payment.</p>
    </noscript>
</body>
</html>
