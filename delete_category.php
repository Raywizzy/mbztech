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
// delete_category.php

if(isset($_GET['category_id'])){
    // Sanitize the input to prevent SQL injection
    $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);

    $delete_category_query = "DELETE FROM `categories` WHERE category_id = $category_id";
    $result_category = mysqli_query($conn, $delete_category_query);

    if($result_category){
        echo "<script>alert('Category deleted successfully!')</script>";
        echo "<script>window.location.href='view_categories.php'</script>"; // Redirect to the category list or any other page
    } else {
        echo "<script>alert('Error deleting category')</script>";
    }
}
?>
