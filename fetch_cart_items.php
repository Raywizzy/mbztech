<?php
// Connect to your database (replace with your database connection logic)
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "ecommerce_db";

$conn = mysqli_connect('localhost', 'root', '', 'ecommerce_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch cart items from the database
$sql = "SELECT product, price FROM cart_items"; // Adjust the query according to your database structure
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching cart items: " . mysqli_error($conn));
}

$cartItems = array();
$totalPrice = 0;

// Process the fetched data
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = array(
        'product' => $row['product'],
        'price' => $row['price']
    );
    $totalPrice += $row['price']; // Calculate the total price
}

// Prepare the data to be sent back as JSON
$response = array(
    'items' => $cartItems,
    'total' => $totalPrice
);

// Set headers to indicate JSON content
header('Content-Type: application/json');

// Send the JSON response back to the JavaScript
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>
