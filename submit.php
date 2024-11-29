<?php
require 'db.php';

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$subject = $conn->real_escape_string($_POST['subject']);
$message = $conn->real_escape_string($_POST['message']);

$sql = "INSERT INTO `orders` (name, email, phone, subject, message) 
        VALUES ('$name', '$email', '$phone', '$subject', '$message')";

$conn->query($sql);

if ($conn->affected_rows > 0) {
    header("Location: index.php?status=success");
    exit();  
} else {
    header("Location: index.php?status=error");
    exit();  
}

$conn->close();
?>
