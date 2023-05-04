<?php 
    include("conn.php");
    session_start();
    $response = "";
    $message = "";

    if (isset($_POST['createQuestion'])) {
        $ques_title = mysqli_real_escape_string($con,$_POST['ques_title']);
        $opt1 = mysqli_real_escape_string($con,$_POST['opt1']);
        $opt2 = mysqli_real_escape_string($con,$_POST['opt2']);
        $opt3 = mysqli_real_escape_string($con,$_POST['opt3']);
        $opt4 = mysqli_real_escape_string($con,$_POST['opt4']);
        $correct_opt = mysqli_real_escape_string($con,$_POST['correct_opt']);
        $quiz_id = mysqli_real_escape_string($con,$_SESSION['quiz_id']);

        $query = "INSERT INTO quiz_ques (ques, opt1, opt2, opt3, opt4, correct_opt, qz_ID) VALUES ('$ques_title', '$opt1', '$opt2', '$opt3', '$opt4', '$correct_opt', '$quiz_id')";
        if (mysqli_query($con, $query)) {
            $response = "Success";
            $message = "Question created successfully";
        }
        else {
            $response = "Error";
            $message = mysqli_error($con);
        }

        $response = array('response' => $response,'message' => $message);
        header('Content-Type: application/json');
        $json_response = json_encode($response);
        echo $json_response;
    }

    mysqli_close($con);
?>