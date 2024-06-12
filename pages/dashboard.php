<?php
    include("../php/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="\css/style.css">
    <link rel="stylesheet" href="\css/custom.css">
</head>
<body id="dashboard-cr6">
    <section id="sidebar">
        <a href="home.php"><img src="../img/arrow.png" alt=""style="transform: scaleX(-1);"></a>
    </section>
    <section id="main">
        <article>
            <img id="img-dash" src="../img/user.png" alt="">
            <p>Hi, <?php echo $_SESSION['username']; ?>!</p>
        </article>
        <article>
            <p>Account Information:</p>
            <p>Username: <?php echo $_SESSION['username']; ?></p>
            <p>E-mail: <?php echo $_SESSION['email']; ?></p>
            <a style="padding-right: 50px" href="email.php">Change Email</a>
            <a style="padding-right: 50px" href="password.php">Change Password</a>
            <a href="username.php">Change Username</a>
        </article>
    </section>
</body>
</html>