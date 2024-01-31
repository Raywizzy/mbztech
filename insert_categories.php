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

if(isset($_POST['insert'])){
    $category_title=$_POST['cat_title'];

    //select data from database
    $select_query="Select * from `categories` where category_title='$category_title'";
    $result_select=mysqli_query($conn,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo"<script>alert('This Category is present')</script>";
    }else{
    $insert_query="insert into `categories` (category_title) values('$category_title')";
    $result=mysqli_query($conn,$insert_query);
    if($result){
        echo "<script>alert('Category has been inserted successfully')</script>";
    }
}}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Members</title>
  <link rel="icon" href="WhatsApp Image 2023-03-13 at 15.14.46_auto_x2 (1).png">
  <link rel="stylesheet" href="members.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
  <?php include 'dashboard_header.php'; ?>
<form action="" method="post">
  <div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content">
      
        <h2>Insert Categories <i class="fa-solid fa-people-roof"></i></h2>
            
        <div class="fields">
          <div class="input-field">
              <label for="category">Input Category:</label>
        <input type="text" id="category" name="cat_title" placeholder="Input Category">
          </div>
      </div> 

      <div class="action">
          <button type="submit" class="credit" name="insert">Insert <i class="fa-solid fa-plus"></i></button>
        
        </div>

        
        

<?php include 'nav.php'; ?>
  </div>
</div>
</form>
  <script src="members.js"></script>

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
