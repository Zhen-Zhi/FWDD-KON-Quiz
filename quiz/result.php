<?php 
    include("../session.php");
    include("../conn.php");
    $score = $_GET['score'];
    $correct_ques = $_GET['correct_ques'];
    $tot_ques = $_GET['tot_ques'];
    $time = $_GET['time'];
    $quiz_title = $_GET['quiz_title'];
    $quiz_id = $_GET['quiz_id'];
?>
<head>
    <title>KON Quiz - Quiz</title>
</head>

<div class="container mt-3">
    <div class="shadow">
        <h1 class="card-header p-3" id="">
            Quiz Result
        </h1>
    </div>
    <h2><?php echo $quiz_title ?></h2>
    <div class="m-5 container-sc">
        <p id="score" class="mx-auto"><?php echo $score ?></p>
    </div>
    <div class="m-5">
        <div class="progress shadow" style="height: 50px" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width:1%" id="cor-bar"></div>
            <div class="progress-bar progress-bar-striped bg-danger" style="width:1%" id="wrg-bar"></div>
        </div>
        <div class="my-3 p-3 shadow">
            <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <form action="" method="" id="save-result" onsubmit= "disableButton()">
                <div class="result-info">
                    <lable>Number of Correct Question:</lable>
                    <input class="form-control-plaintext" name="cor-ques" value="<?php echo $correct_ques ?>">
                <div>
                <div>
                    <lable>Total Question:</label>
                    <input class="form-control-plaintext" name="tot-ques" value="<?php echo $tot_ques ?>">
                <div>
                <div>
                    <lable>Time Used:</label>
                    <input class="form-control-plaintext" name="time-used" value="<?php echo $time ?>">
                <div>
                <input type="text" class="form-control-plaintext" value="<?php echo $quiz_title?>" name="quiz-title">
                <input type="text" class="form-control-plaintext" value="<?php echo $quiz_id?>" name="quiz-id">
                <button class="btn btn-primary my-3" id="sv-btn" disable="true">Save Result</button>
            </form>
        </div>
    </div>
    
</div>

<style>
    .container-sc {
        display: flex;
    }

    #score {
        font-size: 6em;
    }

    .result-info p {
        font-size: 1.4em;
    }
</style>

<script>
    $(document).ready(function() {
        $('#save-result').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save_result.php',
                data:  $(this).serialize(),
                success: function(response) {
                    console.log(12322,response);
                    var data = JSON.parse(response);
                    console.log(123,data);
                    if (data.response == 'Success') {
                        // window.location.href = '/FWDD-KON-QUIZ/homepage.php?&message=' + encodeURIComponent(data.message);
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

    function disableButton () {
        document.getElementById('sv-btn').disabled = true;
    }

    updateProgressBar();
</script>