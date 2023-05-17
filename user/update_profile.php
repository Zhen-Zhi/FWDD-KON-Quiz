<?php 
    include("../conn.php");
    session_start();
    $response = "";
    $type = "";
    $message = "";
    header('Content-Type: application/json');
    $id = $_SESSION['id'];

    if(!isset($_FILES['profile_picture'])){
        // $id = mysqli_real_escape_string($con, $_POST['id']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $Tel = mysqli_real_escape_string($con, $_POST['mobile_number']);
        $Gender = mysqli_real_escape_string($con, $_POST['gender']);

        $duplicate_query = "SELECT * FROM user WHERE (Username = '$username' OR Email = '$email') AND ID != '$id'";
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
            //if change password
            if (isset($_POST['old_password'])) {
                $oldPassword = mysqli_real_escape_string($con, $_POST['password']);
                $newPassword1 = mysqli_real_escape_string($con, $_POST['password_1']);
                $newPassword2 = mysqli_real_escape_string($con, $_POST['password_2']);

                //check old password
                $password_query = "SELECT * FROM user WHERE ID = '$id'";
                $result = mysqli_query($con, $password_query);
                $data = mysqli_fetch_assoc($result);

                if ($oldPassword == $data['Password']) {
                    if ($newPassword1 == $newPassword2) {
                        $query = "UPDATE user SET Username = '$username', Email = '$email', Password = '$newPassword1', DOB = '$DOB', Tel = '$Tel', Gender = '$Gender' WHERE ID = '$id'";
                        if (mysqli_query($con, $query)) {
                            $response = "Success";
                            $message = "Profile had been saved xpropic";
                        }
                        else {
                            $response = "Error";
                            $message = "Error: " . mysqli_error($con);
                        }
                    }
                }   
            }else{
                // $log = 123;
                $query = "UPDATE user SET Username = '$username', Email = '$email', DOB = '$DOB', Tel = '$Tel', Gender = '$Gender' WHERE ID = '$id'";
                if (mysqli_query($con, $query)) {
                    $response = "Success";
                    $message = "Profile had been saved";;
                }
                else {
                    $response = "Error";
                    $message = "Error: " . mysqli_error($con);
                }
            }
        }
    }

    else{
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $profile_pic = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));

        $profile_pic_name = $_FILES['profile_picture']['name'];
        $profile_pic_extension = strtolower(pathinfo($profile_pic_name, PATHINFO_EXTENSION));

        if (in_array($profile_pic_extension, $allowed_extensions)) {
        $query = "UPDATE user SET Profile_pic = '$profile_pic' WHERE ID = '$id'";
        //     // 
        if (mysqli_query($con, $query)) {
            $response = "Success";
            $message = "Profile picture changed successfully";
        }
        else {
            $message = "Error: " . mysqli_error($con);
        }
        }
        else {
            $response = "Error";
            $message = "Upload failed: Incorrect file type";
        }
    }
    // else {
    //     $response = "Error";
    //     $message = "File upload fail out";
    // }
    
    $res = array('response' => $response, 'type' => $type, 'message' => $message);
    echo json_encode($res);
    mysqli_close($con);
?>