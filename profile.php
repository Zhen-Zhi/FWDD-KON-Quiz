<!DOCTYPE html>
<html>
<head>
    <title>KON Quiz - Profile Page</title>
</head>

<?php 
    include("session.php");
    include("conn.php");
    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz where User_ID = $id";
    $result = mysqli_query($con, $query);
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
            <div class="border-0 shadow-lg" style="height: 80vh;">
                <div class="col px-3">

                <h2 class="card-title fs-1 pb-1 pt-4 mb-3 px-3" style="font-weight: bold; color: black !important">Your Current Quizzes</h2>

                    <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
                    <div class="row mx-5">
                        <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="col btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "font-weight: bold; font-size: 3vh; color: white !important; background-color: #fe2c54;">
                            + ADD QUIZ
                        </button>
                        <?php 
                            while($row=mysqli_fetch_array($result)) {
                                $quiz_block = '
                                    <div class="col-md-3">
                                        <div class="card" style="">
                                            <div class="card-body">
                                                <h5 class="card-title">'. $row['Title'] .'</h5>
                                                <p class="card-text">'. $row['Description'] .'</p>
                                                <form method="GET" action="question_page.php">
                                                    <input type="hidden" value="'. $row['qz_ID'] .'" name="qz_id">                                              
                                                    <button class="btn btn-primary" type>View question</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                ';

                                echo $quiz_block;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
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
                <form class="needs-validation" action="" method="POST" novalidate id="quiz-form">
                    <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
                    <div class="mx-auto my-3">
                        <label for="quiz-title" class="form-label">Quiz Title</label>
                        <input id="quiz-title" class="form-control" type="text" name="qz_title">
                    </div>
                    <div class="mx-auto">
                        <label for="quiz-desc" class="form-label">Quiz Description</label>
                        <textarea class="form-control" id="quiz-desc" name="qz_desc"></textarea>
                    </div>
                    <div class="col-md-6 mt-2 mx-auto text-center pt-1">
                        <button class="btn btn-primary w-50" name="create_quiz" type="submit" id="modal-btn">
                            Create Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Confirm delete modal -->
<div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img" src="img/wiz.png" alt="">
        <div class="modal-content">
            <div class="modal-header shadow">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
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
                <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="qz_id">
                <div class="mx-auto my-3">
                    <label for="quiz-title" class="form-label">Are you sure you want to delete </label>
                </div>
                <div class="col-md-6 mt-2 mx-auto text-center pt-1">
                    <button class="btn btn-primary w-50" name="create_quiz" type="submit" id="modal-btn">
                        Yes
                    </button>
                </div>
                <div class="col-md-6 mt-2 mx-auto text-center pt-1">
                    <button class="btn btn-primary w-50" data-bs-dismiss="modal" name="create_quiz" id="modal-btn">
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function() {
        $('#quiz-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'create_quiz.php',
                data:  $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                        $('#alert').removeClass('text-bg-danger').addClass('text-bg-success');
                        
                        setTimeout(function() {
                            window.location.href = 'question_page.php';
                        }, 2000);
                    } else {
                        $('#alert').removeClass('text-bg-success').addClass('text-bg-danger');
                    }
                    $('#alert').find('.toast-body').html(data.message);
                    bootstrap.Toast.getOrCreateInstance(document.getElementById('alert')).show();
                }
            });
        });

        $('[id^="delete-quiz"]').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: 'delete_quiz.php',
                data:  $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                        $('#alert').removeClass('text-bg-danger').addClass('text-bg-success');
                        
                        setTimeout(function() {
                            window.location.href = 'profile.php';
                        }, 2000);
                    } else {
                        $('#alert').removeClass('text-bg-success').addClass('text-bg-danger');
                    }
                    $('#alert').find('.toast-body').html(data.message);
                    bootstrap.Toast.getOrCreateInstance(document.getElementById('alert')).show();
                }
            });
        });
    });
</script>

<style>
    #modal-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    }

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
        resize: none;
    }

    #exampleModalLable {
        text-align: center;
    }

    .card{
        height: 25vh;
        width: 40vh;
    }

    .card-text
</style>
