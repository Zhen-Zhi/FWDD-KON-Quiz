<?php
    include("../session.php");
    include("../conn.php");

    $title = 'Dashboard';
?>
<head>
    <title>KON Quiz - Create Question</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
</head>

<div class="container">
    <?php include('../template/nav_tabs.php') ?>
    <div class="shadow p-5 pt-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="question_page.php">View Question</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Question</li>
            </ol>
        </nav>
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