<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

include('common_functions.php');
?>

<?php
session_start();

// Your database connection and common functions inclusion
// (Assuming the connection and functions are in common_functions.php)

if(isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate Admin Login
    $login_query = "SELECT * FROM admin_table WHERE admin_name = '$username'";
    $login_result = mysqli_query($conn, $login_query);

    if($login_result && mysqli_num_rows($login_result) > 0) {
        $admin_data = mysqli_fetch_assoc($login_result);
        $hashed_password = $admin_data['admin_password'];

        if(password_verify($password, $hashed_password)) {
            // Password matches, create session and redirect
            $_SESSION['admin_username'] = $admin_data['admin_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password')</script>";
        }
    } else {
        echo "<script>alert('Admin user not found')</script>";
    }
}
?>

<!-- Your HTML form -->
<!-- ... (existing HTML code) ... -->

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
  <body><div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Login</h2>
    <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-5">
        <img src="assets/img/price/3.png" alt="" class="img-fluid">
    </div>
    <div class="col-lg-6 col-xl-4">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
            </div>
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control">
            </div>
            <div>
                <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
            </div>
        </form>
    </div>
    </div>

  </div>

  </body>
</html>