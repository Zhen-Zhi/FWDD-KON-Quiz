<!DOCTYPE html>
<html>
<head>
    <title>KON Quiz - Profile Page</title>
</head>

<?php 
    include("session.php");
?>
<body>
<div class="container-fluid pt-5 mt-2 px-5">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </nav>
    </div>
</div>

<div class="container-fluid px-5">
    <div class="row">
        <div class="col mt-4">
            <div class="card border-0 shadow-lg" style="height: 80vh;">
                <div class="col px-3">

                <h2 class="card-title fs-1 pb-1 pt-4 mb-3 px-3" style="font-weight: bold; color: black !important">Your Current Quizzes</h2>

                    <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
                    
                    <button class="btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "width: 40vh; height: 20vh; font-weight: bold; font-size: 3vh; color: white !important; background-color: #fe2c54 !important">
                        MATHS QUIZ
                    </button>

                    <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "width: 40vh; height: 20vh; font-weight: bold; font-size: 3vh; color: red !important;">
                        + ADD QUIZ
                    </button>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>
</div>

<!--  Modal  -->
<div class="modal fade" id="create-quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img" src="img/wiz.png" alt="">
        <div class="modal-content">
            <div class="modal-header shadow">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create new quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="" method="POST" novalidate id="login-form">
                    <div class="mx-auto my-3">
                        <label for="" class="form-label">Quiz Title</label>
                        <input id="quiz-title" class="form-control" type="text" name="credential">
                    </div>
                    <div class="mx-auto">
                        <label for="" class="form-label">Quiz Description</label>
                        <textarea class="form-control" id="quiz-desc"></textarea>
                    </div>
                    <div class="col-md-6 mt-2 mx-auto text-center pt-1">
                        <button class="btn w-50" name="create_quiz">
                            Create Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<style>
    .sd-bar {
        float: left;
        margin-right: 10px;
    }

    .username {
        text-align: center;
    }

    .navi{
        color: white !important;
        padding-top: 1.5vh;
        padding-bottom: 1.5vh;
        display: flex;
        justify-content: center;
    }

    #quiz-desc {
        height: 25vh;
    }

    #exampleModalLable {
        text-align: center;
    }
</style>
