
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
<h2>Personal Details</h2>
<p>First Name: <?php echo isset($first_name) ? $first_name : ''; ?></p>
<p>Last Name: <?php echo isset($last_name) ? $last_name : ''; ?></p>
<p>Email: <?php echo isset($email) ? $email : ''; ?></p>
<p>Phone Number: <?php echo isset($phone_number) ? $phone_number : ''; ?></p>


            <div id="buttons">
                <a class="btnn" href="personal_details_edit.php">
                    <button class="btnn" id="editButton">Edit Details</button>
                </a>
                            
                
            </div>
        </div>
      
        </form>
        <?php include 'nav.php'; ?>
  </div>
  <script src="personal_details.js"></script>

</body>

</html>
