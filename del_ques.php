<?php 
    include("conn.php");
    session_start();
    $response = "Error";
    $message = "Not in else statement";

    $ques_id = mysqli_real_escape_string($con,$_POST['ques_id']);
    $query = "DELETE FROM quiz_ques WHERE ID = '$ques_id'";

    if (mysqli_query($con, $query)) {
        $response = "Success";
        $message = "Question deleted";
    }
    else {
        $message = "Error: " . mysqli_error($con);
    }
    
    $response = array('response' => $response, 'message' => $message, 'check' => $ques_id);
    echo json_encode($response);
    mysqli_close($con);
?>