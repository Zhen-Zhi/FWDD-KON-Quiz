<?php
    include("../conn.php");
    session_start();
    $room_id = $_SESSION['room_id'];

    //$query_get_qz_id = "SELECT qz_ID FROM quiz WHERE Room_ID = '$room_id'";
    // $query_get_qz_id = "5";

    $query = "SELECT * FROM quiz_ques INNER JOIN quiz ON quiz_ques.qz_ID = quiz.qz_ID WHERE quiz.Room_ID = '$room_id'";
    $result = mysqli_query($con, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $json_data = json_encode($data);
    echo $json_data;
?>