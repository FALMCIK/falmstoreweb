<?php

$conn = mysqli_connect('157.230.110.140', 'root', 'F@lm3939', 'falmstore');

// Bağlantı kontrolü
if (!$conn) {
    die("Veritabanına bağlantı hatası: " . mysqli_connect_error());
}

?>