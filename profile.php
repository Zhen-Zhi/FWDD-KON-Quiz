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

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
        </li>
    </ul>
    <!-- <div class="border-0 shadow-lg" style="height: 80vh;"> -->
        <h2 class="px-2">Your Current Quizzes</h2>
        <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card">
                        <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="btn fs-1 h-100 text-secondary" type="submit" name= "">
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
                                        <button type="submit" class="btn btn-primary me-1" type>View</button>
                                        <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-quiz" value="<?php echo $row['qz_ID']?>">Delete</button>
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

<!-- delete quiz modal -->
<div class="modal fade" id="delete-quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img-danger" src="img/Cave_Monkey.png" alt="">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast align-items-center mx-auto border-0" id="alert2" role="alert2" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="mx-auto my-3">
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer">
                <form id="del">
                    <input type="hidden" value="" name="qz_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

        $('#del').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'del_quiz.php',
                data: $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                            $('#alert2').removeClass('text-bg-danger').addClass('text-bg-success');
                            setTimeout(function() {
                                window.location.href = 'profile.php';
                            }, 1000);
                        } else {
                            $('#alert2').removeClass('text-bg-success').addClass('text-bg-danger');
                        }
                        $('#alert2').find('.toast-body').html(data.message);
                        bootstrap.Toast.getOrCreateInstance(document.getElementById('alert2')).show();
                }
            });
        });

        $(".del-btn").click(function() {
            var btn_val = $(this).val();
            $("#delete-quiz input[name='qz_id']").val(btn_val);
            $('#delete-quiz').modal('show');
        });
    });
</script>

<style>
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
