<?php
    include('conn.php');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password_1'];
    $DOB = $_POST['DOB'];
    $Tel = $_POST['mobile_number'];

    $query = "INSERT INTO user (Username, Email, Password, DOB, Tel) VALUES ('$username', '$email', '$password', '$DOB', '$Tel')";

    if (mysqli_query($con, $query)){
        echo "<script>alert('Your account had been created!');
        window.location.href= 'login.php';</script>";
    }
    else {
        echo "Failed to create account: ". mysqli_error($con);
    }
    
    mysqli_close($con);
    ?>
?>