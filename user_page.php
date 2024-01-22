<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<header>
        <h1>FALMSTORE</h1>
        <nav>
            <ul id="menu">
                <li><a href="index.html">Ana Sayfa</a></li>
                <li><a href="products.html">Ürünler</a></li>
                <li id="registerTab"><a href="register.html">Kayıt Ol</a></li>
                <li id="loginLink"><a href="login.html">Giriş Yap</a></li>
                
                
            </ul>
        </nav>
        
    </header>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is an user page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>