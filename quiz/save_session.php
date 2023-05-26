<?php 
    include("../conn.php");
    session_start();
    if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
    }
    else {
        $id = 0;
    }
        
    $score = $_GET['score'];
    $correct_ques = $_GET['correct_ques'];
    $tot_ques = $_GET['tot_ques'];
    $time = $_GET['time'];
    $quiz_title = $_GET['quiz_title'];
    $quiz_id = $_GET['quiz_id'];
    $date = date("Y-m-d");

    $query = "INSERT INTO all_session (User_ID, qz_ID, Total_question, Correct_question, Time_used, Date) VALUES ('$id', '$quiz_id', '$tot_ques', '$correct_ques', '$time', '$date')";
    mysqli_query($con, $query);
    mysqli_close($con);
?>