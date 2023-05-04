<?php 
    include("conn.php");
    session_start();
    $response = "Error";
    $message = "Not in else statement";

    $qz_id = mysqli_real_escape_string($con,$_POST['qz_id']);
    $query_quiz = "DELETE FROM quiz WHERE qz_ID = '$qz_id'";
    $query_ques = "DELETE FROM quiz_ques WHERE qz_ID = '$qz_id'";

    if (mysqli_query($con, $query_quiz) && mysqli_query($con, $query_ques)) {
        $response = "Success";
        $message = "All question and the quiz had been deleted";
    }
    else {
        $message = "Error: " . mysqli_error($con);
    }
    
    $response = array('response' => $response, 'message' => $message,);
    echo json_encode($response);
    mysqli_close($con);
?>