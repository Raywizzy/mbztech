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
// delete_product.php

if(isset($_GET['product_id'])){
    // Sanitize the input to prevent SQL injection
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);

    $delete_product_query = "DELETE FROM `products` WHERE product_id = $product_id";
    $result_product = mysqli_query($conn, $delete_product_query);

    if($result_product){
        echo "<script>alert('Product deleted successfully!')</script>";
        echo "<script>window.location.href='view_product.php'</script>"; // Redirect to the product list or any other page
    } else {
        echo "<script>alert('Error deleting product')</script>";
    }
}
?>
