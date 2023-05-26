<?php 
    include("../conn.php");
    session_start();
    $response = "";
    $message = "";
    header('Content-Type: application/json');

    if (isset($_POST['createQuiz'])) {
        $qz_title = mysqli_real_escape_string($con,$_POST['qz_title']);
        $qz_desc = mysqli_real_escape_string($con,$_POST['qz_desc']);
        $user_id = mysqli_real_escape_string($con,$_POST['id']);
        $cat_id = mysqli_real_escape_string($con,$_POST['qz_cat']);

        // check duplicate quiz title
        $query = "SELECT qz_id, Title FROM quiz WHERE Title = '$qz_title'";
        $duplicate_title = mysqli_query($con, $query);

        if (mysqli_num_rows($duplicate_title) == 0 && $qz_title != "" && $qz_desc != "") {
            $query_create_quiz = "INSERT INTO quiz (Title, Description, User_ID, Category_ID) VALUES ('$qz_title', '$qz_desc', '$user_id', '$cat_id')";
            if (mysqli_query($con, $query_create_quiz)) {
                $response = "Success";
                $message = "Quiz created successfully";
                $_SESSION['quiz_id'] = mysqli_insert_id($con);
            }
            else {
                $response = "Error";
                $message = mysqli_error($con);
            }
        }
        else if ($qz_title == "" || $qz_desc == "") {
            $response = "Error";
            $message = "Please fill in the quiz title and quiz description";
        }
        else {
            $response = "Error";
            $message = "Quiz title already existed";
        }

        $response = array('response' => $response,'message' => $message);
        $json_response = json_encode($response);
        echo $json_response;
    }else if (isset($_POST['deleteQuiz'])){
        $qz_id = mysqli_real_escape_string($con,$_POST['qz_id']);
        $query_quiz = "DELETE FROM quiz WHERE qz_ID = '$qz_id'";
        $query_ques = "DELETE FROM quiz_ques WHERE qz_ID = '$qz_id'";

        if (mysqli_query($con, $query_quiz) && mysqli_query($con, $query_ques)) {
            $response = "Success";
            $message = "All question and the quiz had been deleted";
        }
        else {
            $response = "Error";
            $message = "Error: " . mysqli_error($con);
        }
        
        $response = array('response' => $response, 'message' => $message,);
        echo json_encode($response);
    }else if (isset($_POST['editQuiz'])){
        $qz_id = mysqli_real_escape_string($con,$_POST['qz_id']);
        $title = mysqli_real_escape_string($con,$_POST['qz_title']);
        $desc = mysqli_real_escape_string($con,$_POST['qz_desc']);
        $qz_cat = mysqli_real_escape_string($con,$_POST['qz_cat']);
        
        $query = "UPDATE quiz SET Title = '$title', Description = '$desc', Category_ID = '$qz_cat' WHERE qz_ID = '$qz_id'";

        if (mysqli_query($con, $query)) {
            $response = "Success";
            $message = 'Edit Successfully';
        } else {
            $response = "Error";
            $message = 'No quiz found with that ID.';
        }

        $res = array('response' => $response, 'message' => $message);
        echo json_encode($res);
    }else if (isset($_POST['changeState'])){
        $room_id = $_POST['room_ID'];
        $quiz_id = $_POST['qz_id'];
        $state = $_POST['state'];

        $query = "UPDATE quiz SET Room_ID = '$room_id' WHERE qz_ID = '$quiz_id'";
        if (mysqli_query($con, $query)) {
            $response = "Success";
            if($state == 1){
                $message = 'Room opened successfully';
            }else{
                $message = 'Room closed successfully';
            }
        }
        else {
            $response = "Error";
            $message = 'Failed';
        }

        $res = array('response' => $response, 'message' => $message, 'room_id' => $room_id, 'quiz_id' => $quiz_id);
        echo json_encode($res);
    }

    mysqli_close($con);
?>