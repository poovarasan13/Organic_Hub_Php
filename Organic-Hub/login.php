<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="shortcut icon" type="icon" href="./images/image.png">
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

<!-- Login Form Container -->
<div class="container mt-5 pt-5">
   <div class="row justify-content-center mt-5 pt-5">
      <div class="col-md-4">
         <div class="card shadow-sm">
            <div class="card-body">
               <h3 class="card-title text-center mb-4">Login Now</h3>
               <form action="" method="post">
                  <div class="mb-3">
                     <label for="email" class="form-label">Email Address</label>
                     <input type="email" name="email" id="email" placeholder="Enter your email" required class="form-control">
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" name="password" id="password" placeholder="Enter your password" required class="form-control">
                  </div>
                  <div class="d-grid">
                     <button type="submit" name="submit" class="btn btn-primary">Login Now</button>
                  </div>
                  <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register now</a></p>
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
