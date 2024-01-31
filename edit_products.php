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

  <style>
    .product_img{
      width: 20%;
      object-fit: contain;
    }
  </style>
</head>

<body>
<?php include 'dashboard_header.php'; ?>

  <div class="container">
  <?php include 'sidebar.php'; ?>

  <?php
// Establish database connection

// Check if product ID is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database
    $query = "SELECT * FROM `products` WHERE `product_id` = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $product = mysqli_fetch_assoc($result);
        if ($product) {
            $product_title = $product['product_title'];
            // Retrieve other product details here and assign them to variables
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_description = $product['product_description'];
            $product_keywords = $product['product_keywords'];
            // ... and so on for other variables you need

          
        } else {
            echo "Product not found!";
        }
    } else {
        echo "Error in querying the database: " . mysqli_error($conn);
    }
} else {
    echo "No product ID provided!";
}
?>
    <div class="content">
        <div class="new">
            <h2>Edit Product <i class="fa-solid fa-user-plus"></i></div>
        
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="fields">
                <div class="field">
    <div class="input-field">
        <label for="product_title" class="form-label">Product Title</label>
        <input type="text" class="form-label" id="product_title" name="product_title" required="required" value="<?php echo $product_title;?>">
    </div>

    <div class="input-field">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" id="description" class="form-label" name="description" required="required" value="<?php echo $product_description?>">
    </div>

    <div class="input-field">
        <label class="form-label" for="product_keywords">Product Keywords</label>
        <input class="form-label" type="text" id="product_keywords" name="product_keywords" required="required" value="<?php echo $product_keywords?>">
    </div>

    <div class="input-field">
        <label class="form-label" for="product_price">Product Price</label>
        <input class="form-label" type="number" id="product_price" name="product_price" required="required" value="<?php echo $product_price?>">
    </div>

    <div class="input-field">
        <label for="product_image">Product Images</label>
        <input type="file" id="product_image" name="product_image" >
        <small>Upload one images (allowed formats: JPG, PNG)</small>
        <img src="product_images/<?php echo $product_image?>" class="product_img">
    </div>
</div>

                   
        
<div class="input-field">
    <label for="product_category">Categories</label>
    <select id="product_category" name="product_category" required="required">
        <option value="" disabled>Select Categories</option>

        <?php
        // Fetch categories from the database and populate the dropdown
        $get_categories_query = "SELECT * FROM `categories`";
        $categories_result = mysqli_query($conn, $get_categories_query);

        if ($categories_result && mysqli_num_rows($categories_result) > 0) {
            while ($row = mysqli_fetch_assoc($categories_result)) {
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];

                // Check if the current category matches the product's category
                $selected = ($category_id == $product['category_id']) ? 'selected' : '';

                echo "<option value='$category_id' $selected>$category_title</option>";
            }
        } else {
            echo "<option value=''>No categories found</option>";
        }
        ?>
    </select>
</div>

        
                    <button name="edit_product" class="sumbit">Update Product <i class="fa-solid fa-person-circle-plus"></i></button>
                </div>
            </form>
                    <div id="response-message"></div>
        </div>
      

        <?php include 'nav.php'; ?>
  </div>

  <scrip src="adduser.js"></scrip>


</body>

</html>
<?php
if (isset($_POST['edit_product'])) {
    // Retrieve form data
    $product_title = $_POST['product_title'];
    $product_description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];

    // Update the product details in the database
    $update_query = "UPDATE `products` SET `product_title`='$product_title', `product_description`='$product_description', `product_keywords`='$product_keywords', `product_price`='$product_price', `category_id`='$product_category' WHERE `product_id`='$product_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('Product details updated successfully')</script>!";
        echo "<script>window.open('view_product.php','_self')</script>";

        // Optionally, you can redirect the user to a different page after successful update
        // header("Location: products_list.php");
        // exit();
    } else {
        echo "Error updating product details: " . mysqli_error($conn);
    }
}

if ($_FILES['product_image']['name']) {
    $file_name = $_FILES['product_image']['name'];
    $file_tmp = $_FILES['product_image']['tmp_name'];
    $file_type = $_FILES['product_image']['type'];

    // Handle file upload - move to the directory
    move_uploaded_file($file_tmp, "product_images/" . $file_name);

    // Update the image path in the database
    $update_image_query = "UPDATE `products` SET `product_image`='$file_name' WHERE `product_id`='$product_id'";
    $update_image_result = mysqli_query($conn, $update_image_query);

    if (!$update_image_result) {
        echo "Error updating image path: " . mysqli_error($conn);
    }
}

?>
