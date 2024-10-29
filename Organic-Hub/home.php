<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
      echo "<script>var cartAdded = true;</script>"; 
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Organic Hub</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <style>
    
@media(min-width:768px) {
         .card-design {
            width: 220px;
         }
      }
      @media(min-width:311px)
     {
      .card-design{
        width: 147px;
        height:280px;
      }
     }
     @media(min-width:375px)
     {
      .card-design{
        width: 160px;
        height:300px;
      }
     }
     @media(min-width:375px)
     {
      .card-design{
        width: 170px;
        height:300px;
      }
     }
     @media(min-width:425px)
     {
      .card-design{
        width: 190px;
        height:300px;
      }
     }
     @media(min-width:768px)
     {
      .card-design{
        width:220px;
        height:340px;
      }
     }
   </style>
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>


<section class="" id="landingPageContent" >
    <div id="carouselExampleFade" class="carousel slide carousel-fade pt-2 mt-4" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active pt-5">
          <img src="./Images/cover/cover1.jpg"  class="d-block w-100 landing" alt="...">
        </div>
        <div class="carousel-item pt-5">
          <img src="./Images/cover/cover3.jpg" class="d-block w-100 landing " alt="...">
        </div>
        <div class="carousel-item pt-5">
          <img src="./Images/cover/cover2.jpg" class="d-block w-100 landing" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden ">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</section>


<!-- Hero Section -->
<section class="container mt-5 pt-5 text-center">
   <h3>Grocery Items at Your Doorstep</h3>
   <p>The best part of grocery shopping is discovering new products and flavors.</p>
   <a href="about.php" class="btn btn-outline-success">Discover More</a>
</section>

<!-- Products Section -->
<section class="container-fluid my-5">
   <h1 class="text-center mb-5">Latest Products</h1>
   <div class="row justify-content-center  row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
               $product_id = $fetch_products['id'];  // Assuming you have an ID field in the products table
      ?>
   <div class="col-md-4 mb-4">
   <form action="" method="post" class="card shadow-sm text-center ">
      <img class="card-img-top img-fluid" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Product Image">
      <div class="card-body">
         <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
         <p class="card-text text-danger">$<?php echo $fetch_products['price']; ?>/-</p>
         <div class="row justify-content-center mb-3 align-items-center">
            <div class="col-md-4 col-6">
               <input type="number" min="1" name="product_quantity" value="1" class="form-control text-center">
            </div>
            <div class="col-md-3 col-6">KG</div>
         </div>
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <button type="submit" name="add_to_cart" class="btn btn-primary w-100">Add to Cart</button>
      </div>
   </form>
</div>
      <?php
         }
      } else {
         echo '<p class="text-center">No products added yet!</p>';
      }
      ?>

   </div>
   <div class="text-center mt-4">
      <a href="shop.php" class="btn btn-outline-success">Load More</a>
   </div>
</section>

<!-- Certified Section -->
<!-- <section class="container-fluid mt-5 pt-4 bg-warning opac text-center">
   <h4>We Are Certified Organic!</h4>
   <div class="row justify-content-center">
      <div class="col-md-3 col-6">
         <img src="./Images/1.avif" class="p-3 img-fluid w-75 h-75">
      </div>
      <div class="col-md-3 col-6">
         <img src="./Images/2.avif" class="p-3 mt-3 img-fluid w-75 h-50">
      </div>
   </div>
</section> -->
<!-- Logout Confirmation Modal -->
<!-- Add to Cart Confirmation Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Cart Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Product added to cart successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
                <a href="cart.php" class="btn btn-primary">Go to Cart</a>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>


    document.addEventListener('DOMContentLoaded', function() {
       
        if (typeof cartAdded !== 'undefined' && cartAdded) {
           
            var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        }
    });
</script>


</body>
</html>
