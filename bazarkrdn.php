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
      
      
      body{background:WHITE;}
      .header{background:RGB(163,8,12);}
  </style>

</head>
<body>

<header class="header">

   <section class="flex">

      <a href="#" class="logo fontchange" style="color:white;  font-family:algerian"> خواردنگەکان 👀</a>

      <nav class="navbar">

      </nav>

      <div class="icons">
      <div id="user-btn" class="fas fa-user"></div>

         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

   </section>

</header>



<section class="category">

   <h1 class="title fontchange" style="color:black;  font-family:normal">  خواردنگە هەڵبژێرە ؟</h1>


   <div class="box-container">

      <a href="Shaqlawa/OnlineOrderingKurdish/home.php" class="box" style=border-radius:100px>
         <img src="pngegg (80).png" alt="">
         <h3 class="fontchange" style="font-size:30px;"> چێشتخانەی شەقڵاوە </h3>
         <br>
         <p class="fontchange" style="font-size:20px; color:red;"> 
       
         <br>
         ناونیشان: شەقڵاوە بەرامبەر نەخۆشخانە
         <br>
         بۆ پەیوەندی: 74 24 790 0751
         </p>
         </p>
      </a>

      <a href="Masif/OnlineOrderingKurdish/home.php" class="box" style=border-radius:100px>
         <img src="pngegg (81).png" alt="">
         <h3 class="fontchange" style="font-size:30px; "> چێشتخانەی مەسیف </h3>
         <br>
         <p class="fontchange" style="font-size:20px; color:red;"> 
         
         <br>
         ناونیشان: مەسیف ناو بازاڕ
         <br>
         بۆ پەیوەندی: 86 92 526 0780
         </p>
      </a>

      <a href="Kore/OnlineOrderingKurdish/home.php" class="box"  style=border-radius:100px>
         <img src="pngegg (83).png" alt="">
         <h3 class="fontchange" style="font-size:30px;"> چێشتخانەی هەولێر </h3>
         <br>
         <p class="fontchange" style="font-size:20px; color:red;"> 
         

         <br>
         ناونیشان: هەولێر نزیک قایمقام 
         <br>
         بۆ پەیوەندی: 86 92 526 0780
         </p>
      </a>

   </div>
   <br><br><br><br>
   <h1 class="title fontchange" style="color:red;  font-family:normal"> خواردنگەکانی تر بەمزوانە زیاد دەکرێن</h1>

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