<style>
    .ok{
        display: flex;

    }

    .rem{
        color:green;
       margin-left: 20px;
    }

    .cart-items-wrapper {
    height: 300px; /* Set your desired height here */
    overflow-y: auto; /* Enable vertical scrolling */
    /* Other styles */
}

    .aa{
        border: none;
        border-radius: 5px;
    }

    .aa:hover{
        background-color: green;
    }

    .bb{
        border: none;
        border-radius: 5px;
    }

    .bb:hover{
        background-color: red;
    }
</style>
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



<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NVG0LJ7EDV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-NVG0LJ7EDV');
</script>

  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>

</style>
 
  <?php 
            cart();
         ?>
<nav class="navbar navbar-area navbar-expand-lg nav-style-01">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper mobile-logo">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo.png" alt="logo">
                </a>
            </div>
            <div class="nav-right-content">
                <ul>
                    <li class="search">
                        <i class="ti-search"></i>
                    </li>
                    <li class="cart" >
                    <div class="cart"><i class="las la-shopping-cart"></i><?php cart_item()?></div>
                        <div class="widget_shopping_cart_content">
                             <ul>
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="assets/img/checkout/7.png" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <a class="title" href="#">Smart watch red color</a>
                                            <p>Quantity: 1</p>
                                            <span class="price">$150.00</span>
                                        </div>
                                    </div>
                                    <a class="remove-product" href="#"><span class="ti-close"></span></a>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="assets/img/checkout/8.png" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <a class="title" href="#">Smart watch red color</a>
                                            <p>Quantity: 1</p>
                                            <span class="price">$150.00</span>
                                        </div>
                                    </div>
                                    <a class="remove-product" href="#"><span class="ti-close"></span></a>
                                </li>
                            </ul> 
                             <p class="total">
                                <strong>Subtotal: </strong> 
                                <span class="amount">
                                    <span class="woocommerce-Price-currencySymbol">$</span><?php total_cart_price() ?>
                                </span>       
                            </p>
                            <p class="buttons">
                                <a href="checkout.php" class="button">View Card & Check out</a>
                            </p> 
                        </div>
                    </li>
                    <li class="">
                 
                 <a class="login-btn" href="login.php"><i class="fa-solid fa-right-to-bracket"></i></a>
              
             </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Riyaqas_main_menu" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggle-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="Riyaqas_main_menu">
            <div class="logo-wrapper desktop-logo">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo.png" alt="logo">
                </a>
            </div>
            <ul class="navbar-nav">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a class="activee" href="about.php">About</a>
                </li>
                <li>
                    <a href="service.php">Services</a>
                </li>
                <!-- <li class="menu-item-has-children">
                    <a href="#">Career</a>
                    <ul class="sub-menu">
                        <li><a href="job-listing.php">Job listing</a></li>
                        <li><a href="job-details.php">Job Details</a></li>
                        <li><a href="job-apply.php">Job Apply</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <li>
                <a href="prices.php">Prices</a>
                </li>
            </ul>
        </div>

        <!-- calling cart function -->

  <form action="" method="POST">
        <div class="nav-right-content">
            <ul>
                <li class="search">
                    <i class="ti-search"></i>
                </li>

                <li class="cart" >
                    <div class="cart"><i class="las la-shopping-cart"></i><?php cart_item()?></div>
                    
                    <div class="widget_shopping_cart_content cart-items-wrapper">

                        <ul>
                        
                            
                            <?php
          
            $get_ip_address = getIPAddress();  
            $total_price=0;
            $cart_query="select * from `cart_details` where ip_address='$get_ip_address'";
            $result=mysqli_query($conn,$cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count>0){
            while($row=mysqli_fetch_array($result)){
                $product_id=$row['product_id'];
                $select_products="select * from `products` where product_id='$product_id'";
                $result_products=mysqli_query($conn,$select_products);
                while($row_product_price=mysqli_fetch_array($result_products)){
                    $product_price=array($row_product_price['product_price']);
                    $price_table=$row_product_price['product_price'];
                    $product_title=$row_product_price['product_title'];
                    $product_image=$row_product_price['product_image'];
                    $product_values=array_sum($product_price);
                    $total_price+=$product_values;
                    ?>
           <li>
            <div class="media">
            <div class="media-left">
                <img class="car" src="product_images/<?php echo$product_image?>" alt="img">
            </div>
            <div class="media-body">
                <a class="title" href="#"><?php echo $product_title?></a>
                <p >Quantity: 
                <div class="ok"></div>
                    <input name="qty" type="text" min="1" value="" class="quantity-input">
               
                    <input type="submit" class="aa" name="update_cart" value="✔" >
               </p>
                    <?php
                $get_ip_address = getIPAddress();
                if(isset($_POST['update_cart'])){
                    $quantities=$_POST['qty'];
                    $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_address'"; 
                    $result_products_quantity=mysqli_query($conn,$update_cart);
                    $total_price=$total_price*$quantities;
                }
                ?>
                

                <span class="price">$ <?php echo $price_table?></span>
            </div>
        </div>
        <input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>" id="">
        <input type="submit" class=" bb" name="remove_cart" value="X" >
    </li>
           
       
                    <?php
             }
            }
        }
        else{
            echo"<h7>Your Cart is Empty</h7>";
        }
        ?>
                        </ul>
                       
                        <p class="total">
                            <strong>Subtotal:</strong> 
                            <span class="amount"></span>
                                <span class="woocommerce-Price-currencySymbol">$</span><?php echo $total_price ?>
                        </p>
                        <p class="buttons">
                            <a href="check.php" class="button">View Card & Check out</a>
                        </p>
                    </div> 
                     
                </li>


                <?php
if (!isset($_SESSION['username'])) {
    echo "<li class=''>
            <a class='login-btn' href='login.php' title='Login'><i class='fa-solid fa-right-to-bracket'></i></a>
          </li>";
} else {
    echo "<li class=''>
            <a class='login-btn' href='logout.php' title='Logout'><i class='fa fa-sign-out-alt logout-icon'></i></a>
          </li>";
}
?>

                
            </ul>
        </div>
    </form>
    <!-- function to remove items -->
    <?php
    function remove_cart_item(){
        global $conn;
        if(isset($_POST['remove_cart'])){
            foreach($_POST['removeitem'] as $remove_id){
                echo $remove_id;
                $delete_query="Delete from `cart_details` where product_id=$remove_id";
                $run_delete=mysqli_query($conn,$delete_query);
                if($run_delete){
                    echo "<script>window.open('prices.php','_self')</script>";
                }
            }
        }
    }
    echo $remove_item=remove_cart_item();
    ?>
    
    </div>
</nav>
