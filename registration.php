<?php
session_start(); // Start the session if not already started


$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include('common_functions.php');

if (isset($_POST['user_register'])) {
  $user_username = $_POST['user_username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
  $conf_user_password = $_POST['conf_user_password'];
  $user_address = $_POST['user_address'];
  $user_contact = $_POST['user_contact'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_tmp = $_FILES['user_image']['tmp_name'];
  $user_ip = getIPAddress();

  // Select query
  $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
  $result = mysqli_query($conn, $select_query);
  $rows_count = mysqli_num_rows($result);

  if ($rows_count > 0) {
    echo "<script>alert('Username or Email already exist')</script>";
  } else if ($user_password != $conf_user_password) {
    echo "<script>alert('Passwords do not match')</script>";
  } else {
    // Insert query
    move_uploaded_file($user_image_tmp, "user_images/$user_image");
    $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
    $sql_execute = mysqli_query($conn, $insert_query);

    // Add to User to salesforce Account object
    // Get access token

    $tokenEndpoint = 'https://ruby-site-6762.my.salesforce.com/services/oauth2/token'; // Replace with the actual token endpoint URL
    $client_id = '3MVG9Xl3BC6VHB.ZPOdbVGMwfjDS63_fcdRhWsFlJeEAPiEFKEmKFMJRmdDxNJB5_jqyESh790zztNg6Mj.zG';
    $client_secret = '5F86F50BF581A8DAAA1C769B5E7FFFF69CDDD5C841D4EAEFA144BAB48ADADD00';
    $grant_type = 'client_credentials';

    $params = [
      'client_id' => $client_id,
      'client_secret' => $client_secret,
      'grant_type' => $grant_type
    ];

    $url = $tokenEndpoint . '?' . http_build_query($params);

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
      echo 'cURL error: ' . curl_error($ch);
      // Handle the error accordingly
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response
    $tokenData = json_decode($response, true);

    // Extract the access token
    $accessToken = $tokenData['access_token'];


    // Salesforce REST API endpoint for creating records
    $apiEndpoint = "https://ruby-site-6762.my.salesforce.com/services/data/v59.0/sobjects/Account/";

    // Data to be saved to the Account object
    $data = array(
      "Name" => $user_username,
      "Phone" => $user_contact,
      "Email__C" => $user_email
    );

    // Convert data to JSON format
    $jsonData = json_encode($data);

    // Create cURL resource
    $ch = curl_init($apiEndpoint);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
      "Authorization: Bearer " . $accessToken
    ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
      echo 'Error: ' . curl_error($ch);
    } else {
      // Decode the response
      $responseData = json_decode($response, true);
      $salesforce_account_id = $responseData["id"];
      // Check if the record was created successfully
      if (isset($responseData["success"]) && $responseData["success"] === true) {
        echo "Account created successfully. Id: " . $responseData["id"];
      } else {
        echo "Failed to create Account. Error: " . print_r($responseData, true);
      }
    }


    // Close cURL resource
    curl_close($ch);

    $update_query = "UPDATE user_table SET salesforce_account_id = '$salesforce_account_id' WHERE user_email = '$user_email'";
    $sql_execute_update = mysqli_query($conn, $update_query);


    if ($sql_execute && $sql_execute_update) {
      // Redirect to login.php if registration is successful
      header("Location: login.php");
      exit();
    } else {
      echo "<script>alert('Error in registration')</script>";
    }
  }

  // Selecting cart items
  $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
  $result_cart = mysqli_query($conn, $select_cart_items);
  $rows_count = mysqli_num_rows($result_cart);

  if ($rows_count > 0) {
    $_SESSION['username'] = $user_username;
    echo "<script>alert('You have items in your cart')</script>";
    echo "<script>window.open('check.php','_self')</script>";
  } else {
    echo "<script>window.open('prices.php','_self')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MBZ Registration Page</title>
  <link rel="icon" href="assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="login.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/img/price/2.png" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/img/logo.png" width="150px" height="50px" alt="logo" class="logo">
              </div>
              <p class="login-card-description">New User Registration</p>



              <form id="login-form" action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="user_username" class="sr-only">Username</label>
                  <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter Your Username" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="user_email" class="sr-only">Email</label>
                  <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter Your Email">
                </div>
                <div class="form-group ">
                  <label class="sr-only" for="user_image">User Images</label>
                  <input type="file" id="user_image" name="user_image">
                  <small>Upload Profile Picture (allowed formats: JPG, PNG)</small>
                </div>
                <div class="form-group mb-4">
                  <label for="user_address" class="sr-only">Address</label>
                  <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter Your Address">
                </div>
                <div class="form-group">
                  <label for="user_contact" class="sr-only">Contact</label>
                  <input type="text" name="user_contact" id="user_contact" class="form-control" placeholder="Enter Your Mobile Number">
                </div>
                <div class="form-group mb-4">
                  <label for="user_password" class="sr-only">Password</label>
                  <input type="password" name="user_password" id="user_password" class="form-control" placeholder="***********">
                </div>
                <div class="form-group mb-4">
                  <label for="conf_user_password" class="sr-only">Confirm Password</label>
                  <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" placeholder="***********">
                </div>


                <input name="user_register" id="registration" class="btn btn-block login-btn mb-4" type="submit" value="Register">
              </form>
              <a href="#!" class="forgot-password-link">Forgot password?</a><br>
              <a href="login.php" class="forgot-password-link">Already have an account?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="login.js"></script>

</body>
</div>

</html>