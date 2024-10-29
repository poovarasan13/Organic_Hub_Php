<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message already sent!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message sent successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <!-- <link rel="stylesheet" href="./style.css"> -->

</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<!-- Page Heading -->
<!-- <div class="bg-light p-5 text-center">
   <h3>Contact Us</h3>
   <p><a href="home.php">Home</a> / Contact</p>
</div> -->

<!-- Contact Form Section -->
<section class="container py-5 mt-5 ">
   <div class="row justify-content-center mt-5 pt-3">
      <div class="col-md-7 col-lg-6">
         <?php
            if(isset($message)){
               foreach($message as $msg){
                  echo '<div class="alert alert-info">'.$msg.'</div>';
               }
            }
         ?>
         <div class="card shadow-sm">
            <div class="card-body">
               <h3 class="card-title text-center mb-4">Contact Us</h3>
               <form action="" method="post">
                  <div class="mb-3">
                     <label for="name" class="form-label">Your Name</label>
                     <input type="text" name="name" id="name" required placeholder="Enter your name" class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Your Email</label>
                     <input type="email" name="email" id="email" required placeholder="Enter your email" class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="number" class="form-label">Your Number</label>
                     <input type="number" name="number" id="number" required placeholder="Enter your number" class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="message" class="form-label">Your Message</label>
                     <textarea name="message" id="message" required placeholder="Enter your message" class="form-control" rows="5"></textarea>
                  </div>
                  <div class="d-grid">
                     <button type="submit" name="send" class="btn btn-primary">Send Message</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>
