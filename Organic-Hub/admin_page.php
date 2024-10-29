<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <!-- <link rel="stylesheet" href="./admin_style.css"> -->

</head>
<body>

<?php include 'admin_header.php'; ?>

<!-- Admin Dashboard Section Starts -->
<section class="dashboard container my-5">
   <h1 class="text-center mb-5">Admin Dashboard</h1>

   <div class="row g-4">

      <!-- Total Pendings Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $total_pendings = 0;
                  $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                  if(mysqli_num_rows($select_pending) > 0){
                     while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                     };
                  }
               ?>
               <h3 class="card-title">$<?php echo $total_pendings; ?>/-</h3>
               <p class="card-text">Total Pendings</p>
            </div>
         </div>
      </div>

      <!-- Completed Payments Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $total_completed = 0;
                  $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                  if(mysqli_num_rows($select_completed) > 0){
                     while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                     }
                  }
               ?>
               <h3 class="card-title">$<?php echo $total_completed; ?>/-</h3>
               <p class="card-text">Completed Payments</p>
            </div>
         </div>
      </div>

      <!-- Orders Placed Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                  $number_of_orders = mysqli_num_rows($select_orders);
               ?>
               <h3 class="card-title"><?php echo $number_of_orders; ?></h3>
               <p class="card-text">Orders Placed</p>
            </div>
         </div>
      </div>

      <!-- Products Added Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                  $number_of_products = mysqli_num_rows($select_products);
               ?>
               <h3 class="card-title"><?php echo $number_of_products; ?></h3>
               <p class="card-text">Products Added</p>
            </div>
         </div>
      </div>

      <!-- Normal Users Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                  $number_of_users = mysqli_num_rows($select_users);
               ?>
               <h3 class="card-title"><?php echo $number_of_users; ?></h3>
               <p class="card-text">Normal Users</p>
            </div>
         </div>
      </div>

      <!-- Admin Users Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                  $number_of_admins = mysqli_num_rows($select_admins);
               ?>
               <h3 class="card-title"><?php echo $number_of_admins; ?></h3>
               <p class="card-text">Admin Users</p>
            </div>
         </div>
      </div>

      <!-- Total Accounts Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                  $number_of_account = mysqli_num_rows($select_account);
               ?>
               <h3 class="card-title"><?php echo $number_of_account; ?></h3>
               <p class="card-text">Total Accounts</p>
            </div>
         </div>
      </div>

      <!-- New Messages Box -->
      <div class="col-lg-3 col-md-6">
         <div class="card text-center shadow-sm">
            <div class="card-body">
               <?php
                  $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                  $number_of_messages = mysqli_num_rows($select_messages);
               ?>
               <h3 class="card-title"><?php echo $number_of_messages; ?></h3>
               <p class="card-text">New Messages</p>
            </div>
         </div>
      </div>

   </div>
</section>
<!-- Admin Dashboard Section Ends -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
