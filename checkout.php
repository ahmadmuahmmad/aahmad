<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $descreption = $_POST['descreption'];
   $descreption = filter_var($descreption, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      if($address == ''){
         $message[] = ' تکایە ناونیشانەکەت زیاد بکە ';
      }else{
         
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address,descreption, total_products, total_price) VALUES(?,?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address,$descreption, $total_products, $total_price]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = ' داواکاریەکەت بە سەرکەوتوویی ناردرا ';
      }
      
   }else{
      $message[] = ' سەبەتەکەت بەتاڵە ';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
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

<div class="heading">
   <h3 class="fontchange"> تەواوکردن </h3>
   <p><a href="home.php" class="fontchange"> سەرەکی </a> <span class="fontchange"> / تەواوکردن</span></p>
</div>

<section class="checkout">

   <h1 class="title fontchange">پوختەی داواکاریەکەت </h1>

<form action="" method="post">

   <div class="cart-items">
      <h3 class="fontchange"> خواردنەکانی سەبەتەکەت</h3>
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
      <p><span class="name" style="color:white;"><?= $fetch_cart['name']; ?></span><span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
      <?php
            }
         }else{
            echo '<p class="empty fontchange"> سەبەتەکەت بەتاڵە </p>';
         }
      ?>
      <p class="grand-total"><span class="name fontchange"> کۆی گشتی :</span><span class="price">$<?= $grand_total; ?></span></p>
      <a href="cart.php" class="btn fontchange"> دیتنەوەی سەبەتەکەت</a>
   </div>

   <input type="hidden" name="total_products" value="<?= $total_products; ?>">
   <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
   <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
   <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
   <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
   <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

   <div class="user-info">
      <h3 class="fontchange"> زانیاریەکانت </h3>
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
      <a href="update_profile.php" class="btn fontchange"> نوێکردنەوەی زانیاریەکان </a>
      <h3 class="fontchange"> ناونیشانی ناردن </h3>
      <p><i class="fas fa-map-marker-alt"></i><span class="fontchange"><?php if($fetch_profile['address'] == ''){echo 'تکایە ناونیشانەکەت بنووسە';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_address.php" class="btn fontchange"> نوێکردنەوەی ناونیشان </a>
      <textarea required id="descreption" name="descreption" rows="2" cols="50" class="box fontchange"> ئەگەر تێبینیەکت هەیە بینووسە .....
      </textarea>
      <select name="method" class="box" required>
         <option value="" disabled class="fontchange"> جۆری پارەدان هەڵبژێرە </option>
         <option selected value="cash on delivery" class="fontchange"> کاش دوای ناردن </option>
         <option value="credit card" class="fontchange"> کرێدیت کارد </option>
         <!-- <option value="paytm">Paytm</option> -->
         <option value="paypal" class="fontchange"> پەیپاڵ </option>
      </select>
      <input type="submit" value=" ناردنی داواکاری " class="btn fontchange <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
   </div>

</form>
   
</section>









<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>