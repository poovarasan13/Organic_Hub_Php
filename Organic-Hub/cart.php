<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>

<?php include 'header.php'; ?>




<section class="container my-5 mt-5">
   <h1 class="text-center mb-5">Products Added</h1>

   <div class="row g-4">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
      ?>
      <div class="col-md-6 col-lg-4">
         <div class="card shadow-sm h-100">
            <div class="card-body">
               <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times text-danger float-end" onclick="return confirm('Delete this item from cart?');"></a>
               <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" class="img-fluid mb-3" alt="Product Image">
               <h5 class="card-title"><?php echo $fetch_cart['name']; ?></h5>
               <p class="card-text text-danger">$<?php echo $fetch_cart['price']; ?>/-</p>
               <form action="" method="post" class="d-flex align-items-center">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>" class="form-control w-50 me-2">
                  <input type="submit" name="update_cart" value="Update" class="btn btn-warning">
               </form>
               <p class="mt-3">Subtotal: <span class="text-danger">$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span></p>
            </div>
         </div>
      </div>
      <?php
         $grand_total += $sub_total;
         }
      } else {
         echo '<p class="text-center">Your cart is empty</p>';
      }
      ?>
   </div>

   <div class="text-center mt-5">
      <a href="cart.php?delete_all" class="btn btn-danger <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Delete all items from cart?');">Delete All</a>
   </div>

   <div class="cart-total mt-5 text-center">
      <p class="fs-4">Grand Total: <span class="text-danger">$<?php echo $grand_total; ?>/-</span></p>
      <div class="d-flex justify-content-center">
         <a href="shop.php" class="btn btn-outline-primary me-3">Continue Shopping</a>
         <a href="checkout.php" class="btn btn-success <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to Checkout</a>
      </div>
   </div>
</section>


<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
