<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="\css/style.css">
    <link rel="stylesheet" href="\css/custom.css">
</head>
<body id="login-cr4">
<?php
    require('../php/dbconnect.php');

    if(isset($_REQUEST['username'])){
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query    = "INSERT into `users` (username, password, email)
                     VALUES ('$username', '" . md5($password) . "', '$email')";
        $result   = mysqli_query($con, $query);

        if($result){
            echo "
            <form action='' method='post' class='fade-in-up'>
                <p>Registration</p>
                <p>Registration Succesfull, you can now&nbsp<a href='login.php'> Log in!</a></p style='margin: 20px 0px 20px 0px'>
                <p class='link'>Welcome to Hobo!</p>
            </form>";
        }else {
            echo "<div class='form'>
            <h3> Required fields are missing.</h3><br>
            <p class='link'>Click here to<a href='registration.php'> register</a> again.</p>
            </div>";
        }
    }else{
?>

<form action="" method="post" class="fade-in-up">
    <p>Registration</p>
    <input type="text"      class="login-input" name="username" placeholder="Username" required>
    <input type="email"      class="login-input" name="email"    placeholder="e-mail"  required>
    <input type="password"  class="login-input" name="password" placeholder="Password" required required pattern='{8,}'>
    <p>⚠ password must contain at least 8 characters.</p>
    <input type="submit"    class="login-button"name="submit"   value="Register">
    <p class="link">Already a member? &nbsp <a href="login.php"> Log in!</a></p>
</form>
<?php
    }
?>
</body>
</html>