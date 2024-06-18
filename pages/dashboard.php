<?php
include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';
include_once '../php/tools.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$contentManagerRole = $_SESSION['contentmanager'] ?? 1;
$isAdmin = $_SESSION['admin'] ?? 1;

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body id="dashboard-cr6">
    <section id="sidebar">
        <a href="home.php"><img src="../img/arrow.png" alt="" style="transform: scaleX(-1);"></a>
    </section>
    <section id="main">
        <article>
            <img id="img-dash" src="../img/user.png" alt="">
            <p>Hi, <?php echo $username; ?>!</p>
        </article>
        <article>
            <p>Account Information:</p>
            <p>Username: <?php echo $username; ?></p>
            <p>E-mail: <?php echo $email; ?></p>
            <a style="padding-right: 50px" href="email.php">Change Email</a>
            <a style="padding-right: 50px" href="password.php">Change Password</a>
            <a  style="padding-right: 50px" href="username.php">Change Username</a>
            <a style="padding-right: 50px" href="history.php">History</a>
            
            <?php if ($contentManagerRole == 1): ?>
                <a  style="padding-right: 50px" href="contentmanager.php">Manage Content</a>
            <?php endif; ?>

            <?php if ($isAdmin == 1): ?>
                <a style="padding-right: 50px" href="admin.php">Admin Page</a>
            <?php endif; ?>
        </article>
   
        <article>
            <form action="" method="post">
                <button type="submit" name="logout" class="logout-button">Logout</button>
            </form>
        </article>
    </section>

    <script>
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                fetch('logout.php', {
                    method: 'POST',
                    body: JSON.stringify({ logout: true }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = 'login.php';
                    } else {
                        alert('Logout failed. Please try again.');
                    }
                })
                .catch(error => console.error('Error during logout:', error));
            }
        }
    </script>
</body>
</html>
