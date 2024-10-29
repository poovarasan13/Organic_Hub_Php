<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Organic Hub</title>
   <link rel="shortcut icon" type="icon" href="./Images/image.png">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <style>
      @media (min-width:768px) {
         .landing {
            height: 400px;
         }
      }

      @media(min-width:768px) {
         .card-design {
            width: 220px;
         }
      }

      .opac {
         opacity: 0.7;
      }
   </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg bg-success fixed-top p-4 ">
   <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
         <span class="navbar-toggler-icon"></span>
      </button>

      <a class="navbar-brand mx-auto">
         <h3 class="mb-0 fw-bold text-white text-center">Organic Hub</h3>
      </a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-md-4">
            <li class="nav-item active fw-bold"><a class="nav-link text-white icon-link-hover" href="home.php">Home</a></li>
            <li class="nav-item active fw-bold"><a class="nav-link text-white icon-link-hover" href="shop.php">Products</a></li>
            <li class="nav-item active fw-bold"><a class="nav-link text-white icon-link-hover" href="about.php">About</a></li>
         
            <li class="nav-item active fw-bold"><a class="nav-link text-white icon-link-hover" href="orders.php">Orders</a></li>
            <li class="nav-item active fw-bold"><a class="nav-link text-white icon-link-hover" href="cart.php">Cart</a></li>
            <li class="nav-item active fw-bold"><a class="nav-link text-white icon-link-hover" href="contact.php">Contact</a></li>
            <li class="nav-item active fw-bold"><button class="nav-link text-white icon-link-hover"   data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button></li>
         </ul>
      </div>
   </div>
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="login.php" class="btn btn-primary">Confirm Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Message Display Section -->
<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <span>'.$msg.'</span>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
   }
}
?>

<!-- <header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>
   </div>
</header> -->

<!-- Add your additional content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
