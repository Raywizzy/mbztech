<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = mysqli_connect('localhost', 'root', '', 'ocf');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_POST['image'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $currentDateTime = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO news (image, title, subtitle, date_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $image, $title, $subtitle, $currentDateTime);

    $response = ['status' => 'error', 'message' => 'Failed to save data'];
    if ($stmt->execute()) {
        $response = ['status' => 'success'];
    }

    $stmt->close();
    echo json_encode($response);
    exit(); // Stop further execution
}

// Retrieve news data from the database
$query = "SELECT * FROM news";
$result = $conn->query($query);

$newsData = array();
while ($row = $result->fetch_assoc()) {
    $newsData[] = $row;
}

// Return the news data as JSON
echo json_encode($newsData);

$conn->close();
?>


<?php
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageFileName = $_FILES['image']['name'];
    
    // Define the directory to save the uploaded images
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/OCF/uploads/';
    
    // Move the uploaded image to the target directory
    if (move_uploaded_file($imageTmpName, $uploadDirectory . $imageFileName)) {
        // Return the image URL
        $imageUrl = 'http://localhost/OCF/uploads/' . $imageFileName;
        echo json_encode(['status' => 'success', 'imageUrl' => $imageUrl]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded image']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Image upload failed']);
}

?>