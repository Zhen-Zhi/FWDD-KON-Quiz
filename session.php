<?php
    include("conn.php");
    session_start();

   if(isset($_SESSION['id'])){
        include("template/navigation_member.php");
    }else{
        include("template/navigation_guest.php");
    }

    mysqli_close($con);
?>