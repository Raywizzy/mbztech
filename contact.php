<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitForm"])) {
    // Validate and sanitize form data
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    // Additional validation (customize as needed)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Connect to your database (replace these values with your actual database credentials)
    $servername = "localhost";
    $db_username = "your_db_username";
    $db_password = "your_db_password";
    $dbname = "mbzstore";
    
    $conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    };
    

    // Insert data into the database (using prepared statements to prevent SQL injection)
    $sql = "INSERT INTO contact_form_data (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Form data saved successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBZTECHNOLOGY</title>
    <!-- favicon -->
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">
    <!-- animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <!-- animated slider -->
    <link rel="stylesheet" href="assets/css/animated-slider.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">   



</head>
<body>

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->

<!-- search Popup -->
<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <form action="index.php" class="search-form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- //. search Popup -->

<!-- navbar area start -->
<?php include 'header.php'; ?>
<!-- navbar area end -->

<!-- breadcrumb area start -->
<div class="breadcrumb-area" style="background-image:url(assets/img/page-title-bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">Contact</h1>
                    <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->

<!-- contact form start -->
<div class="contact-form-area pd-top-112">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
            <div class="section-title text-center w-100">
    <h2 class="title">Send Us Your <span>Inquiry</span></h2>
    <p>If you have any questions or would like to get in touch with us, please don't hesitate to reach out. We're here to assist you with any inquiries you may have. </p>
</div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5">
                <img src="assets/img/others/21.png" alt="blog">
            </div>
            <div class="col-lg-7 offset-xl-1">
            <form action="" method="post" class="riyaqas-form-wrap mt-5 mt-lg-0">
                    <div class="row custom-gutters-16">
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <input type="text" class="single-input">
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <input type="text" class="single-input">
                                <label>E-mail</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-wrap">
                                <input type="text" class="single-input">
                                <label>Subject</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-wrap">
                                <textarea class="single-input textarea" cols="20"></textarea>
                                <label class="single-input-label">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-red mt-0" href="#">Send</a>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- map area start -->
<div class="map-area pd-top-120">
    <div class="container">
        <div class="map-area-wrap">
            <div class="row no-gutters">
                <div class="col-lg-8">
                    <div ><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15884.637819839214!2d5.746266500000007!3d5.5433600000000025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sng!4v1695211636793!5m2!1sen!2sng" width="800" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                </div>  
                <div class="col-lg-4 desktop-center-item">
                    <div>
                    <div class="contact-info">
    <h4 class="title">Contact Information:</h4>
    <p class="sub-title">If you need to reach us, feel free to use the following contact details. We are here to assist you with any inquiries or concerns you may have.</p>
    <p>Address 1: 3b, Adjacent Odafe Fillimg Station, off Delta Careers College Link Road, Warri, Delta State, Nigeria <br>
Address 2: 26/28 Bedford Row London WC1R 4LP United Kingdom</p>
    <p><span>Phone:</span>+234 911 8328 807</p>
    <p><span>Email:</span> info@mbztechnology.com</p>
</div>

                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<!-- map area End -->
<?php include 'news_letter.php'; ?>
<!-- footer area start -->
<?php include 'footer.php'; ?>
<!-- footer area end -->

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->

    <!-- jquery -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <!-- popper -->
    <script src="assets/js/popper.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <!-- wow -->
    <script src="assets/js/wow.min.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- cssslider slider -->
    <script src="assets/js/jquery.cssslider.min.js"></script>
    <!-- waypoint -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- counterup -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- imageloaded -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- world map -->
    <script src="assets/js/worldmap-libs.js"></script>
    <script src="assets/js/worldmap-topojson.js"></script>
    <!-- google map js -->
    <script src="assets/js/goolg-map-activate.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVyNXoXHkqAwBKJaouZWhHPCP5vg7N0HQ&callback=initMap"></script>
    
    <script src="assets/js/mediaelement.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>
</body>
</html>
