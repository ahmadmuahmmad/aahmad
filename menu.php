<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>کاڵاکان</title>
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
   <h3 class="fontchange"> خواردنەکانمان </h3>
   <p><a href="home.php" class="fontchange"> سەرەکی </a> <span class="fontchange"> / خواردنەکان </span></p>
</div>

<!-- menu section starts  -->
<!-- 
<center>
<input autofocus style="border-width:2px;border-radius:5px; border-style:solid; border-color:black; text-align:center; font-family:Rabar_027; font-size:20px; margin-top:10px;" type="text"  id="name_med1" size="20"  onkeyup="med_name1()" placeholder="Search By Medicine name" title="Type BarCode">
</center> -->

<section class="category">

<h1 class="title fontchange"> جۆری خواردنەکان</h1>

<div class="box-container">
   
   <a href="category.php?category=fastfoods" class="box">
      <img src="images/cat-1.png" alt="">
      <h3 class="fontchange"> خواردنی خێرا </h3>
   </a>

   <a href="category.php?category=dishes" class="box">
      <img src="images/cat-2.png" alt="">
      <h3 class="fontchange"> خواردنی خێزانی </h3>
   </a>

   <a href="category.php?category=drinks" class="box">
      <img src="images/cat-3.png" alt="">
      <h3 class="fontchange"> خواردنەوەکان </h3>
   </a>

   <a href="category.php?category=desserts" class="box">
      <img src="images/cat-4.png" alt="">
      <h3 class="fontchange"> شیرینی </h3>
   </a>

</div>

</section>

<section class="products">

   <h1 class="title fontchange"> خواردنەکان </h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY `name` ASC ");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="name fontchange"><?= $fetch_products['descreption']; ?></div>
         <div class="flex">
            <div class="price fontchange"><span>IQD</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty fontchange"> هێشتا هیچ خواردنێک زیادنەکراوە</p>';
         }
      ?>

   </div>

</section>


<!-- menu section ends -->
























<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>