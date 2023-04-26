<?php 
    include("conn.php");
    session_start();
    $response = "Error";
    $message = "Not in else statement";
    $type = "0";


    if (isset($_POST['edit-profile'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        //$oldPassword = mysqli_real_escape_string($con, $_POST['old_password']);
        //$password = mysqli_real_escape_string($con, $_POST['password_1']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $Tel = mysqli_real_escape_string($con, $_POST['mobile_number']);
        $Gender = mysqli_real_escape_string($con, $_POST['gender']);

        //get duplicate username and email
        $duplicate_query = "SELECT * FROM user where ID <> '$id' AND Username = '$username' OR Email = '$email'";
        $duplicate_result = mysqli_query($con, $duplicate_query);
        
        if (mysqli_num_rows($duplicate_result) > 0) {
            $row = mysqli_fetch_assoc($duplicate_result);
            if($row['Username'] == $username){
                $response = "Error";
                $type = "0";
                $message = "Username already exists";
            }else if($row['Email'] == $email){
                $response = "Error";
                $type = "1";
                $message = "Email already exists";
            }
        }
        else {
            //Edit user profile
            $query = "UPDATE user SET Username = '$username', Email = '$email', DOB = '$DOB', Tel = '$Tel', Gender = '$Gender' WHERE ID = '$id'";
            if (mysqli_query($con, $query)) {
                $response = "Success";
                $message = "Profile edited successfully";
            }
            else {
                $message = "Error: " . mysqli_error($con);
            }
        } 
    }
    
    $response = array('response' => $response, 'type' => $type, 'message' => $message);
    echo json_encode($response);
    mysqli_close($con);
?>