<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav-Bar</title>
    <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>
<body>
  <div id="navbar" class="navbar">
    <ul>
      <li><a class="nav-link <?php if ($currentPage === 'dashboard.php') echo 'activ'; ?>" href="dashboard.php"><i class="fa fa-home"></i><span>Home</span></a></li>
      <li><a class="nav-link <?php if ($currentPage === 'setting.php') echo 'activ'; ?>" href="setting.php"><i class="fa-solid fa-gear"></i><span>Settings</span></a></li>


      <li class="dropdown">
        <a class="nav-link" href="javascript:void(0);" onclick="toggleDropdown(this)"><span>Products </span><span class="caret"><i class="fa-solid fa-caret-right"></i></span></a>
        <ul class="dropdown-menu">
        <li><a class="nav-link <?php if ($currentPage === 'account.php') echo 'activ'; ?>" href="insert_product.php"><i class="fa-solid fa-wallet"></i><span>Insert Products</span></a></li>
      <li><a class="nav-link <?php if ($currentPage === 'transaction_history.php') echo 'activ'; ?>" href="view_product.php"><i class="fa-solid fa-file-invoice"></i><span>View Products</span></a></li>
        </ul>
      </li>

      

      <li class="dropdown">
        <a class="nav-link" href="javascript:void(0);" onclick="toggleDropdown(this)"><span>Categories</span><span class="caret"><i class="fa-solid fa-caret-right"></i></span></a>
        <ul class="dropdown-menu">
        <li><a class="nav-link <?php if ($currentPage === 'create_agenda.php') echo 'activ'; ?>" href="insert_categories.php"><i class="fa-solid fa-calendar-plus"></i><span>Insert Categories</span></a></li>
      <li><a class="nav-link <?php if ($currentPage === 'agenda.php') echo 'activ'; ?>" href="view_categories.php"><i class="fa-regular fa-calendar-days"></i><span>View Categories</span></a></li>
        </ul>
      </li>

      <li><a class="nav-link <?php if ($currentPage === 'adduser.php') echo 'activ'; ?>" href="adduser.php"><i class="fa-solid fa-user-plus"></i><span>Add Admin User</span></a></li>

      <li><a class="nav-link <?php if ($currentPage === 'partners.php') echo 'activ'; ?>" href="list_orders.php"><i class="fa-regular fa-handshake"></i><span>All Orders</span></a></li>

      <li><a class="nav-link <?php if ($currentPage === 'adduser.php') echo 'activ'; ?>" href="list_payments.php"><i class="fa-solid fa-user-plus"></i><span>All Payments</span></a></li>


      <li><a class="nav-link <?php if ($currentPage === 'upload_news.php') echo 'activ'; ?>" href="list_user.php"><i class="fa-solid fa-arrow-up-from-bracket"></i><span>All Customers</span></a></li>


      <li><a class="nav-link <?php if ($currentPage === 'send_mail.php') echo 'activ'; ?>" href="send_mail.php"><i class="fa-regular fa-paper-plane"></i><span>Send Mail</span></a></li>
      
      <li class="dropdown">
        <a class="nav-link" href="javascript:void(0);" onclick="toggleDropdown(this)"><span>Messages/Subscribers</span><span class="caret"><i class="fa-solid fa-caret-right"></i></span></a>
        <ul class="dropdown-menu">
        <li><a class="nav-link <?php if ($currentPage === 'contactform.php') echo 'activ'; ?>" href="contactform.php"><i class="fa fa-envelope"></i></i><span>Messages</span></a></li>
      <li><a class="nav-link <?php if ($currentPage === 'subscriptions.php') echo 'activ'; ?>" href="subscriptions.php"><i class="fa-solid fa-envelope-circle-check"></i><span>Subscribers</span></a></li>

        </ul>
      </li>

      <li><a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt logout-icon"></i><span style="color: red;">Logout</span></a>
      </li>
    </ul>
  </div>
<script src="nav.js"></script>
</body>
</html>