<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 1rem 3rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .text-login {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .logo {
            display: block;
            margin: 0 auto 3rem;
            width: 200px;
            height: auto;
        }

        .input-field {
            margin-bottom: 1rem;
        }


        .custom-toast {
            margin-top: 2.5rem; 
        }

        .btn-login {
            margin-top: 2rem;
            padding: 0.5rem 2rem;
            background-color: var(--primary-color);
            color: white;
            transition: filter 0.3s ease; 
        }

        .btn-login:hover {
            background-color: var(--primary-color);
            color: white;
            filter: brightness(0.65);
        }

        .btn-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="assets/images/logo-color.png" alt="Logo" class="logo">
        
        <!-- Form Login -->
        <h3 class="text-login text-center">Login</h3>
        <form action="authenticate.php" method="POST">
            <div class="input-field">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="input-field">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-login">Login</button>
            </div>
        </form>

    </div>
    <!-- CDN BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CDN SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ALERT LOGIN -->
    <script>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'not_logged_in'): ?>
        Swal.fire({
            toast: true,
            icon: 'warning',
            title: 'Login terlebih dahulu!',
            position: 'top',
            customClass: {
                popup: 'custom-toast'
            },
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
        <?php endif; ?>
    </script>
</body>
</html>
