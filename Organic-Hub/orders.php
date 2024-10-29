<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- Bootstrap CDN link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Custom CSS file link -->
   <!-- <link rel="stylesheet" href="./style.css"> -->
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<!-- Hero Section -->


<!-- Orders Section -->
<section class="container my-5">
   <h1 class="text-center mb-5">Placed Orders</h1>

   <div class="row">
      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="col-md-6 col-lg-4 mb-4">
         <div class="card shadow-sm h-100">
            <div class="card-body">
               <h5 class="card-title">Order Details</h5>
               <p class="card-text">Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
               <p class="card-text">Name: <span><?php echo $fetch_orders['name']; ?></span></p>
               <p class="card-text">Number: <span><?php echo $fetch_orders['number']; ?></span></p>
               <p class="card-text">Email: <span><?php echo $fetch_orders['email']; ?></span></p>
               <p class="card-text">Address: <span><?php echo $fetch_orders['address']; ?></span></p>
               <p class="card-text">Payment Method: <span><?php echo $fetch_orders['method']; ?></span></p>
               <p class="card-text">Your Orders: <span><?php echo $fetch_orders['total_products']; ?></span></p>
               <p class="card-text">Total Price: <span class="text-danger">$<?php echo $fetch_orders['total_price']; ?>/-</span></p>
               <p class="card-text">Payment Status: 
                  <span class="<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'text-danger' : 'text-success'; ?>">
                     <?php echo $fetch_orders['payment_status']; ?>
                  </span>
               </p>
            </div>
         </div>
      </div>
      <?php
         }
      } else {
         echo '<p class="text-center">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS CDN link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
