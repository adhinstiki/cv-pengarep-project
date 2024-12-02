<?php
require 'db.php'; 

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
    header("Location: index.php?status=empty_fields");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?status=invalid_email");
}

$sql = "INSERT INTO orders (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':subject' => $subject,
        ':message' => $message
    ]);

    header("Location: index.php?status=success");
} catch (PDOException $e) {
    error_log("Error inserting data: " . $e->getMessage());
    header("Location: index.php?status=error");
}
?>
