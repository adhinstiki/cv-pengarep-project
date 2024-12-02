<?php
$host = 'o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com'; 
$user = 'cnsbyfdh2qp6sdl2';      
$password = 'qlev2fbx1qt5qmu6';     
$db_name = 'qfhwap8byb54498t'; 

$conn = new mysqli($host, $user, $password, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
