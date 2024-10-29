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
   <title>About Us</title>
   <link rel="shortcut icon" type="icon" href="./images/image.png">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>


<?php include 'header.php'; ?>


<section class="about py-5 bg-light">
   <div class="container mt-5 pt-3">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <img src="images/grocery-items.jpeg" class="img-fluid rounded" alt="Grocery Items">
         </div>
         <div class="col-lg-6">
            <h3>Why Organic Hub?</h3>
            <p class="mt-4">
               <strong>1. Quality Assurance:</strong> At Kanhaiya Grocery Store, we prioritize quality above all else, ensuring that our products meet the highest standards to satisfy our customers' needs.<br><br>
               <strong>2. Wide Variety:</strong> We offer an extensive range of fresh produce, pantry essentials, spices, and specialty items, providing a one-stop-shop experience for all your grocery needs.<br><br>
               <strong>3. Competitive Prices:</strong> Our commitment to offering competitive prices ensures that you get the best value for your money without compromising on quality.<br><br>
            </p>
            <a href="contact.php" class="btn btn-primary mt-3">Contact Us</a>
         </div>
      </div>
   </div>
</section>


<section class="reviews py-5">
   <div class="container">
      <h1 class="text-center mb-5">Customer Reviews</h1>

      <div class="row g-4">
       
         <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
               <img src="images/my2.jpg" class="card-img-top" alt="Rajesh Chaudhary">
               <div class="card-body">
                  <p class="card-text">"I stumbled upon Kanhaiya Grocery Store online and was pleasantly surprised by their wide variety of products. The website is user-friendly, making my shopping experience a breeze. The delivery was prompt, and the items were fresh. Definitely my go-to for groceries now!".</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                  </div>
                  <h5 class="mt-3">Rajesh Chaudhary</h5>
               </div>
            </div>
         </div>

         <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
               <img src="images/my5.png" class="card-img-top" alt="Vatsal Bhavsar">
               <div class="card-body">
                  <p class="card-text">"Decent selection, but the website could use some improvement. It's a bit clunky to navigate, especially on mobile devices. Nonetheless, the quality of the groceries is top-notch, and the prices are competitive. Just needs a smoother online experience."</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i> 
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h5 class="mt-3">Vatsal Bhavsar</h5>
               </div>
            </div>
         </div>

         
         <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
               <img src="images/my3.avif" class="card-img-top" alt="Vishvendra Pratap Singh">
               <div class="card-body">
                  <p class="card-text">"Kanhaiya Grocery Store is fantastic! I love the convenience of ordering online, and the website is so easy to use. They have everything I need, and the delivery is always on time. Fresh produce and great customer service keep me coming back."</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h5 class="mt-3">Vishvendra Pratap Singh</h5>
               </div>
            </div>
         </div>

       
         <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
               <img src="images/my.webp" class="card-img-top" alt="Ravnit Singh">
               <div class="card-body">
                  <p class="card-text">"Disappointing experience. The website promised a lot, but the actual products didn't match the descriptions. Some items were close to expiration, and the packaging was subpar. Improvement in quality control and accuracy on the site is much needed."</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h5 class="mt-3">Ravnit Singh</h5>
               </div>
            </div>
         </div>

       
         <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
               <img src="images/my4.avif" class="card-img-top" alt="Aashish Mishra">
               <div class="card-body">
                  <p class="card-text">"Great variety and quality of products. The website layout is clean and simple to navigate. My orders have always been accurate, and the delivery service is reliable. If they add more organic options, it'd be perfect!"</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h5 class="mt-3">Aashish Mishra</h5>
               </div>
            </div>
         </div>

       
         <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
               <img src="images/nigga.jpg" class="card-img-top" alt="Sudhanshu Ranjan">
               <div class="card-body">
                  <p class="card-text">"I can't recommend Kanhaiya Grocery Store enough! The website is intuitive, and the range of international products is impressive. Freshness is never compromised, and the delivery is lightning-fast. A gem for foodies!"</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                  </div>
                  <h5 class="mt-3">Sudhanshu Ranjan</h5>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


<?php include 'footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
