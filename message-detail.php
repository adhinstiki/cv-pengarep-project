<?php
require 'db.php'; 

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query untuk mendapatkan detail pesan
    $query = "SELECT name, email, phone, subject, message, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as date 
              FROM orders WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $message = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$message) {
        die('Message not found.');
    }
} else {
    die('Invalid message ID.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Message Detail</h2>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Subject: <?php echo htmlspecialchars($message['subject']); ?>
        </div>
        <div class="card-body">
            <p><strong>From:</strong> <?php echo htmlspecialchars($message['name']); ?> (<?php echo htmlspecialchars($message['email']); ?>)</p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($message['phone']); ?></p>
            <p><strong>Received On:</strong> <?php echo htmlspecialchars($message['date']); ?></p>
            <hr>
            <p><strong>Message:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
        </div>
    </div>
    <a href="email.php" class="btn btn-secondary mt-3">Back to Inbox</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
