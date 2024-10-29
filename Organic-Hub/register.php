<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'Registered successfully!';
         header('location:login.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <!-- <link rel="stylesheet" href="./style.css"> -->
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>'.$msg.'</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
   }
}
?>

<!-- Registration Form Container -->
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-4">
         <div class="card shadow-sm">
            <div class="card-body">
               <h3 class="card-title text-center mb-4">Register Now</h3>
               <form action="" method="post">
                  <div class="mb-3">
                     <label for="name" class="form-label">Name</label>
                     <input type="text" name="name" id="name" placeholder="Enter your name" required class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Email Address</label>
                     <input type="email" name="email" id="email" placeholder="Enter your email" required class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" name="password" id="password" placeholder="Enter your password" required class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="cpassword" class="form-label">Confirm Password</label>
                     <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" required class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="user_type" class="form-label">User Type</label>
                     <select name="user_type" id="user_type" class="form-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                     </select>
                  </div>
                  <div class="d-grid">
                     <button type="submit" name="submit" class="btn btn-primary">Register Now</button>
                  </div>
                  <p class="mt-3 text-center">Already have an account? <a href="login.php">Login now</a></p>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
