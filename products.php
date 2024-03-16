<?php
include '../OnlineOrderingKurdish/components/connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:index.php');
};
if(isset($_POST['add_product'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $descreption = $_POST['descreption'];
   $descreption = filter_var($descreption, FILTER_SANITIZE_STRING);
   $engdescreption = $_POST['engdescreption'];
   $engdescreption = filter_var($engdescreption, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../OnlineOrderingKurdish/uploaded_img/'.$image;
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);
   if($select_products->rowCount() > 0){
      $message[] = 'Food Name Already Exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'Image Size Is Too Large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
         $insert_product = $conn->prepare("INSERT INTO `products`(name,descreption,engdescreption, category, price, image) VALUES(?,?,?,?,?,?)");
         $insert_product->execute([$name,$descreption,$engdescreption, $category, $price, $image]);
         $message[] = 'New Food Added!';
      }
   }
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../OnlineOrderingKurdish/uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <link rel="icon" type="image/x-icon" href="../OnlineOrderingKurdish/order.ico">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="../OnlineOrderingKurdish/css/admin_style.css">
   <style>
      .fontchange{
         font-family:Rabar_027;
      }
   </style>
</head>
<body>
<?php include '../OnlineOrderingKurdish/components/admin_header.php' ?>
<!-- add products section starts  -->
<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Foods</h3>
      <input type="text" required placeholder="Enter Food Name" name="name" maxlength="100" class="box">
      <textarea required id="descreption" name="descreption" rows="2" cols="50" class="box">Food Description (Kurdish)
      </textarea>
      <textarea required id="engdescreption" name="engdescreption" rows="2" cols="50" class="box">Food Description (English)
      </textarea>
      <input type="number" min="0" max="9999999999" required placeholder="Enter Product Price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>Select Category --</option>
         <option value="fastfoods">Fast Foods</option>
         <option value="dishes">Dishes</option>
         <option value="drinks">Drinks</option>
         <option value="desserts">Desserts</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="Add Food" name="add_product" class="btn">
   </form>
</section>
<!-- add products section ends -->
<!-- show products section starts  -->
<section class="show-products" style="padding-top: 0;">
   <div class="box-container">
   <?php
      $show_products = $conn->prepare("SELECT * FROM `products` ORDER BY `name` ASC");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../OnlineOrderingKurdish/uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>IQD</span><?= $fetch_products['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_products['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="name fontchange"><?= $fetch_products['descreption']; ?></div>
      <div class="name"><?= $fetch_products['engdescreption']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No Products Added Yet!</p>';
      }
   ?>
   </div>
</section>
<!-- show products section ends -->
<!-- custom js file link  -->
<script src="../OnlineOrderingKurdish/js/admin_script.js"></script>
</body>
</html>