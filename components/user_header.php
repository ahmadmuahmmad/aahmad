<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header"style="background-color:RGB(163,8,12);">

   <section class="flex" style="background-color:white;">

   <a href="home.php" class="logo fontchange" style="color:black;">🍴 چێشتخانەی هەولێر 🧂</a>

      <nav class="navbar">
         <a href="home.php" class="fontchange" style="color:red;">سەرەکی</a>
         <a href="about.php" class="fontchange" style="color:red;">دەربارە</a>
         <a href="menu.php" class="fontchange" style="color:red;">خواردنەکان</a>
         <a href="orders.php" class="fontchange" style="color:red;">داواکاریەکان</a>
         <a href="contact.php" class="fontchange" style="color:red;">پەیوەندی</a>
         <a href="../../bazarkrdn.php" class="fontchange" style="color:red;">ڕێستورانتەکان</a>
         <a href="../OnlineOrderingEnglish/home.php" style="color:green;">( کوردی-English)</a>

      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search" style="color:black;"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart" style="color:green;"></i><span style="color:black;">(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user" style="color:red;"></div>
         <div id="menu-btn" class="fas fa-bars" style="color:red;"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn fontchange">هەژمار</a>
            <a href="components/user_logout.php" onclick="return confirm('دەچیتە دەرەوە ؟');" class="delete-btn fontchange">چوونەدەرەوە</a>
         </div>
         <!-- <p class="account">
            <a href="login.php" class="fontchange">چوونەژورەوە</a> یان
            <a href="register.php" class="fontchange">درووستکردنی هەژمار</a>
         </p>  -->
         <?php
            }else{
         ?>
            <p class="name fontchange">تکایە سەرەتا بچۆرە ژوورەوە بە ئەکاونتەکەت</p>
            <a href="login.php" class="btn fontchange">چوونەژورەوە</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>

