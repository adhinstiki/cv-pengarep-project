<?php
// Mulai sesi
session_start();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit();
