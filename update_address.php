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

   $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'ناونیشانەکە زەخیرەکرا';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>نوێکردنەوەی ناونیشان</title>
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
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3 class="fontchange">ناونیشانەکەت</h3>
      <input type="text" class="box fontchange" placeholder="ووڵات" required maxlength="50" name="flat">
      <input type="text" class="box fontchange" placeholder="پارێزگا" required maxlength="50" name="building">
      <input type="text" class="box fontchange" placeholder="قەزا" required maxlength="50" name="area">
      <input type="text" class="box fontchange" placeholder="ناحیە" required maxlength="50" name="town">
      <input type="text" class="box fontchange" placeholder="ناوچە" required maxlength="50" name="city">
      <input type="text" class="box fontchange" placeholder="گەڕەک" required maxlength="50" name="state">
      <input type="number" class="box fontchange" placeholder="ژمارەی کۆڵان" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="text" class="box fontchange" placeholder="وەسفی ناونیشانەکەت" required maxlength="50" name="country">

      <input type="submit" value="زەخیرەکردنی ناونیشان" name="submit" class="btn fontchange">
   </form>

</section>










<?php include 'components/footer.php' ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>