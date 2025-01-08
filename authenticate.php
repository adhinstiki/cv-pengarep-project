<?php
require 'db.php'; // File koneksi database

// Pastikan form login mengirim data
if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']); // Hapus spasi tambahan
    $password = $_POST['password'];

    // Debugging: Log input form
    error_log('Username: ' . $username);
    error_log('Password: ' . $password);

    // Cek jika input kosong
    if (empty($username) || empty($password)) {
        header("Location: login.php?status=missing_fields");
        exit();
    }

    try {
        // Query untuk mengambil data berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        // Debugging: Log hasil query
        error_log('User Data: ' . print_r($user, true));

        // Gabungan validasi username dan password
        if (!$user || $password !== $user['password']) {
            // Jika username atau password salah
            error_log('Invalid credentials for username: ' . $username); // Log kesalahan kredensial
            header("Location: login.php?status=invalid_credentials");
            exit();
        }

        // Login berhasil
        session_start();
        $_SESSION['username'] = $user['username']; // Simpan username ke sesi

        // Redirect ke halaman setelah login berhasil
        header("Location: email.php");
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
