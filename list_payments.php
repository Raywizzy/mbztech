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
      
        <h2>All Payments <i class="fa-solid fa-people-roof"></i></h2>

        <div class="table-container">
          <table>
            <thead>
            <?php
// Database connection and other includes...

$get_payments = "SELECT * FROM `user_payments`";
$result = mysqli_query($conn, $get_payments);

if ($result) {
    $row_count = mysqli_num_rows($result);
    echo "
        <tr>
            <th>S/N</th>
            <th>Amount</th>
            <th>Invoice Number</th>
            <th>Payment Date</th>
            <th>Payment Mode</th>
   
        </tr>
    ";

    if ($row_count == 0) {
        echo "<p>No payments yet</p>";
    } else {
        $number = 0; // Initialize the number variable outside the loop
        while ($row_data = mysqli_fetch_assoc($result)) {
            $payment_id = $row_data['payment_id'];
            $order_id = $row_data['order_id'];
            $amount = $row_data['amount'];
            $invoice_number = $row_data['invoice_number'];
            $payment_mode = $row_data['payment_mode'];
            $date = $row_data['date'];

            // Increment the counter
            $number++;
                    echo "<tr class='text-center'>
                        <td>$number</td>
                        <td>$$amount</td>
                        <td>$invoice_number</td>
                        <td>$date</td>
                        <td>$payment_mode</td>
                    </tr>";
                
            
        
    
        }
    }
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
