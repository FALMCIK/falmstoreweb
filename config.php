<?php

$conn = mysqli_connect('localhost', 'root', 'F@lm3939', 'shop_db') or die('connection failed');

// Bağlantı kontrolü 
if (!$conn) {
    die("Veritabanına bağlantı hatası: " . mysqli_connect_error());
}

?>
