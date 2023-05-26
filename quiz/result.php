<?php 
    include("../session.php");
    include("../conn.php");

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    else {
        $id = 0;
    }
    
    $score = $_GET['score'];
    $correct_ques = $_GET['correct_ques'];
    $tot_ques = $_GET['tot_ques'];
    $time = $_GET['time'];
    $quiz_title = $_GET['quiz_title'];
    $quiz_id = $_GET['quiz_id'];
    $date = date("d-m-Y");
?>
<head>
    <title>KON Quiz - Quiz</title>
</head>

<div class="container">
    <!-- <div class="d-flex justify-content-center align-items-center">
        <div class="spinner-grow text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="">Result</a>
        </li>
    </ul>
    <div class="shadow p-5 pt-4">
        <div class="row mb-4">
            <div class="col text-center">
                <div class="fs-3">Your score in <?php echo $quiz_title ?>:</div>
                <div id="score"><?php echo $score ?></div>/100
            </div>
        </div>

        <div class="progress shadow" style="height: 50px" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width:1%" id="cor-bar"></div>
            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width:1%" id="wrg-bar"></div>
        </div>
        
        <div class="row mt-4">
                <!-- <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div> -->
                
            <form action="" method="" id="save-result">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <label class="form-label">Number of Correct Question:</label>
                            <input class="form-control-plaintext" name="cor-ques" value="<?php echo $correct_ques ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Total Question:</label>
                            <input class="form-control-plaintext" name="tot-ques" value="<?php echo $tot_ques ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Time Used:</label>
                            <input class="form-control-plaintext" name="time-used" value="<?php echo $time ?>">
                        </div>
                        <input type="hidden" class="form-control-plaintext" value="<?php echo $quiz_title?>" name="quiz-title">
                        <input type="hidden" class="form-control-plaintext" value="<?php echo $quiz_id?>" name="quiz-id">
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary my-3" id="sv-btn">Save Result</button>
                </div>
                
            </form>
        </div>
    </div>
    
</div>

<style>
    #score {
        font-size: 6em;
    }
</style>

<script>
    if(window.location.href.includes("message")){
        document.getElementById('sv-btn').disabled = true;
    }

    $(document).ready(function() {
        $('#save-result').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save_result.php',
                data:  $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                        window.location.href = window.location.href + '&message=' + encodeURIComponent(data.message);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                    }
                }
            });
        });
    });

    const progressBarGreen = document.getElementById('cor-bar');
    const progressBarRed = document.getElementById('wrg-bar');

    function calPercentage () {
        var totQues = <?php echo $tot_ques ?>;
        var corQues = <?php echo $correct_ques?>;

        var pal = (corQues / totQues) * 100;

        return pal;
    }

    function updateProgressBar () {
        let pal = calPercentage();
        progressBarGreen.style.width = pal + '%';
        progressBarRed.style.width = (100 - pal) + '%';
    }

    updateProgressBar();
</script>