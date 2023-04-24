<?php
    include("conn.php");
    session_start();
    // session_destroy();

   if(isset($_SESSION['id'])){
        include("navigation_member.php");
    }else{
        include("navigation_guest.php");
    }

    mysqli_close($con);
?>