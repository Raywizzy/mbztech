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
  <title>Add New Admin User</title>
  <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
  <link rel="stylesheet" href="adduser.css">
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
        <div class="new">
            <h2>Create New User <i class="fa-solid fa-user-plus"></i></div>
        
            <form method="POST" enctype="multipart/form-data">

                <div class="fields">
        <div class="field">
           <div class="input-field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="admin_name" required>
                    </div>
                    
                    <div class="input-field">
                        <label for="username">Email</label>
                        <input type="email" id="email" name="admin_email" required>
                    </div>

                  
            <div class="input-field">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="admin_image">
            </div>
                    <div class="input-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="admin_password" required>
                    </div>
        
                    <div class="input-field">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
        </div>
                   
        
                   
        
                    <button type="submit" class="sumbit" name="admin_registration">Create User <i class="fa-solid fa-person-circle-plus"></i></button>
                </div>
            </form>
                    <div id="response-message"></div>
        </div>
      

        <?php include 'nav.php'; ?>
  </div>

  <script src="adduser.js"></script>
<!-- Include your HTML and form here -->



</body>

</html>
<?php
// Your existing PHP code...

if(isset($_POST['admin_registration'])){
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password=password_hash($admin_password, PASSWORD_DEFAULT);
    $conf_admin_password=$_POST['confirm_password'];
    $admin_image=$_FILES['admin_image']['name'];
    $admin_image_tmp=$_FILES['admin_image']['tmp_name'];
    // Define getIPAddress() function or use $_SERVER['REMOTE_ADDR']
   
    $select_query="SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $result=mysqli_query($conn,$select_query);
    $rows_count=mysqli_num_rows($result);

    if($rows_count>0){
      echo "<script>alert('Admin name or Email already exists')</script>";
    } else if($admin_password != $conf_admin_password){
      echo "<script>alert('Passwords do not match')</script>";
    } else {
      move_uploaded_file($admin_image_tmp, "admin_images/$admin_image");
      $insert_query="INSERT INTO `admin_table` (admin_name, admin_email, admin_password, admin_image) VALUES ('$admin_name','$admin_email','$hash_password','$admin_image')";
      $sql_execute=mysqli_query($conn,$insert_query);
      if($sql_execute){
        echo "<script>alert('Admin user created successfully')</script>";
      } else {
        echo "<script>alert('Error creating admin user')</script>";
      }
    }
}
?>
