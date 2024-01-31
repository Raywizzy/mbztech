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
      
        <h2>All Orders <i class="fa-solid fa-people-roof"></i></h2>

        <div class="table-container">
          <table>
            <thead>
            <?php
// Database connection and other includes...

// Query to fetch orders with associated usernames
$get_orders_query = "SELECT * FROM `user_orders`";
$result = mysqli_query($conn, $get_orders_query);

if ($result) {
    $row_count = mysqli_num_rows($result);
    echo "
        <tr>
            <th>S/N</th>
            <th>Due Amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>User</th>
        </tr>
    ";

    if ($row_count == 0) {
        echo "<p>No orders yet</p>";
    } else {
        $number = 0;
        while ($row_data = mysqli_fetch_assoc($result)) {
            $order_id = $row_data['order_id'];
            $user_id = $row_data['user_id'];
            $amount_due = $row_data['amount_due'];
            $invoice_number = $row_data['invoice_number'];
            $total_products = $row_data['total_products'];
            $order_date = $row_data['order_date'];
            $order_status = $row_data['order_status'];
            $number++;

            $get_username_query = "SELECT username FROM user_table WHERE user_id = $user_id";
            $username_result = mysqli_query($conn, $get_username_query);

            if ($username_result && mysqli_num_rows($username_result) > 0) {
                $username_row = mysqli_fetch_assoc($username_result);
                $username = $username_row['username'];

                echo "<tr class='text-center'>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td>$username</td>
                </tr>";
            } else {
                echo "<tr class='text-center'>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td>User Not Found</td>
                </tr>";
            }
        }
    }
} else {
    echo "Error fetching orders: " . mysqli_error($conn);
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
