<?php 
    include("conn.php");
    session_start();
    
    $room_id = mysqli_real_escape_string($con,$_POST['room']);
    $quiz = "Error";

    $query = "SELECT * FROM quiz WHERE Room_ID = '$room_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) >= 1) {
        $quiz = "Success";
    }

    $response = array('quiz' => $quiz,'room_id' => $room_id);
    $json_response = json_encode($response);
    echo $json_response;
?>