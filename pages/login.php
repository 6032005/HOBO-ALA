<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="\css/style.css">
    <link rel="stylesheet" href="\css/custom.css">
</head>
<body id="login-cr5">

<?php
    // Include database connection and start session
    require('../php/dbconnect.php');
    session_start();

    // Check if the user is already logged in
    if (isset($_SESSION['username'])) {
        // If logged in, redirect to dashboard or any other page
        header("Location: dashboard.php");
        exit();
    }

    // Check if the login form was submitted
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query    = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
        $result   = mysqli_query($con, $query) or die(mysqli_error($con));

        // If credentials are correct, set session variables and redirect
        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Display error message if login fails
            echo "
            <form action='' class='fade-in-up' method='post' name='login'>
                <p>Login</p>
                <p>Incorrect Login Credentials</p>
                <p class='link'><a href='login.php'>Return</a></p>
            </form>
            ";
        }
    } else {
        // Display the login form if not logged in
?>
    <form action="" class="fade-in-up" method="post" name="login">
        <p>Login</p>
        <input type="text" class="login-input" name="username" placeholder="Username" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" class="login-button" name="submit" value="Login">
        <p class="link">Not a member yet?&nbsp<br><a href="registration.php">Register here!</a></p>
    </form>
<?php
    }
?>

</body>
</html>
