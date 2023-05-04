<!DOCTYPE html>
<?php
    include("session.php");
    include("conn.php");
    if (isset($_GET['qz_id'])) {
        $quiz_id = $_GET['qz_id'];
    }
    else {
        $quiz_id = $_SESSION['quiz_id'];
    }
    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz WHERE qz_ID = $quiz_id AND User_ID = $id";
    $result = mysqli_query($con, $query);
    $quiz_data = mysqli_fetch_assoc($result);

    //get question
    $query_ques = "SELECT * FROM quiz_ques WHERE qz_ID = $quiz_id";
    $question_result = mysqli_query($con, $query_ques);
?>

<html>
    <head>
        <title>KON Quiz - Create Quiz</title>
        <meta name="description" content="Our first page">
        <meta name="keywords" content="html tutorial template">
    </head>
    
    <body>
    <br><br>
    <div class="container-fluid pt-5 px-5 mx-auto">
        <div class="shadow p-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right"><?php echo $quiz_data['Title'] ?></h4> 
            </div> 
            <div class="container-fluid p-3">
                <form action="create_ques.php">
                    <button class="btn btn-primary btn-lg my-3" type="submit">+ADD NEW QUESTION</button>
                </form>
                
                <div class="card">
                    <div class="card-header"><?php echo "Question title 1"?></div>
                    <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">Option 1</div>
                    <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">Option 2</div>
                    <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">Option 3</div>
                    <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">Option 4</div>
                </div>
                

                <!-- show all available question -->
                <?php 
                    while($row=mysqli_fetch_array($question_result)) {
                        $question_block = '
                            <div class="card">
                                <div class="card-header">'. $row['ques'] . '</div>
                                <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">'. $row['opt1'] . '</div>
                                <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">'. $row['opt2'] . '</div>
                                <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">'. $row['opt3'] . '</div>
                                <div class="card-body mx-2"><img src="img/tick.png" class="tick mx-2">'. $row['opt4'] . '</div>
                            </div>  
                        ';

                        echo $question_block;
                    }
                ?>
            </div>

        </div>
        </div>
    </body>
</html>

<style>
    #ques {
        height: 25vh;
        resize: none;
    }

    .tick {
        height: 30px;
        width: 30px;        
    }
</style>