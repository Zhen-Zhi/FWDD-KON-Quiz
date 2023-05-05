<?php
    include("../conn.php");
    session_start();
    $room_id = $_POST['room_ID'];
    $quiz_id = $_POST['qz_id'];

    echo '<script>alert("'. $quiz_id .'")</script>';
    echo '<script>alert("'. $room_id .'")</script>';

    $query = "UPDATE quiz SET Room_ID = '$room_id' WHERE qz_ID = '$quiz_id'";
    if (mysqli_query($con, $query)) {
        echo '<script>alert("quiz room created!");window.location.href = "../user/dashboard.php"</script>';
    }
    else {
        echo "Failed";
    }
?>