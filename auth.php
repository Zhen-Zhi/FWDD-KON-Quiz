<?php
    include("conn.php");
    session_start();
    $response = "";
    $message = "";

    if (isset($_POST['login'])) {
        $credential = mysqli_real_escape_string($con,$_POST['credential']);
        $password = mysqli_real_escape_string($con,$_POST['password']);

        if($credential != "" && $password != ""){
            $query = "SELECT id, username, email, password FROM user where username = '$credential' OR email = '$credential'";
            $result = mysqli_query($con, $query);
            $data = $result->fetch_assoc();

            if($password == $data['password']) {
                $response = "Success";
                $_SESSION['email'] = $data['email'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['username'] = $data['username'];
            }else{
                $response = "Error";
                $message = "Account error";
            }
        }
        else {
            $response = "Error";
            $message = "Field is empty";
        }

        $response = array('response' => $response,'message' => $message);
        $json_response = json_encode($response);
        echo $json_response;

    }
    else if(isset($_POST['signup'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password_1']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $Tel = mysqli_real_escape_string($con, $_POST['mobile_number']);

        $type = "";

        $duplicate_query = "SELECT id, username, email FROM user WHERE username='$username' OR email='$email'";
        $duplicate_result = mysqli_query($con, $duplicate_query);

        if (mysqli_num_rows($duplicate_result) > 0) {
            $row = mysqli_fetch_assoc($duplicate_result);
            if($row['username'] == $username){
                $response = "Error";
                $type = "0";
                $message = "Username already exists";
            }else if($row['email'] == $email){
                $response = "Error";
                $type = "1";
                $message = "Email already exists";
            }
        } else {
            // Insert new user
            $query = "INSERT INTO user (Username, Email, Password, DOB, Tel) VALUES ('$username', '$email', '$password', '$DOB', '$Tel')";
            if (mysqli_query($con, $query)) {
                $response = "Success";
                $message = "Account has been created successfully";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }

        $response = array('response' => $response, 'type' => $type, 'message' => $message);
        $json_response = json_encode($response);
        echo $json_response;
    }

    mysqli_close($con);
?>