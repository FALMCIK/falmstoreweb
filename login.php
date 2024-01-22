<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass' LIMIT 1";

   $result = mysqli_query($conn, $select);

   if ($result && mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result);

      // Girilen şifre ile veritabanındaki şifreyi karşılaştır
      if (md5($_POST['password']) == $row['password']) {

         // Kullanıcı bulundu, oturum başlat ve yönlendirme yap
         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.html');

      } else {
         // Şifre yanlış, hata mesajını ayarla
         $error[] = 'Incorrect password!';
      }

   } else {
      // Kullanıcı bulunamadı, hata mesajını ayarla
      $error[] = 'Incorrect email!';
   }


}

?>
