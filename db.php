<?php
// db.php
$host = 'localhost'; 
$user = 'root';      
$password = '';      
$db_name = 'cv_pengarep'; 
// Membuat koneksi
$conn = new mysqli($host, $user, $password, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
