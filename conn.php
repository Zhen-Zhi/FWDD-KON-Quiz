<?php
    $con = mysqli_connect("localhost","root","","kon_quiz");
    if (mysqli_connect_errno()) {
        echo "Database connection failed: ". mysqli_connect_errno();
        exit();
    }
?>