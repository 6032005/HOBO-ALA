<?php
    $con = mysqli_connect("localhost", "root", "", "hobo2024");
    if (mysqli_connect_errno()){
        echo "Database connection failed" . mysqli_connect_errno();
    }
?>