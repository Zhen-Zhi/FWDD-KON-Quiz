<?php
    include("session.php");
    include("conn.php");
    include("toast.php");
?>
<head>
    <title>KON Quiz - Create Quiz</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
</head>

<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="question_page.php?qz_id=<?php echo $_SESSION['quiz_id'] ?>">View Question</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Create Question</a>
        </li>
    </ul>
    <div class="shadow p-5 pt-4">
        <h3>Create new question</h3> 
        <form action="" method="POST" class="" id="create-form">
            <div class="row mb-3">
                <div class="col">
                    <label for="quiz-title" class="form-label">Question</label>
                    <textarea class="form-control" placeholder="Enter your question here..." id="ques" name="ques_title"></textarea>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <label for="quiz-title" class="form-label">Check the checkbox</label>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="radio" class="form-check-input" name="correct_opt" value="opt1" id="opt1" checked>
                        </div>
                        <input id="opt" class="form-control" type="text" name="opt1" placeholder="Enter option here...">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="radio" class="form-check-input" name="correct_opt" value="opt2" id="opt2">
                        </div>
                        <input id="opt" class="form-control" type="text" name="opt2" placeholder="Enter option here...">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="radio" class="form-check-input" name="correct_opt" value="opt3" id="opt3">
                        </div>
                        <input id="opt" class="form-control" type="text" name="opt3" placeholder="Enter option here...">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input type="radio" class="form-check-input" name="correct_opt" value="opt4" id="opt4">
                        </div>
                        <input id="opt" class="form-control" type="text" name="opt4" placeholder="Enter option here...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="text-center">
                    <input type="hidden" name="createQuestion" value="1">
                    <button type="submit" id="submit" class="btn btn-primary" name="createQuestion">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const toastLiveExample = document.getElementById('liveToast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

    $(document).ready(function() {
        $('#create-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: 'question_handler.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    var data = response;
                    if (data.response == 'Success') {
                        window.location.href = 'question_page.php?qz_id=<?php echo $_SESSION['quiz_id'] ?>&message=' + encodeURIComponent(data.message);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html("Error");
                        toastBootstrap.show();
                    }
                }
            });
        });
    });
</script>

<style>
    #ques {
        height: 25vh;
        resize: none;
    }
</style>