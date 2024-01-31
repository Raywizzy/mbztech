<?php
session_start();
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

include 'common_functions.php'; 

// Check if form is submitted
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="SELECT * FROM `user_table` WHERE username='$user_username'";
    $result=mysqli_query($conn,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    //cart item
    $select_query_cart="SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart=mysqli_query($conn,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);

    if($row_count > 0){
        if(password_verify($user_password, $row_data['user_password'])){
            // Set user_id in the session upon successful login
            $_SESSION['user_id'] = $row_data['user_id'];
            $_SESSION['username'] = $user_username;

            if($row_count == 1 && $row_count_cart == 0){
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MBZ Login Page</title>
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
            <img src="assets/img/price/1.png" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/img/logo.png" width="150px" height="50px" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              

              
              <form id="login-form" action="" method="post">

    <div class="form-group">
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Username">
    </div>
    <div class="form-group mb-4">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="***********">
    </div>
   
    <input name="user_login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
</form>
              <a href="registration.php" class="forgot-password-link">Don't have an account?</a><br>
              <a href="admin_login.php" class="forgot-password-link">Admin login</a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"><'[;/script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="login.js"></script>

</body>
</div>

</html>

