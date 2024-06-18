<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="app.js"></script>
</head>
<body>

<nav class="navbar-2">
    <a href="/">
        <img src="/img/HOBO_logo.png" alt="HOBO Logo">
    </a>

    <div class="right-container">
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo '<p> ' . htmlspecialchars($username) . '</p>';
            
        } else {
            echo '
                <button class="login-btn"><a href="login.php">Login</a></button>
                <button class="login-btn"><a href="registration.php">Register</a></button>
            ';
        }
        ?>
    </div>
</nav>

</body>
</html>
