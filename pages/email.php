<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Email</title>
    <link rel="stylesheet" href="\css/style.css">
    <link rel="stylesheet" href="\css/custom.css">
</head>
<body id="login-cr5">
<?php
    require('../php/dbconnect.php');
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    if (isset($_POST['new_email'])) {
        $new_email = stripslashes($_REQUEST['new_email']);
        $new_email = mysqli_real_escape_string($con, $new_email);
        $username = $_SESSION['username'];

        $query = "UPDATE `users` SET email='$new_email' WHERE username='$username'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['email'] = $new_email;
            echo "<p>Email updated successfully! You can now&nbsp<a href='dashboard.php'>Return</a></p>";
        } else {
            echo "<p>Failed to update email.</p>";
        }
    } else {
?>
<form action="" class="fade-in-up" method="post" name="change_email">
    <p>Change Email</p>
    <input type="email" class="login-input" name="new_email" placeholder="New Email" required>
    <input type="submit" class="login-button" name="submit" value="Change Email">
    <p class="link"><a href="dashboard.php">Return to Dashboard</a></p>
</form>
<?php
    }
?>
</body>
</html>
