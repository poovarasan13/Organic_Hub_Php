<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Bootstrap CDN link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom Admin CSS -->
   <!-- <link rel="stylesheet" href="./admin_style.css"> -->
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="messages py-5">
   <div class="container mt-5 pt-4">
      <h1 class="title text-center mb-4">Messages</h1>

      <div class="row g-4">
         <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            if(mysqli_num_rows($select_message) > 0){
               while($fetch_message = mysqli_fetch_assoc($select_message)){
         ?>
         <div class="col-lg-4 col-md-6">
            <div class="card h-100">
               <div class="card-body">
                  <h5 class="card-title">User ID: <span class="text-muted"><?php echo $fetch_message['user_id']; ?></span></h5>
                  <p class="card-text">Name: <strong><?php echo $fetch_message['name']; ?></strong></p>
                  <p class="card-text">Number: <strong><?php echo $fetch_message['number']; ?></strong></p>
                  <p class="card-text">Email: <strong><?php echo $fetch_message['email']; ?></strong></p>
                  <p class="card-text">Message: <span class="text-muted"><?php echo $fetch_message['message']; ?></span></p>
                  <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" 
                     class="btn btn-danger" 
                     onclick="return confirm('Delete this message?');">
                     Delete Message
                  </a>
               </div>
            </div>
         </div>
         <?php
               }
            } else {
               echo '<p class="text-center text-muted">You have no messages!</p>';
            }
         ?>
      </div>
   </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom Admin JS -->
<script src="js/admin_script.js"></script>

</body>
</html>
