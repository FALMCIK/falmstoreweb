<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.html');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.html');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Bu ürün çoktan sepete eklendi!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'Ürün sepete eklendi!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'Sepet başarıyla güncellendi!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:cart.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sepetim</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include "index.php";?>
    <?php
        if(isset($message)){
        foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<header> 
        <nav>
        <?php
              $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
              if(mysqli_num_rows($select_user) > 0){
                 $fetch_user = mysqli_fetch_assoc($select_user);
              };
           ?>
            <ul id="menu">
                <h1>FALMSTORE</h1>
                <li><a href="index.html">Ana Sayfa</a></li>
                <li><a href="cart.php">Sepet</a></li>
                <p> Kullanıcı adı : <span><?php echo $fetch_user['name']; ?></span> </p>
                <p> Mail : <span><?php echo $fetch_user['email']; ?></span> </p>
                <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?');" class="delete-btn">Çıkış Yap</a>
                <li><a href="updates.html">Güncellemeler</a></li>
                
                
                
            </ul>
        </nav>
        
    </header>  
   
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>



<div class="shopping-cart">

   <h1 class="heading">Sepetim</h1>

   <table>
      <thead>
         <th>Resim</th>
         <th>İsim</th>
         <th>Fiyat</th>
         <th>Adet</th>
         <th>Toplam Fiyat</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Ürünü sepetten silmek istediğine emin misin?');">Sil</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Genel Toplam :</td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td><a href="index.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Hepsini Sil</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn">  
      <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Ödeme İşlemine Geç</a>
   </div>

</div>

</div>

</body>
</html>