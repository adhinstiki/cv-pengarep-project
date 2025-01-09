<?php
$host = '/cloudsql/cv-pengarep-project:asia-southeast2:cvpengarep-instance';
$user = 'root';      
$password = 'adhi1234';     
$dbname = 'db_cvpengarep';  // Pastikan nama variabel sesuai
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
