
<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include 'common_functions.php';

session_start();

if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_status = 'true';

    // Accessing images
    $product_image = $_FILES['product_image']['name'];

    // Accessing image tmp name
    $temp_image = $_FILES['product_image']['tmp_name'];

    // Checking empty conditions
    if (empty($product_title) || empty($description) || empty($product_keywords) || empty($product_price) || empty($product_category) || empty($product_image)) {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image, "product_images/$product_image");

        // Use prepared statement to prevent SQL injection
        $insert_products = "INSERT INTO products (product_title, product_description, product_keywords, category_id, product_image, product_price, date, status) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";

        $stmt = $conn->prepare($insert_products);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssissss", $product_title, $description, $product_keywords, $product_category, $product_image, $product_price, $product_status);

            // Execute the statement
            $result_query = $stmt->execute();

            if ($result_query) {
                echo "<script>alert('Successfully inserted the Product')</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: Unable to prepare the statement.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New User</title>
  <link rel="icon" href="assets/img/favicon.png">
  <link rel="stylesheet" href="adduser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body>
<?php include 'dashboard_header.php'; ?>

  <div class="container">
  <?php include 'sidebar.php'; ?>


    <div class="content">
        <div class="new">
            <h2>Insert New Product <i class="fa-solid fa-user-plus"></i></div>
        
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="fields">
                <div class="field">
    <div class="input-field">
        <label for="product_title" class="form-label">Product Title</label>
        <input type="text" class="form-label" id="product_title" name="product_title" required="required">
    </div>

    <div class="input-field">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" id="description" class="form-label" name="description" required="required">
    </div>

    <div class="input-field">
        <label class="form-label" for="product_keywords">Product Keywords</label>
        <input class="form-label" type="text" id="product_keywords" name="product_keywords" required="required">
    </div>

    <div class="input-field">
        <label class="form-label" for="product_price">Product Price</label>
        <input class="form-label" type="number" id="product_price" name="product_price" required="required">
    </div>

    <div class="input-field">
        <label for="product_image">Product Images</label>
        <input type="file" id="product_image" name="product_image" >
        <small>Upload one images (allowed formats: JPG, PNG)</small>
    </div>
</div>

                   
        
                    <div class="input-field">
                        <label for="product_category">Categories</label>
                        <select id="product_category" name="product_category" required="required">
                            <option value="" disabled selected>Select Categories</option>

                            <?php
                                $select_query="Select * from `categories`";
                                $result_query=mysqli_query($conn,$select_query);
                                while($row=mysqli_fetch_assoc($result_query)){
                                    $category_title=$row['category_title'];
                                    $category_id=$row['category_id'];
                                    echo "<option value='$category_id'>$category_title</option>";
                                }
                            ?>
                            <!-- <option value="admin">Admin</option>
                            <option value="user">User</option> -->
                     
                        </select>
                    </div>
        
                    <button name="insert_product" class="sumbit">Insert Product <i class="fa-solid fa-person-circle-plus"></i></button>
                </div>
            </form>
                    <div id="response-message"></div>
        </div>
      

        <?php include 'nav.php'; ?>
  </div>

  <script src="adduser.js"></script>
<!-- Include your HTML and form here -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch('adduserr.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // User created successfully
                    alert(data.message);
                    // Optionally, you can reset the form
                    form.reset();
                } else {
                    // Error occurred
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script> -->

</body>

</html>
