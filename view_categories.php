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

  <div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content">
      
        <h2>Categories <i class="fa-solid fa-people-roof"></i></h2>
   

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Category ID</th>
                <th>Category Title</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>
  <?php
  $select_cat = "SELECT * FROM `categories`";
  $result = mysqli_query($conn, $select_cat);
  $number=0;
  while ($row = mysqli_fetch_assoc($result)) {
      $category_title = $row['category_title'];
      $category_id = $row['category_id'];
      $number++;
      ?>

<tr class='text-center'>
    <td><?php echo $number; ?></td>
    <td><?php echo $category_title; ?></td>
    <td><a href="edit_categories.php?category_id=<?php echo $category_id ?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>


<td><a href="delete_category.php?category_id=<?php echo $category_id ?>" class="text-light" name="delete_category"><i class="fa-solid fa-trash"></i></a></td>
</tr>
  <?php
  }
  ?>
</tbody>


</table>
</div>
        
        

<?php include 'nav.php'; ?>
  </div>

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
