<?php
$host = '34.128.85.1'; 
$user = 'root';      
$password = 'adhi1234';     
$db_name = 'db_cvpengarep'; 
$charset = 'utf8mb4';

try {
    // Membuat koneksi PDO ke database Cloud SQL
    $pdo = new PDO("mysql:dbname=$dbname;unix_socket=$host", $user, $password);
    // Set error mode untuk menangani kesalahan
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Jika koneksi gagal, tampilkan pesan kesalahan
    echo "Connection failed: " . $e->getMessage();
}
?>