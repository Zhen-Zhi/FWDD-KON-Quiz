<?php
    include("conn.php");
    session_start();

   if(isset($_SESSION['admin_id'])){
        include("template/navigation_admin.php");
    }
    else{
        include("template/navigation_guest.php");
    }

    

    mysqli_close($con);
?>