<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

    if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
        $current_password = stripslashes($_REQUEST['current_password']);
        $current_password = mysqli_real_escape_string($con, $current_password);
        $new_password = stripslashes($_REQUEST['new_password']);
        $new_password = mysqli_real_escape_string($con, $new_password);
        $username = $_SESSION['username'];

        $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($current_password) . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        if (mysqli_num_rows($result) == 1) {
            $query = "UPDATE `users` SET password='" . md5($new_password) . "' WHERE username='$username'";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<p>Password updated successfully.&nbsp<a href='dashboard.php'>Return</a></p>";
            } else {
                echo "<p>Failed to update password.</p>";
            }
        } else {
            echo "<p>Current password is incorrect.&nbsp<a href='password.php'>Try Again</a></p>";
        }
    } else {
?>
<form action="" class="fade-in-up" method="post" name="change_password">
    <p>Change Password</p>
    <input type="password" class="login-input" name="current_password" placeholder="Current Password" required>
    <input type="password" class="login-input" name="new_password" placeholder="New Password" required>
    <input type="submit" class="login-button" name="submit" value="Change Password">
    <p class="link"><a href="dashboard.php">Return to Dashboard</a></p>
</form>
<?php
    }
?>
</body>
</html>
