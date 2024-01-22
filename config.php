<?php

$conn = mysqli_connect('localhost', 'root', 'F@lm3939', 'user_db');

// Bağlantı kontrolü
if (!$conn) {
    die("Veritabanına bağlantı hatası: " . mysqli_connect_error());
}

?>