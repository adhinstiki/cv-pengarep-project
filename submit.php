<?php
require 'db.php'; // Menggunakan $pdo dari db.php

// Ambil data dari form dengan filter untuk keamanan
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// **Tambahkan Validasi di Sini**
if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
    header("Location: index.php?status=empty_fields");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?status=invalid_email");
}

// Query untuk menyimpan data
$sql = "INSERT INTO orders (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)";
$stmt = $pdo->prepare($sql);

try {
    // Eksekusi query dengan data dari form
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':subject' => $subject,
        ':message' => $message
    ]);

    // Redirect jika berhasil
    header("Location: index.php?status=success");
} catch (PDOException $e) {
    // Log error untuk debugging
    error_log("Error inserting data: " . $e->getMessage());
    header("Location: index.php?status=error");
}
?>
