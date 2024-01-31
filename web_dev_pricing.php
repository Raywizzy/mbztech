<div class="sba-pricing-area bg-gray mg-top-105 pd-default-two">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-9">
                <div class="section-title text-center">
                    <h3 class="title">Website Development <span>Packages</span></h3>
                </div>
            </div>
        </div>
        <div class="row custom-gutters-20" id="pricing-packages">
            <?php
            // Establish a database connection (replace with your own database connection logic)
            $servername = "localhost";
            $db_username = "your_db_username";
            $db_password = "your_db_password";
            $dbname = "mbzstore";
            
            $conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            };

            // Fetch services with 'app_packages' category
            $sql = "SELECT * FROM products WHERE category_id='11'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Generate HTML for each service package

                    $product_id=$row['product_id'];
                    $product_title = $row["product_title"];
                    $product_description = explode("\n", $row["product_description"]);
                    $product_keywords = $row["product_keywords"]; 
                    $category_id = $row["category_id"];
                    $product_image = $row["product_image"];
                    $product_price = $row["product_price"];
                    echo"<div class='col-xl-4 col-sm-6'>
                    <div class='single-pricing text-cente'>
                        <h6 class='title text-center'>$product_title</h6>
                        <div class='thumb text-center'>
                            <img src='product_images/$product_image' alt='pricing'>
                        </div>
                        <h3 class='price text-center'>$$product_price<span></span></h3>
                        <ul>";

                        // Loop through each sentence in the description and create a new <li> element for each
                       
                                foreach ($product_description as $product_description) {
                                    echo '<li class="bold"><i class="fa-solid fa-check"></i> <span>' . $product_description . '</span></li>';
                                }
                                
                        echo "</ul>
     <div class='text-center'>
        <a class='btn text-center btn-white btn-rounded' href='prices.php?add_to_cart=$product_id'>Add To Cart</a>
    </div>
                        
                    </div>
                </div>"
                    ?>
                
                    <?php
                }
            } else {
                echo "No packages available for this category.";
            }

            mysqli_close($conn); // Close the database connection
            ?>
        </div>
    </div>
</div>