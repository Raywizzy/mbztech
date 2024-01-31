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
<?php
// Check if category ID is provided in the URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch category details from the database
    $query = "SELECT * FROM `categories` WHERE `category_id` = $category_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $category = mysqli_fetch_assoc($result);
        if ($category) {
            $category_title = $category['category_title'];
        } else {
            echo "category not found!";
        }
    } else {
        echo "Error in querying the database: " . mysqli_error($conn);
    }
} else {
    echo "No category ID provided!";
}
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
              <input type="text" id="category_title" name="category_title" value="<?php echo $category_title; ?>">          </div>
      </div> 

      <button name="edit_category" class="credit" type="sumbit">Update category <i class="fa-solid fa-person-circle-plus"></i></button>

        
        

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
<?php
if (isset($_POST['edit_category'])) {
    // Retrieve form data
    $category_title = $_POST['category_title'];


    // Update the category details in the database
    $update_query = "UPDATE `categories` SET `category_title`='$category_title' WHERE `category_id`='$category_id'";

    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('category details updated successfully')</script>!";
        echo "<script>window.open('view_categories.php','_self')</script>";

        // Optionally, you can redirect the user to a different page after successful update
        // header("Location: categorys_list.php");
        // exit();
    } else {
        echo "Error updating category details: " . mysqli_error($conn);
    }
}

?>
