<!DOCTYPE html>
<?php
    include("template.html");
    include("session.php");
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
                <h4 class="text-right">Create new quiz</h4> 
            </div> 
            <form action="" method="POST" class="" id="edit-form">
                <div class="col-md-5 mx-auto">
                    <label for="quiz-title" class="form-label">Quiz Title</label>
                    <input id="username" class="form-control" type="text" name="username" value="">
                    <div class="invalid-feedback">
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>