<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- BOOTSRAP ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f5f5f5;
            padding: 1rem;
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
<body>
    <div class="sidebar">
        <h5>Inbox</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Primary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Social</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Promotions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Spam</a>
            </li>
        </ul>
        <hr>
        <button class="btn btn-primary w-100">Compose</button>
    </div>
    <div class="content">
        <h3>Inbox</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $no = 1;
                $query = "SELECT name, email, phone, subject, message, DATE_FORMAT(created_at, '%Y-%m-%d') as date FROM orders";
                $result = $pdo->query($query);
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td class="td-center"><?php echo $no++; ?></td>
                        <td class="td-center"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td class="td-center"><?php echo htmlspecialchars($row['date']); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
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
