
<?php
     $servername = "localhost";
     $db_username = "your_db_username";
     $db_password = "your_db_password";
     $dbname = "mbzstore";
     
     $conn = mysqli_connect('localhost', 'root', '', 'mbzstore');
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     };
     
     if (!function_exists('getIPAddress')) {

     // get ip address function
     function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
}
    // $ip = getIPAddress();  
    // echo 'User Real IP Address - '.$ip; 

    //cart function
    if (!function_exists('cart')) {
    function cart(){
        if(isset($_GET['add_to_cart'])){
            global $conn;
            $get_ip_address = getIPAddress();  
            $get_product_id=$_GET['add_to_cart'];
            $select_query="select * from `cart_details` where ip_address= '$get_ip_address' and product_id=$get_product_id";
            $result=mysqli_query($conn,$select_query);
            $num_of_rows=mysqli_num_rows($result);
            if ($num_of_rows>0){
                echo "<script>alert('This item is already present in your cart')</script>";
                echo"<script>window.open('prices.php','_self')</script>";
            }else{
                $insert_query="INSERT INTO `cart_details`(product_id,ip_address,quantity) VALUES ($get_product_id,'$get_ip_address',0)";
                $result=mysqli_query($conn,$insert_query);
                echo "<script>alert('Item added to cart')</script>";
                echo"<script>window.open('prices.php','_self')</script>";
            }
        }
    }
}

    //function to get cart item numbers
    if (!function_exists('cart_item')) {

    function cart_item(){
        if(isset($_GET['add_to_cart'])){
            global $conn;
            $get_ip_address = getIPAddress();  
            $select_query="select * from `cart_details` where ip_address= '$get_ip_address'";
            $result=mysqli_query($conn,$select_query);
            $count_cart_items=mysqli_num_rows($result);
        }else{
            global $conn;
            $get_ip_address = getIPAddress();  
            $select_query="select * from `cart_details` where ip_address= '$get_ip_address'";
            $result=mysqli_query($conn,$select_query);
            $count_cart_items=mysqli_num_rows($result);
            }
            echo $count_cart_items;
        }
    }
        
        //total price function
        if (!function_exists('total_cart_price')) {

        function total_cart_price(){
            global $conn;
            $get_ip_address = getIPAddress();  
            $total_price=0;
            $cart_query="select * from `cart_details` where ip_address='$get_ip_address'";
            $result=mysqli_query($conn,$cart_query);
            while($row=mysqli_fetch_array($result)){
                $product_id=$row['product_id'];
                $select_products="select * from `products` where product_id='$product_id'";
                $result_products=mysqli_query($conn,$select_products);
                while($row_product_price=mysqli_fetch_array($result_products)){
                    $product_price=array($row_product_price['product_price']);
                    $product_values=array_sum($product_price);
                    $total_price+=$product_values;
            
                }
            }
            echo $total_price;
        }
    }
        //get user order details
        if (!function_exists('get_user_order_details')) {

        function get_user_order_details(){
            global $conn;
            $username = $_SESSION['username'];
            $get_details="Select * from `user_table` where username='$username'";
            $result_query=mysqli_query($conn,$get_details);
            while($row_query=mysqli_fetch_array($result_query)){
                $user_id=$row_query['user_id'];
                if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['my_orders'])){
                        if(!isset($_GET['delete_account'])){
                            $get_orders="Select * from `user_orders` where user_id=$user_id and order_status='pending'";
                            $result_orders_query=mysqli_query($conn,$get_orders);
                            $row_count=mysqli_num_rows($result_orders_query);
                            if($row_count>0){
                                echo"<p class='text-center'>You have $row_count pending order(s)</p>
                                <p class='text-center text-success o'><a href='profile.php?my_orders'>View Order Details</a></p>";
                            }else{
                                echo"<p class='text-center'>You have 0 pending order(s)</p>
                                <p class='text-center text-success o'><a href='index.php?my_orders'>View More Services</a></p>";
                            }
                        }
                    }
                }
            }
        }
    }
?>
