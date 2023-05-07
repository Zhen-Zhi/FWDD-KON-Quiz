<?php
    include("../conn.php");
    session_start();
    $response = "";
    $message = "";

    $cor_ques = mysqli_real_escape_string($con,$_POST['cor-ques']);
    $tot_ques = mysqli_real_escape_string($con,$_POST['tot-ques']);
    $quiz_id = mysqli_real_escape_string($con,$_POST['quiz-id']);
    $time_used = mysqli_real_escape_string($con,$_POST['time-used']);
    $date = date("d.m.Y");

    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "INSERT INTO session (User_ID, qz_ID, Total_question, Correct_question, Time_used, Date) VALUES ('$id', '$quiz_id', '$tot_ques', '$cor_ques', '$time_used', '$date')";
        if (mysqli_query($con, $query)) {
            $response = "Success";
            $message = "Quiz attempt saved";
        }
        else {
            $response = "Error";
            $message = "Error: " . mysqli_error($con);
        }
    }
    else {
        $response = "Error";
        $message = "Guest cannot save result";
    }

    $response = array('message' => $message, 'response' => $response);
    $json_response = json_encode($response);
    echo $json_response;
    mysqli_close($con);
?>