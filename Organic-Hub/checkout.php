<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <!-- <link rel="stylesheet" href="./style.css"> -->
</head>
<body>

<?php include 'header.php'; ?>



<!-- Display Order Section -->
<section class="display-order container my-5">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <?php  
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                  $grand_total += $total_price;
         ?>
         <p class="text-center"><?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span></p>
         <?php
               }
            }else{
               echo '<p class="empty text-center">Your cart is empty</p>';
            }
         ?>
         <div class="grand-total text-center mt-4">Grand Total: <span>$<?php echo $grand_total; ?>/-</span></div>
      </div>
   </div>
</section>

<!-- Checkout Form -->
<section class="checkout container my-5">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <form action="" method="post" class="p-4 border rounded">
            <h4 class="text-center mb-4">Place Your Order</h4>
            <div class="row g-3">
               <div class="col-md-6">
                  <label for="name" class="form-label">Your Name:</label>
                  <input type="text" name="name" class="form-control" id="name" required placeholder="Enter your name">
               </div>
               <div class="col-md-6">
                  <label for="number" class="form-label">Your Number:</label>
                  <input type="number" name="number" class="form-control" id="number" required placeholder="Enter your number">
               </div>
               <div class="col-md-6">
                  <label for="email" class="form-label">Your Email:</label>
                  <input type="email" name="email" class="form-control" id="email" required placeholder="Enter your email">
               </div>
               <div class="col-md-6">
                  <label for="method" class="form-label">Payment Method:</label>
                  <select name="method" id="method" class="form-select">
                     <option value="cash on delivery">Cash on Delivery</option>
                     <option value="credit card">Credit Card</option>
                     <option value="paypal">PayPal</option>
                     <option value="paytm">Paytm</option>
                  </select>
               </div>
               <div class="col-md-6">
                  <label for="flat" class="form-label">Address Line 01:</label>
                  <input type="number" min="0" name="flat" class="form-control" id="flat" required placeholder="Flat no.">
               </div>
               <div class="col-md-6">
                  <label for="street" class="form-label">Address Line 02:</label>
                  <input type="text" name="street" class="form-control" id="street" required placeholder="Street name">
               </div>
               <div class="col-md-6">
                  <label for="city" class="form-label">City:</label>
                  <input type="text" name="city" class="form-control" id="city" required placeholder="City">
               </div>
               <div class="col-md-6">
                  <label for="state" class="form-label">State:</label>
                  <input type="text" name="state" class="form-control" id="state" required placeholder="State">
               </div>
               <div class="col-md-6">
                  <label for="country" class="form-label">Country:</label>
                  <input type="text" name="country" class="form-control" id="country" required placeholder="Country">
               </div>
               <div class="col-md-6">
                  <label for="pin_code" class="form-label">Pin Code:</label>
                  <input type="number" min="0" name="pin_code" class="form-control" id="pin_code" required placeholder="123456">
               </div>
            </div>
            <div class="text-center mt-4">
               <input type="submit" value="Order Now" class="btn btn-primary" name="order_btn">
            </div>
         </form>
      </div>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>
