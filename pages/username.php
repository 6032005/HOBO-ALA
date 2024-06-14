<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Username</title>
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

    if (isset($_POST['new_username'])) {
        $new_username = stripslashes($_REQUEST['new_username']);
        $new_username = mysqli_real_escape_string($con, $new_username);
        $current_username = $_SESSION['username'];

        $query = "SELECT * FROM `users` WHERE username='$new_username'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 0) {
            $query = "UPDATE `users` SET username='$new_username' WHERE username='$current_username'";
            $result = mysqli_query($con, $query);

            if ($result) {
                $_SESSION['username'] = $new_username;
                echo "<p>Username updated successfully.&nbsp<a href='dashboard.php'>Return</a></p>";
            } else {
                echo "<p>Failed to update username.&nbsp<a href='username.php'>Retry</a></p>";
            }
        } else {
            echo "<p>Username already taken. Please choose&nbsp<a href='username.php'>another one.</a></p>";
        }
    } else {
?>
<form action="" class="fade-in-up" method="post" name="change_username">
    <p>Change Username</p>
    <input type="text" class="login-input" name="new_username" placeholder="New Username" required>
    <input type="submit" class="login-button" name="submit" value="Change Username">
    <p class="link"><a href="dashboard.php">Return to Dashboard</a></p>
</form>
<?php
    }
?>
</body>
</html>
