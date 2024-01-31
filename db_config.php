<?php
$dbHost = 'localhost';
$dbUser = 'impeefgv_mbztech';
$dbPassword = 'Mbztech50.';
$dbName = 'impeefgv_mbztechnology';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
