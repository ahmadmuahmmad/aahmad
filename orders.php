<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>داواکاریەکان</title>
   <link rel="icon" type="image/x-icon" href="order.ico">


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .fontchange{
         font-family:Rabar_027;
      }
      body{background:white;}
   </style>

</head>
<body dir="rtl">
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading"style="background-color:darkred;">
   <h3 class="fontchange">داواکاریەکان</h3>
   <p><a href="html.php" class="fontchange">سەرەکی</a> <span class="fontchange"> / داواکاریەکان</span></p>
</div>

<section class="orders">

   <h1 class="title fontchange"> داواکاریەکانت </h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty fontchange"> تکایە بچۆرە ژوورەوە بە هەژمارەکەت ! </p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY `id` DESC");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" dir="rtl">
      <p class="fontchange">داواکراوە لە : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p class="fontchange">ناو : <span><?= $fetch_orders['name']; ?></span></p>
      <p class="fontchange">ئیمەیڵ : <span><?= $fetch_orders['email']; ?></span></p>
      <p class="fontchange">ژمارە تەلەفۆن : <span><?= $fetch_orders['number']; ?></span></p>
      <p class="fontchange">ناونیشان : <span class="fontchange"><?= $fetch_orders['address']; ?></span></p>
      <p class="fontchange">جۆری پارەدان : <span><?= $fetch_orders['method']; ?></span></p>
      <p class="fontchange">داواکراوەکان : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p class="fontchange">کۆی گشتی پارە : <span>IQD<?= $fetch_orders['total_price']; ?></span></p>
      <p class="fontchange">تێبینی : <span class="fontchange"><?= $fetch_orders['descreption']; ?></span></p>
      <p class="fontchange"> حاڵەت : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty fontchange">هیچ داواکاریەک زیاد نەکراوە</p>';
      }
      }
   ?>

   </div>

</section>










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>