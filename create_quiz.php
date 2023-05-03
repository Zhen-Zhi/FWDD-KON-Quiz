<?php 
    include("conn.php");
    $response = "before";
    $message = "beofore";

    $qz_title = mysqli_real_escape_string($con,$_POST['qz_title']);
    $qz_desc = mysqli_real_escape_string($con,$_POST['qz_desc']);

    // check duplicate quiz title
    $query = "SELECT qz_id, Title FROM quiz WHERE Title = '$qz_title'";
    $duplicate_title = mysqli_query($con, $query);

    if (mysqli_num_rows($duplicate_title) == 0 && $qz_title != "" && $qz_desc != "") {
        $query_create_quiz = "INSERT INTO quiz (Title, Description) VALUES ('$qz_title', '$qz_desc')";
        if (mysqli_query($con, $query_create_quiz)) {
            $response = "Success";
            $message = "Quiz created successfully";
        }
        else {
            echo "Error: " . mysqli_error($con);
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
    mysqli_close($con);
?>