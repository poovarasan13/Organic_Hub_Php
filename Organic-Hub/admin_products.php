<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">
   <!-- Bootstrap CSS CDN Link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom CSS -->
   <!-- <link rel="stylesheet" href="./admin_style.css"> -->

</head>
<body>

<?php include 'admin_header.php'; ?>

<!-- Product CRUD Section Starts -->

<section class="container my-5">
   <h1 class="text-center mb-4"> Products</h1>
         <div class="row justify-content-center">
            <div class="col-5">
   <form action="" method="post" enctype="multipart/form-data" class="mb-5 p-4 shadow rounded bg-light">
      <h3 class="text-center">Add Product</h3>
      <div class="mb-3">
         <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
      </div>
      <div class="mb-3">
         <input type="number" min="0" name="price" class="form-control" placeholder="Enter product price" required>
      </div>
      <div class="mb-3">
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="form-control" required>
      </div>
      <button type="submit" name="add_product" class="btn btn-primary w-100">Add Product</button>
   </form>
</div>
</div>
   <!-- Show Products -->
   <div class="row">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="col-md-4 mb-4">
         <div class="card h-100">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="card-img-top" alt="Product Image">
            <div class="card-body">
               <h5 class="card-title"><?php echo $fetch_products['name']; ?></h5>
               <p class="card-text">$<?php echo $fetch_products['price']; ?>/-</p>
               <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="btn btn-warning">Update</a>
               <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this product?');">Delete</a>
            </div>
         </div>
      </div>
      <?php
            }
         } else {
            echo '<p class="text-center">No products added yet!</p>';
         }
      ?>
   </div>

   <!-- Edit Product Form -->
   <section class="edit-product-form">
      <?php
         if(isset($_GET['update'])){
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
            if(mysqli_num_rows($update_query) > 0){
               while($fetch_update = mysqli_fetch_assoc($update_query)){
      ?>
      <form action="" method="post" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
         <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
         <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
         <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="Product Image" class="img-fluid mb-3">
         <div class="mb-3">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="form-control" required placeholder="Enter product name">
         </div>
         <div class="mb-3">
            <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="form-control" required placeholder="Enter product price">
         </div>
         <div class="mb-3">
            <input type="file" class="form-control" name="update_image" accept="image/jpg, image/jpeg, image/png,image/webp,image/html">
         </div>
         <button type="submit" name="update_product" class="btn btn-success w-100">Update</button>
         <button type="reset" id="close-update" class="btn btn-secondary w-100 mt-2">Cancel</button>
      </form>
      <?php
               }
            }
         } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
         }
      ?>
   </section>

</section>

<!-- Bootstrap JS CDN Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="js/admin_script.js"></script>

</body>
</html>
