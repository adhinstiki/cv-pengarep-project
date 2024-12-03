<?php
require 'db.php'; // File koneksi database

// Pastikan form login mengirim data
if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']); // Hapus spasi tambahan
    $password = $_POST['password'];

    try {
        // Query untuk mengambil data berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        // Validasi username
        if (!$user) {
            header("Location: login.php?status=invalid_username");
            exit();
        }

        // Validasi password (dengan plaintext)
        if ($password !== $user['password']) {
            header("Location: login.php?status=invalid_password");
            exit();
        }

        // Login berhasil
        session_start();
        $_SESSION['username'] = $user['username']; // Simpan username ke sesi
        $_SESSION['role'] = $user['role'];         // Simpan role (opsional)

        header("Location: email.php"); // Redirect ke halaman dashboard
        exit();
    } catch (PDOException $e) {
        // Tangani error database
        error_log("Database error: " . $e->getMessage()); // Catat error ke log server
        header("Location: login.php?status=error");
        exit();
    }
} else {
    // Jika data tidak lengkap
    header("Location: login.php?status=missing_fields");
    exit();
}
?>
