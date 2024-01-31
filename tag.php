
<?php
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

?>
<div class="widget widget_tag_cloud">
                        <h3 class="widget-title">Popular Tag</h3>
                        <div class="tagcloud">
                        <?php
                  $select_categories="select * from `categories`";
                  $result_categories=mysqli_query($conn,$select_categories);
                  
                  while($row_data=mysqli_fetch_assoc($result_categories)){
                    $category_title=$row_data['category_title'];
                    $category_id=$row_data['category_id'];
                    echo"<a href='tag.php?category=$category_id'> $category_title </a>
                    ";
                    
                  }

                ?>
                           
                        
                        </div>
                    </div>