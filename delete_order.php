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
<?php
// delete_order.php

if (isset($_GET['order_id'])) {
    // Sanitize the input to prevent SQL injection
    $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

    $delete_order_query = "DELETE FROM `user_orders` WHERE order_id = '$order_id'";
    $result_order = mysqli_query($conn, $delete_order_query);

    if ($result_order) {
        echo "<script>alert('Order deleted successfully!')</script>";
        echo "<script>window.location.href='list_orders.php'</script>"; // Redirect to the order list or any other page
    } else {
        echo "<script>alert('Error deleting order')</script>";
    }
}
?>



