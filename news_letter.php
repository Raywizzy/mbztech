<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mail"])) {
    // Validate and sanitize email
    $email = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);

    // Additional validation (customize as needed)
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please provide a valid email address.";
        exit;
    }

    $servername = "localhost";
    $db_username = "your_db_username";
    $db_password = "your_db_password";
    $dbname = "mbzstore";
    
    $conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    };
    

    // Insert data into the database (using prepared statements to prevent SQL injection)
    $sql = "INSERT INTO newsletter_subscriptions (email) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("s", $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Subscription successful";
    } else {
        // Check if the error is due to a duplicate entry
        if ($stmt->errno == 1062) {
            echo "Email address is already subscribed.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<div class="newsletter-area mg-top-110">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 text-center">
                <div class="section-title">
                    <h2 class="title">Get our latest <span>Newslatter</span></h2>
                    <p>Offer your business with the best assistance for growth.</p>
                </div>
                <div class="newsletter-subcribe">
                    <form id="news-subcribeform" class="subcribe-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your E-mail..." name="mail" required="">
                            <button type="submit" class="btn-green subcribe-submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>