<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  
  
  </head>
<body>
  
<div id="sidebar" class="sidebar">
  <ul>
    <li><a class="link <?php if ($currentPage === 'dashboard.php') echo 'active'; ?>" href="dashboard.php"><i class="fa fa-home"></i><span>Home</span></a></li>
    <li><a class="link <?php if ($currentPage === 'personal_details_view.php') echo 'active'; ?>" href="adduser.php"><i class="fa fa-user"></i><span>Add User</span></a></li>
    <li><a class="link <?php if ($currentPage === 'setting.php') echo 'active'; ?>" href="setting.php"><i class="fa fa-cog"></i><span>Settings</span></a></li>
    <li><a class="link <?php if ($currentPage === 'contactform.php') echo 'active'; ?>" href="contactform.php"><i class="fa fa-envelope"></i><span>Messages</span></a></li>
    <li><a class="link" href="logout.php"><i class="fa fa-sign-out-alt logout-icon"></i><span>Logout</span></a></li>
  </ul>
</div>


</body>
</html>