<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
  <?php
  $username=$_SESSION['username'];
  $get_user="select * from `user_table` where username='$username'";
  $result=mysqli_query($conn,$get_user);
  $row_fetch=mysqli_fetch_assoc($result);
  $user_id=$row_fetch['user_id'];
  // echo $user_id;
  ?>
<h3 class="text-center mt-4 ">All My Orders</h3>
<table class="table table-bordered mt-4">
  <thead class="bg-secondary text-light">
      <tr>
    <th>S/N</th>
    <th>Amount Due</th>
    <th>Total Products</th>
    <th>Invoice Number</th>
    <th>Date</th>
    <th>Complete/Incomplete</th>
    <th>Status</th>
  </tr>
  </thead>

  <tbody>
    <?php
      $get_order_details="Select * from `user_orders` where user_id=$user_id"; 
      $result_orders=mysqli_query($conn,$get_order_details);
      $number=1;
      while($row_orders=mysqli_fetch_assoc($result_orders)){
        $order_id=$row_orders['order_id'];
        $amount_due=$row_orders['amount_due'];
        $total_products=$row_orders['total_products'];
        $invoice_number=$row_orders['invoice_number'];
        $order_status=$row_orders['order_status'];
        if($order_status=='pending'){
          $order_status='Incomplete';
        }else{
          $order_status='Complete';
        }
        $order_date=$row_orders['order_date'];
       
        echo" <tr>
      <td>$number</td>
      <td>€$amount_due</td>
      <td>$total_products</td>
      <td>$invoice_number</td>
      <td>$order_date</td>
      <td>$order_status</td>";
      ?>
      <?php 
      if ($order_status=='Complete'){
        echo "<td>Paid</td>";
      }else{
        echo"<td><a  href='confirm_payment.php?order_id=$order_id' class='text-success'>Confirm</a></td>
</tr>";
      }
    
    $number++;
      }
    ?>
   
  </tbody>
</table>
</body>

</html>
