<?php
include 'Masif/OnlineOrderingEnglish/components/connect.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="icon" type="image/x-icon" href="Masif/OnlineOrderingEnglish/order.ico">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="Masif/OnlineOrderingEnglish/css/style.css">
   <style>
      .fontchange{
         font-family:Rabar_027;
      }
     
      
      body{background:white;}
      .header{background:darkred;}
   </style>
</head>
<body>
<header class="header">
   <section class="flex">
      <a href="#" class="logo" style="color:white;  font-family:algerian">Resturants 👀</a>
      <nav class="navbar">
      </nav>
      <div class="icons">
      <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>
   </section>
</header>
<section class="category">
   <h1 class="title"> Choose Resturant </h1>
   <div class="box-container">

   <a href="Shaqlawa/OnlineOrderingEnglish/home.php" class="box" style=border-radius:100px>
      <img src="pngegg (80).png" alt="">
      <h3> Shaqlawa Resturant </h3>
      <br>
      <p style="font-size:20px; color:red;" > 
      <br>
      Address: Shaqlawa opposite the Hospital
      <br>
      Phone: 0780 526 92 86
      </p>
      </p>
   </a>

   <a href="Masif/OnlineOrderingEnglish/home.php" class="box" style=border-radius:100px>
      <img src="pngegg (81).png" alt="">
      <h3> masif Resturant </h3>
      <br>
      <p style="font-size:20px;color:red;"> 
       <br>
      Address: Masif Center of Bazar
      <br>
      Phone: 0780 526 92 86
      </p>
   </a>



   </div>

<section class="category">
   
   <div class="box-container">

      <a href="Kore/OnlineOrderingEnglish/home.php" class="box"style=border-radius:100px>
         <img src="pngegg (83).png" alt="">
         <h3> Erbil Resturant </h3>
         <br>
         <p style="font-size:20px;color:red;">
         
         Address: Erbil  Near Qaimqam
         <br>
         Phone: 0751 790 24 74
         </p>
      </a>

   </div>
   <br><br><h1 class="title"> Other resturant will be added soon </h1>
</section>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>
<script>
var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});
</script>
</body>
</html>