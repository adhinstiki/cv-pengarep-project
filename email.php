<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php?status=not_logged_in");
    exit();
}
?>

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
            cursor: pointer;
        }

        .nav-item:hover {
            background-color: rgb(220, 220, 220);
            border-top-right-radius: 100px; 
            border-bottom-right-radius: 100px; 
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
            color: black;
        }

        .nav-link:focus {
            color: black !important;
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

        .search-container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #888; 
            pointer-events: none; 
        }

        .search-input {
            padding: 0.5rem 3rem;
            border-radius: 5px; 
            transition: none; 
            background-color: #f5f5f5;
        }

        .search-input:focus {
            outline: none; 
            box-shadow: none; 
            border: 1px solid black;
        }

        .status {
            width: 10px; 
            height: 10px; 
            display: inline-block; 
            background-color: green;
            border-radius: 100px;
            margin-left: 0.8rem;
        }

        .first-column {
            width : 10px;
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
        <div class="navbar-brand">
            <img src="assets/images/logo-color.png" alt="Logo" class="d-inline-block align-text-top">
        </div>
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
            <li class="nav-item" onclick="showLogoutAlert();">
                <i class="bi bi-box-arrow-left nav-link"></i>
                <a class="nav-link" href="">Logout</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="search-container position-relative">
                <span class="search-icon">
                    <i class="bi bi-search"></i>
                </span>
                <input 
                    type="text" 
                    class="form-control search-input" 
                    placeholder="Search email" 
                    aria-label="Search" 
                />
            </div>
            <table class="table table-striped table-hover">
                <thead class="table-thead">
                    <tr>
                        <th class="first-column"></th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $query = "SELECT id, name, email, subject, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as date 
                            FROM orders 
                            ORDER BY created_at DESC";
                    $result = $pdo->query($query);
    
                    $firstRow = true; 
    
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr onclick="window.location.href='message-detail.php?id=<?php echo $row['id']; ?>';" style="cursor: pointer;">
                            <td class="first-column">
                                <?php 
                                if ($firstRow) {
                                    echo '<span class="status"></span>';
                                    $firstRow = false; 
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
    
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

    <!-- CDN SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- LOGOUT ALERT -->
    <script>
        function showLogoutAlert() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will logout this page",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }
    </script>
</body>
</html>
