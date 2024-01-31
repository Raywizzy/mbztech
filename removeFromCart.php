<?php
require_once("db_config.php");

$title = $_POST["title"];

try {
    $sql = "DELETE FROM cart WHERE title = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title]);

    echo "Item removed from cart successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
