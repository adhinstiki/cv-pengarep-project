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
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- BOOTSRAP ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap");

        :root {
            --primary-font: "Outfit", sans-serif;
            --primary-color: #906e50;
            --text-muted: #767676;
            --accent-color: #4acbb0;
            --grey-outline: #C4C4C4;
            --grey-button: #777777;
            --dark-color: #303030;
        }

        body {
            font-family: var(--primary-font);
            overflow-x: hidden !important;
        }

        .navbar-brand {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .navbar-brand img {
            width: 156px;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-item.active {
            background-color: var(--primary-color);
            border-top-right-radius: 100px; 
            border-bottom-right-radius: 100px; 
        }

        .nav-link.active {
            color: white;
        }

        .nav-item {
            padding-left: 1.5rem;
        }

        .nav-link {
            color: black;
            padding: 1rem 0;
        }

        .nav-item:hover .nav-link.active {
            color: white;
        }

        .nav-item:hover .nav-link {
            color: var(--primary-color);
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f5f5f5;
            padding: 1rem 1rem 1rem 0;
            width: 250px;
            overflow-y: auto;
        }
        .content {
            margin-left: 250px;
            padding: 1rem;
        }
        .message-row:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .table-thead {
            background-color: var(--primary-color);
            color: white;
        }

        .table>:not(:last-child)>:last-child>* {
            border: 0 !important;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
</head>
<body>
<div class="sidebar">
        <a class="navbar-brand" href="#home">
            <img src="assets/images/logo.png" alt="Logo" class="d-inline-block align-text-top">
        </a>
        <ul class="nav flex-column">
            <li class="nav-item active">
                <i class="bi bi-envelope-paper-fill nav-link active"></i>
                <a class="nav-link active" href="#">Primary</a>
            </li>
            <li class="nav-item">
                <i class="bi bi-people-fill nav-link"></i>
                <a class="nav-link" href="#">Social</a>
            </li>
            <li class="nav-item">
                <i class="bi bi-tag-fill nav-link"></i>
                <a class="nav-link" href="#">Promotions</a>
            </li>
            <li class="nav-item">
                <i class="bi bi-exclamation-circle-fill nav-link"></i>
                <a class="nav-link" href="#">Spam</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <a href="email.php" class="btn btn-secondary mt-3">Back to Inbox</a>
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
    </div>
    

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

    <!-- CDN JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- CDN JS -->

    <!-- MAIN JS -->
     <script src="js/main.js"></script>
</body>
</html>
