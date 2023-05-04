<?php
    include("session.php");
    include("conn.php");
    include("toast.php");
    
    $ques_id = mysqli_real_escape_string($con,$_POST['ques_id']);

    $query = "SELECT * FROM quiz_ques WHERE ID = $ques_id";
    $result = mysqli_query($con, $query);
?>

<head>
    <title>KON Quiz - Edit Quiz Question</title>
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
            <a class="nav-link active" aria-current="page" href="#">Edit Question</a>
        </li>
    </ul>
    <div class="shadow p-5 pt-4">
        <h3>Edit question</h3> 
        <?php 
        if ($result) {
            while($row = mysqli_fetch_array($result)) {?> 
                <form action="" method="POST" class="" id="edit-form">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="quiz-title" class="form-label">Question</label>
                            <textarea class="form-control" placeholder="Enter your question here..." id="ques" name="ques_title"><?php echo $row['ques']?></textarea>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="quiz-title" class="form-label">Check the checkbox</label>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input type="radio" class="form-check-input" name="correct_opt" value="opt1" id="opt1" <?php if ($row['correct_opt'] == "opt1") { ?> checked="checked"<?php } ?>>
                                </div>
                                <input id="opt" class="form-control" type="text" name="opt1" placeholder="Enter option here..." value="<?php echo $row['opt1']?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input type="radio" class="form-check-input" name="correct_opt" value="opt2" id="opt2" <?php if ($row['correct_opt'] == "opt2") { ?> checked="checked"<?php } ?>>
                                </div>
                                <input id="opt" class="form-control" type="text" name="opt2" placeholder="Enter option here..." value="<?php echo $row['opt2']?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input type="radio" class="form-check-input" name="correct_opt" value="opt3" id="opt2" <?php if ($row['correct_opt'] == "opt3") { ?> checked="checked"<?php } ?>>
                                </div>
                                <input id="opt" class="form-control" type="text" name="opt3" placeholder="Enter option here..." value="<?php echo $row['opt3']?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input type="radio" class="form-check-input" name="correct_opt" value="opt4" id="opt2" <?php if ($row['correct_opt'] == "opt4") { ?> checked="checked"<?php } ?>>
                                </div>
                                <input id="opt" class="form-control" type="text" name="opt4" placeholder="Enter option here..." value="<?php echo $row['opt4']?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-center">
                            <input type="hidden" value="1" name="editQuestion">
                            <input type="hidden" value="<?php echo $row['ID']?>" name="ques_id">
                            <button type="submit" id="" class="btn btn-primary" name="submit-btn">Save</button>
                        </div>
                        
                    </div>
                </form>
        <?php 
        }} else {
            echo "Failed";
        }
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#edit-form').submit(function(e) {
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