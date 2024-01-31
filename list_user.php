<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

include 'common_functions.php'; 

session_start();


// Fetch user data from the database
$get_users = "SELECT * FROM `user_table`";
$result = mysqli_query($conn, $get_users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Excos</title>
  <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
  <link rel="stylesheet" href="card.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body>
  <?php include 'dashboard_header.php'; ?>

  <div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content">
      <h2>Customers <i class="fa-solid fa-people-group"></i></h2>

      <div class="con">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $email = $row['user_email'];
            $phone = $row['user_mobile'];
            $image = $row['user_image'];
            // You can retrieve other user data here

            // Display user card
            echo "
            <div class='user-card'>
              <img src='user_images/$image' alt='Profile Picture'>
              <div class='user-inf'>
                <h2 class='user-name'>$username</h2>
                <p class='user-position'>Customer</p>
                <p class='user-phone'>Phone: $phone</p>
                <p class='user-email'>Email: $email</p>
              </div>
            </div>
            ";
          }
        } else {
          echo "<p>No users found</p>";
        }
        ?>
      </div>

      <?php include 'nav.php'; ?>
    </div>

    <script src="dashboard.js"></script>
    <script>
      // Your script content
    </script>
  </div>
</body>

</html>
