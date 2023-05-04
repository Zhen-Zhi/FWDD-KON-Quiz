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
<div class="container-fluid pt-5 mt-2">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-2">
                <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <!-- <div class="border-0 shadow-lg" style="height: 80vh;"> -->
        <h2 class="px-2">Your Current Quizzes</h2>
        <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card">
                        <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="btn fs-1 h-100" type="submit" name= "" style="color:gray;">
                            +
                        </button>
                    </div>
                </div>
                
                <?php 
                    while($row=mysqli_fetch_array($result)) {
                ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                    <p class="card-text"><?php echo $row['Description'] ?></p>
                                </div>
                                <div class="card-footer d-flex flex-row">
                                    <form method="GET" action="question_page.php">
                                        <input type="hidden" value="<?php echo $row['qz_ID']?>" name="qz_id">                                              
                                        <button class="btn btn-primary me-1" type>View</button>
                                    </form>
                                    <form method="" action="" id="delete-quiz<?php echo $row['qz_ID']?>">
                                        <input type="hidden" value="<?php echo $row['qz_ID'] ?>" name="qz_id"> 
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-confirm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
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
        <img class="modal-img-danger" src="img/Cave_Monkey.png" alt="">
        <div class="modal-content">
            <div class="modal-header">
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
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" name="">Yes</button>
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
    .modal-header{
        background-color: #dc3545;
    }
    /* #modal-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    } */

    #quiz-desc {
        height: 25vh;
        resize: none;
    }

    .card{
        height: 25vh;
    }

    .modal-img-danger{
        width: 40vh;
    }
</style>
