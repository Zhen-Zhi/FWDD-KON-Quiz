<?php
    include("../conn.php");
    session_start();

    $query = "SELECT * FROM quiz_ques WHERE qz_ID = 5";
    $result = mysqli_query($con, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $json_data = json_encode($data);
    echo $json_data;
?>