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

  <style>
    .product_img{
      width: 20%;
      object-fit: contain;
    }
  </style>
</head>

<body>
  <?php include 'dashboard_header.php'; ?>

  <div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content">
      
        <h2>Products <i class="fa-solid fa-people-roof"></i></h2>

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
<!-- ... (previous code) ... -->
<tbody>
  <?php
    $get_products="Select * from `products`";
    $result=mysqli_query($conn,$get_products);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_image=$row['product_image'];
      $product_price=$row['product_price'];
      $status=$row['status'];
      $number++;
      ?>
      <tr class='text-center'>
    <td><?php echo $number; ?></td>
    <td><?php echo $product_title; ?></td>
    <td><img src='product_images/<?php echo $product_image; ?>' class='product_img' ></td>
    <td >$<?php echo $product_price; ?></td>
    <td><?php
    $get_count="select * from `orders_pending` where product_id=$product_id";
    $result_count=mysqli_query($conn,$get_count);
    $rows_count=mysqli_num_rows($result_count);
    echo $rows_count;

    ?></td>
    <td><?php echo $status; ?></td>
    <td><a href="edit_products.php?product_id=<?php echo $product_id ?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>

    <td><a href="delete_product.php?product_id=<?php echo $product_id ?>" class="text-light" name="delete_product"><i class="fa-solid fa-trash"></i></a></td>
  </tr>
  <?php


    }
  ?>
  

</tbody>

</table>
</div>
        
        

<?php include 'nav.php'; ?>
  </div>

  <script src="mebers.js"></script>

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
