
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Details</title>
  <link rel="icon" href="assets/img/favicon.png">
  <link rel="stylesheet" href="personal_details.css">
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

<h2>Edit Personal Details</h2>
<form method="post" action="update_details.php">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" value="<?php echo isset($first_name) ? $first_name : ''; ?>">

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" value="<?php echo isset($last_name) ? $last_name : ''; ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">

    <label for="phoneNumber">Phone Number:</label>
    <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">

  <div id="buttons">
    <button type="submit" class="btnn" id="saveButton">Save <i class="fa-solid fa-check"></i></button>
</form>         
            </div>
        </div>
        <?php include 'nav.php'; ?>
  </div>
  <script src="personal_details.js"></script>

</body>

</html>
