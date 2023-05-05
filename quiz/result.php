<?php 
    include("../session.php");
    include("../conn.php");
    $score = $_GET['score'];
    $correct_ques = $_GET['correct_ques'];
    $tot_ques = $_GET['tot_ques'];
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
    <div class="m-5 container-sc">
        <p id="score" class="mx-auto"><?php echo $score ?></p>
    </div>
    <div class="m-5">
        <div class="progress" style="height: 50px" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width:1%" id="cor-bar"></div>
            <div class="progress-bar progress-bar-striped bg-danger" style="width:1%" id="wrg-bar"></div>
        </div>

        <div>
            <lable>Number of Correct Question:<p><?php echo $correct_ques ?></p></label>
        <div>
        <div>
            <lable>Total Question:<p><?php echo $tot_ques ?></p></label>
        <div>
    </div>
    
</div>

<style>
    .container-sc {
        display: flex;
    }

    #score {
        font-size: 6em;
    }
</style>

<script>
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