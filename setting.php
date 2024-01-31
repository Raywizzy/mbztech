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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setting</title>
  <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
  <link rel="stylesheet" href="setting.css">
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
        <?php
            $admin_username=$_SESSION['admin_username'];
            $admin_image="Select * from `admin_table` where admin_name='$admin_username'";
            $admin_image=mysqli_query($conn,$admin_image);
            $row_image=mysqli_fetch_array($admin_image);
            $admin_image=$row_image['admin_image'];
            echo " <div class='profile-sectio'>
              <div class='profile-pictur'>
                <img id='profile-imag' src='admin_images/$admin_image' alt='Profile Picture'>
              </div>
            </div>";
        
        ?>
        <?php
                
                if(isset($_GET['edit_admin_account'])){
                    include('edit_admin_account.php');
                }

                if(isset($_GET['delete_admin_account'])){
                    include('delete_admin_account.php');
                }
           ?>
           
        
            <div class="settings-section">
              <ul class="settings-links">
                <li><a href="setting.php?edit_admin_account"><i class="fa-solid fa-gears"></i> Edit Account </a></li>
                <li><a href="setting.php?delete_admin_account"><i class="fa-solid fa-gears"></i> Delete Account </a></li>
              </ul>
            </div>
            
            <?php include 'nav.php'; ?>

  </div>
  </div>

  <script src="setting.js"></script>
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
