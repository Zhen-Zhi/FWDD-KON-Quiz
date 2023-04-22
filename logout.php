<?php
    session_start();    
    header("location: homepage.php");
    session_destroy();
?>