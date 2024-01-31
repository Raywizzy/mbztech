<?php
session_start();
$servername = "localhost";
$db_username = "your_db_username";
$db_password = "your_db_password";
$dbname = "mbzstore";

$conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

include 'common_functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Get the user_id from the session
// Get the user_id from the session
$user_id = $_SESSION['user_id'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBZTECHNOLOGY</title>
    <style>
    .quantity-control {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .quantity-button {
        background-color: #f0f0f0;
        border: none;
        color: #333;
        font-weight: bold;
        font-size: 1.2em;
        cursor: pointer;
        padding: 5px 10px;
        transition: background-color 0.3s;
       
        
    }
.qq{
    margin-right: 20px;
}

.oo{
    margin-left: 20px;
}
    .quantity-button:hover {
        background-color: #ddd;
    }

</style>
<?php
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM `user_table` WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];

    
?>
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
    <link rel="stylesheet" href="assets/css/slick.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- nice-select -->
    <link rel="stylesheet" href="assets/css/nice-select.css">
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
<?php 
            cart();
         ?>
         <?php

?>
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

<!-- breadcrumb area start -->
<div class="breadcrumb-area" style="background-image:url(assets/img/page-title-bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">Checkout</h1>
                    <!-- <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li>Checkout</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->

<div class="checkout-page-area pd-top-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="checkout-form-wrap">
                    <div class="checkout-title">
                        <div class="row">
                            <div class="col-xl-5 col-lg-12 col-md-6">
                                <h6>Contact information</h6>
                            </div>  
                            <!-- <div class="col-xl-7 col-lg-12 col-md-6 text-xl-right text-lg-left text-md-right">
                                <span>Already have an account?</span>
                                <a id="signIn-btn" href="#">Sign in /</a>
                                <a id="signUp-btn" href="#">Sign Up</a>
                            </div>   -->
                        </div>
                    </div>
                    <div class="checkout-form">
                    <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay" id="paymentForm" class="riyaqas-form-wrap">
                            <div class="row custom-gutters-20">
                                <div class="col-md-12">
                                    <div class="single-input-wrap">
                                        <input id="customer-email" type="text" class="single-input">
                                        <label>E-mail</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-wrap">
                                        <input id="customer-first-name" type="text" class="single-input">
                                        <label>First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-wrap">
                                        <input id="customer-last-name" type="text" class="single-input">
                                        <label>Last Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-input-wrap">
                                        <input id="customer-address" type="text" class="single-input">
                                        <label>Address</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-input-wrap">
                                        <input id="customer-city" type="text" class="single-input">
                                        <label>City</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-wrap">
                                        <select id="customer-country" class="select single-select">
                                        <option value="" disabled selected>Country</option>
                                                            <!-- Africa -->
                  <option value="EG">Egypt</option>
                  <option value="NG">Nigeria</option>
                  <option value="CD">Ghane</option>
                  <option value="ZA">South Africa</option>
                  <!-- Asia -->
                  <option value="CN">China</option>
                  <option value="JP">Japan</option>
                  <option value="KR">South Korea</option>
                  <!-- Europe -->
                  <option value="FR">France</option>
                  <option value="DE">Germany</option>
                  <option value="IT">Italy</option>
                  <option value="ES">Spain</option>
                  <option value="GB">United Kingdom</option>
                  <!-- North America -->
                  <option value="CA">Canada</option>
                  <option value="MX">Mexico</option>
                  <option value="US">United States</option>
                  <!-- South America -->
                  <option value="AR">Argentina</option>
                  <option value="BR">Brazil</option>
                  <option value="CL">Chile</option>
                  <option value="CO">Colombia</option>
                  <option value="PE">Peru</option>
                </select>
                                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-wrap">
                                        <input id="customer-postal-code" type="text" class="single-input">
                                        <label>Postal code</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-wrap">
                                        <input id="customer-phone" type="text" class="single-input">
                                        <label>Phone</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12 padding-top-50">
                                    <div class="checkout-title">
                                        <h6>Payment Method</h6>
                                    </div>
                                    <div class="payment-method">
                                        <ul>
                                            <li>
                                                <a href="#"><img src="assets/img/checkout/1.svg" alt="img"></a>
                                                <a href="#"><img src="assets/img/checkout/Flutterwave-New-Logo-2022-Transparent.webp" width="150" alt="img"></a>
                                
                                            </li>
                                            <li><a href="#">Cash On Delivery</a></li>
                                            <li><a href="#">Bank Account Payment</a></li>
                                        </ul>
                                    </div>
                                </div> -->
                                <!-- <div class="col-12 text-right">
                                    <a class="btn btn-green" href="error.php">Place Order</a>
                                </div>  -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!-- HTML -->

<div class="col-lg-5">
    <div class="checkout-form-product">
        <div class="order-table table-responsive">
            <table class="table">
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
                <tbody>
                    <tr>
                        <td>
                            <div class="media single-cart-product">
                                <div class="media-body">
                                    <span id="selected-tier">Tier: <?php echo $product_title?></span><br>
                              
                                </div>
                            </div>
                        </td>
                        <td class="cart-product-price text-center">
                            <span id="selected-price">€ <?php echo $price_table?></span>
                        </td>
                    </tr>
                </tbody>
            </table>        
            <?php
             }
            }
        }
        else{
            echo"<h7>Your Cart is Empty</h7>";
        }
        ?>
            <div class="total-shapping-area-wrap">
            <div class="total-shapping-area">
                <div class="charge">
        
                    <span>Total:</span>
                        <span id="subtotal" class="amount float-right">€<?php echo $total_price ?></span>
                    </div>
                   
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="order-table table-responsive">
    <div class="col-md-12 padding-top-50">
                                    <div class="checkout-title">
                                        <h6>Payment Method</h6>
                                    </div>
                                    <div class="payment-method">
                                        <!-- <ul>
                                            <li class="okkk">
                                            <a href="#"><img src="assets/img/checkout/1.svg" alt="Payment Method 1"></a>
        <br><br>
        <a class="ff" type="submit"  id="paymentButton" >
    <img src="assets/img/checkout/Flutterwave-New-Logo-2022-Transparent.webp" width="150" alt="img">
</a>


                                                <br>
                                                <br>
                                                <a href="#"><img src="assets/img/checkout/globalpay.jpg" width="100" alt="img"></a>
                                                <br>
                                                <br>
                                                <a href="stripe.html"><img src="assets/img/checkout/R (8).png" width="70" alt="img"></a>
                                            </li>
                                             
                                           
                                        </ul> -->
                                    </div>
                                </div>
                                <div class="col-12 text-left">
                                <?php
// Add this before generating the link to order.php
?>

                                <a class="btn btn-green" href="order.php?user_id=<?php echo $user_id; ?>">Place Order</a>
                                </div> 
    </div>
    </div>
</div>


           
<!-- footer area start -->

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
    <!-- slider js -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cssslider.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <!-- waypoint -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- counterup -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- imageloaded -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- nice-select -->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!-- world map -->
    <script src="assets/js/worldmap-libs.js"></script>
    <script src="assets/js/worldmap-topojson.js"></script>
    <script src="assets/js/mediaelement.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>
  
</body>
</html>

