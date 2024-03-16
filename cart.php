<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = ' خواردنەکە سڕایەوە ';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = ' هەموو خواردنەکان سڕانەوە ! ';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = ' ژمارەی داواکراوی خواردنەکە نوێکرایەوە';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>
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
   <h3 class="fontchange"> سەبەتەی بازاڕکردن </h3>
   <p><a href="home.php" class="fontchange">سەرەکی</a> <span class="fontchange"> / سەبەتە</span></p>
</div>

<!-- shopping cart section starts  -->

<section class="products">

   <h1 class="title fontchange">سەبەتەکەت </h1>
   
   <div class="box-container">

      <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-times fontchange" name="delete" onclick="return confirm(' ئەو خواردنە دەسڕیتەوە ؟ ');"></button>
         <img src="../OnlineOrderingKurdish/uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
         <div class="name"><?= $fetch_cart['name']; ?></div>
         <div class="flex">
            <div class="price"><span>IQD</span><?= $fetch_cart['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="1000" value="<?= $fetch_cart['quantity']; ?>" maxlength="4">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total fontchange"> کۆی گشتی دانە : <span>IQD<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
      </form> 
      <?php
               $grand_total += $sub_total;
            }
         }else{
            echo '<p class="empty fontchange"> سەبەتەکەت بەتاڵە </p>';
         }
      ?>

   </div>

   <div class="cart-total">
      <p class="fontchange"> کۆی گشتی سەبەتە : <span>IQD<?= $grand_total; ?></span></p>
      <a href="checkout.php" class="btn fontchange <?= ($grand_total > 1)?'':'disabled'; ?>"> تەواوکردن </a>
   </div>

   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn fontchange <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm(' هەمووی دەسڕیتەوە ؟ ');"> سڕینەوەی هەمووی </button>
      </form>
      <a href="menu.php" class="btn fontchange"> بەردەوامیدان بە بازاڕکردن </a>
   </div>

</section>

<!-- shopping cart section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>