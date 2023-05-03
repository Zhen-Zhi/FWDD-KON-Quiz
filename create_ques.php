<!DOCTYPE html>
<?php
    include("session.php");
    include("conn.php");
?>

<html>
    <head>
        <title>KON Quiz - Create Quiz</title>
        <meta name="description" content="Our first page">
        <meta name="keywords" content="html tutorial template">
    </head>
    
    <body>
    <br><br>
    <div class="container pt-5 px-5 mx-auto">
        <div class="shadow p-5">
            <div class="d-flex justify-content-between align-items-center mb-3"> 
                <h4 class="text-right">Create new question</h4> 
            </div> 
            <form action="" method="POST" class="" id="edit-form">
                <div class="mx-auto my-4">
                    <label for="quiz-title" class="form-label">Question</label>
                    <textarea class="form-control" placeholder="Enter your question here..." id="ques" name="ques_title"></textarea>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="mx-auto">
                    <label for="quiz-title" class="form-label m-3">Check the checkbox</label>
                    <div class="m-3">
                        <input type="radio" class="" name="correct_opt" value="opt1" id="opt1">
                        <input id="opt" class="form-control" type="text" name="opt1" placeholder="Enter option here...">
                    </div>
                    <div class="m-3">
                        <input type="radio" class="" name="correct_opt" value="opt2" id="opt2">
                        <input id="opt" class="form-control" type="text" name="opt2" placeholder="Enter option here...">
                    </div>
                    <div class="m-3">
                        <input type="radio" class="" name="correct_opt" value="opt3" id="opt2">
                        <input id="opt" class="form-control" type="text" name="opt3" placeholder="Enter option here...">
                    </div>
                    <div class="m-3">
                        <input type="radio" class="" name="correct_opt" value="opt4" id="opt2">
                        <input id="opt" class="form-control" type="text" name="opt4" placeholder="Enter option here...">
                    </div>
                    <div class="row m-3">
                        <button type="submit" id="" class="btn btn-primary" name="submit-btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>

<style>
    #ques {
        height: 25vh;
        resize: none;
    }
</style>

<?php 
    if (isset($_POST['submit-btn'])) {
        $ques_title = mysqli_real_escape_string($con,$_POST['ques_title']);
        $opt1 = mysqli_real_escape_string($con,$_POST['opt1']);
        $opt2 = mysqli_real_escape_string($con,$_POST['opt2']);
        $opt3 = mysqli_real_escape_string($con,$_POST['opt3']);
        $opt4 = mysqli_real_escape_string($con,$_POST['opt4']);
        $correct_opt = mysqli_real_escape_string($con,$_POST['correct_opt']);
        $quiz_id = mysqli_real_escape_string($con,$_SESSION['quiz_id']);
        
        $query = "INSERT INTO quiz_ques (ques, opt1, opt2, opt3, opt4, correct_opt, qz_ID) VALUES ('$ques_title', '$opt1', '$opt2', '$opt3', '$opt4', '$correct_opt', '$quiz_id')";
        if (mysqli_query($con, $query)) {
            echo '<script>alert("Record added!");window.location.href="question_page.php";</script>';
        }
        else {
            echo mysqli_error($con);
        }
    }
?>