<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

 


if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="icon" href="assets/img/favicon.png">
        <link rel="stylesheet" href="dashboard_header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      </head>
<body>
    <header>
        <button type="button" class="menu-button" onclick="toggleSidebar()">
          <i id="menuIcon" class="fa fa-bars"></i>
        </button>
        <div class="logo-container">
          <img class="logo" src="assets/img/logo.png" width="100px" alt="Logo">
        </div>
        <div class="user-info">
          <?php
                     $username=$_SESSION['admin_username'];
                     $admin_image="Select * from `admin_table` where admin_name = '$username'";
                     $admin_image=mysqli_query($conn,$admin_image);
                     $row_image=mysqli_fetch_array($admin_image);
                     $admin_image=$row_image['admin_image'];
                     echo"<img class='profile-picture' src='admin_images/$admin_image' alt='Profile Picture'>";
          ?>
  
  <div class="user-details">
    <span class="username"><?php echo $_SESSION['admin_username']; ?></span>
    <span class="position">Admin</span>
  </div>
</div>

        </div>
        <div class="search-bar">
          <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
          <lord-icon src="https://cdn.lordicon.com/xfftupfv.json" trigger="loop" delay="1000" colors="primary:#121331"
            style="width:30px;height:30px"></lord-icon>
          <input type="search" class="search-input" placeholder="Search..." name="search_data">
          <input type="submit" value="search" name="search_data_product">
        </div>
      </header>
    <script src="dashboard_header.js"></script>
    <script>
        function toggleSidebar() {
          var sidebar = document.getElementById("sidebar");
          sidebar.classList.toggle("sidebar-expanded");
    
          var navbar = document.getElementById("navbar");
          navbar.classList.toggle("navbar-expanded");
    
          var content = document.querySelector(".content");
          content.classList.toggle("content-shifted");
        }
    
      </script>
</body>
</html>