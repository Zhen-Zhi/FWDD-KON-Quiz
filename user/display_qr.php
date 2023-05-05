<!DOCTYPE html>
<?php 
    include("../session.php");
?>
<html>
    <head>
        <title>KON Quiz</title>
        <meta name="description" content="Our first page">
        <meta name="keywords" content="html tutorial template">
    </head>
    
    <body>
        <div class="p-5 m-5">
            <?php 
                echo '<img src="https://quickchart.io/qr?text='.urlencode('http://192.168.100.15/FWDD-KON-QUIZ/quiz/quiz.php?room_id=110833&login=').'" width="150">';
                //echo '<img src="http://quickchart.io/qr?text=http%3A%2F%2F192.168.100.15%2FFWDD_KON_QUIZ%2Fhomepage.php" width="150">';
            ?>
        </div>
        </body>
</html>
